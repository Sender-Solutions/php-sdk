<?php

namespace SenderSolutions;

use Generator;
use GuzzleHttp\Exception\ServerException;
use SenderSolutions\Subscriber\Subscriber;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use SenderSolutions\Subscriber\SubscribersListResult;

/**
 * @see https://sender-solutions.com/en/help/api/
 */
class SenderSolutionsApi
{
    private string $apiUrl = 'https://sender-solutions.com/api/';

    public function __construct(
        private string $apiToken,
    )
    {
    }

    private function apiCall(string $method, string $endpoint, array $data = []): array
    {
        $params = [
            RequestOptions::HEADERS => [
                'Authorization' => $this->apiToken,
            ],
        ];
        if ($method === 'POST') {
            $params[RequestOptions::JSON] = $data;
            $params[RequestOptions::HEADERS]['Content-Type'] = 'application/json';
        }

        $client = new Client();
        $url = $this->apiUrl . $endpoint;

        try {
            $response = $client->request($method, $url, $params);
        } catch (ServerException $e) {

            if (!$e->hasResponse()) {
                throw $e;
            }

            $response = $e->getResponse()->getBody()->getContents();
            $json = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw $e;
            }

            if (!empty($json['error'])) {
                throw new ApiException($json['error'], $e->getResponse()->getStatusCode(), $e);
            }

            throw $e;
        }

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        if (!$json) {
            throw new Exception('Invalid JSON Response');
        }

        if ($json['success'] !== true) {
            throw new Exception($json['error']);
        }

        return $json;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function setApiUrl(string $apiUrl): static
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @param array $filters
     * @param int $limit
     * @param int $offset
     * @return SubscribersListResult
     * @throws ApiException
     */
    public function getSubscribersList(array $filters = [], int $limit = 50, int $offset = 0): SubscribersListResult
    {
        $data = $filters;
        $data['Offset'] = $offset;
        $data['Limit'] = $limit;

        $json = $this->apiCall('GET', 'subscribers/subscribers-list/?' . http_build_query($data));
        $json = $json['SubscribersList'];

        return new SubscribersListResult($json['TotalCount'], $json['Offset'], $json['Limit'], $json['Subscribers']);
    }

    /**
     * @param array $filters
     * @return Generator<int, Subscriber>
     * @throws ApiException
     */
    public function getAllSubscribers(array $filters = []): Generator
    {
        $offset = 0;
        $limit = 250;

        do {
            $result = $this->getSubscribersList($filters, $limit, $offset);
            foreach ($result->getSubscribers() as $subscriber) {
                yield Subscriber::fromJsonResponse($subscriber);
            }
            $offset += $result->getLimit();
        } while (!$result->isLastPage());
    }

    /**
     * @param Subscriber $subscriber
     * @return Subscriber
     * @throws ApiException
     */
    public function createSubscriber(Subscriber $subscriber): Subscriber
    {
        $data = [
            'Subscriber' => $subscriber->toArray(),
        ];
        $json = $this->apiCall('POST', 'subscribers/create-subscriber/', $data);

        return Subscriber::fromJsonResponse($json['Subscriber']);
    }

    /**
     * @param Subscriber $subscriber
     * @return Subscriber
     * @throws ApiException
     */
    public function editSubscriber(Subscriber $subscriber): Subscriber
    {
        $data = [
            'Subscriber' => $subscriber->toArray(),
        ];
        $json = $this->apiCall('POST', 'subscribers/edit-subscriber/', $data);

        return Subscriber::fromJsonResponse($json['Subscriber']);
    }

    /**
     * @param int $subscriberId
     * @return bool
     * @throws ApiException
     */
    public function deleteSubscriber(int $subscriberId): bool
    {
        $data = [
            'Subscriber' => [
                'Id' => $subscriberId,
            ],
        ];
        $this->apiCall('POST', 'subscribers/delete-subscriber/', $data);

        return true;
    }

    /**
     * @param int $subscriberId
     * @param int $campaignId
     * @param array $variables
     * @return string MessageId
     * @throws ApiException
     */
    public function sendSubscriberIntoCampaign(int $subscriberId, int $campaignId, array $variables = []): string
    {
        $data = [
            'SendIntoCampaign' => [
                'SubscriberId' => $subscriberId,
                'CampaignId' => $campaignId,
            ],
        ];
        if (!empty($variables)) {
            $data['SendIntoCampaign']['Variables'] = $variables;
        }
        $json = $this->apiCall('POST', 'subscribers/send-subscriber-into-campaign/', $data);

        return $json['SendIntoCampaign']['MessageId'];
    }
}
