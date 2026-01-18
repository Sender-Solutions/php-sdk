# SenderSolutions SDK
This SDK for works with sender-solutions.com service API
[Full Documentation](https://sender-solutions.com/help/api/)

# Getting Started

```bash
composer require sender-solutions/php-sdk
```

```php
<?php

use SenderSolutions\SenderSolutionsApi;
use SenderSolutions\Subscriber\Base;
use SenderSolutions\Subscriber\Subscriber;

// initialize SDK
$SDK = new SenderSolutionsApi('{your-api-token}');

// create new Subscriber
$base = new Base(0, 'My New Base');
$Subscriber = new Subscriber('username1@example.com');
$Subscriber->setBase($base);
$resultSubscriber = $SDK->createSubscriber($Subscriber);

// edit Subscriber
$resultSubscriber
    ->setFirstName('Cat')
    ->setLastName('Catstone')
;
$resultSubscriber = $SDK->editSubscriber($resultSubscriber);


// Delete subscriber
$SDK->deleteSubscriber(10145);


// get subscribers list
$filters = [
    // 'Email' => 'username@example.com',
    // 'BaseId' => 1,
    // 'Id' => 1,
    // 'ClientUserId' => 'myid1',
    // 'IsActive' => 1,
    // 'FirstName' => 'Cat',
    // 'LastName' => 'Catstone',
    // 'Gender' => 'male', // 'female', // '',
];
foreach ($SDK->getAllSubscribers($filters) as $subscriber) {
    print_r($subscriber->toArray());
}

// Send Subscriber into a Mailing Campaign
$subscriberId = 42;
$campaignId = 5;
$messageId = $SDK->sendSubscriberIntoCampaign($subscriberId, $campaignId);
```
