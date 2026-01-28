# SenderSolutions SDK
This SDK for works with sender-solutions.com service API
[Full Documentation](https://sender-solutions.com/help/api/)

# Getting Started

```bash
composer require sender-solutions/php-sdk
```

```php
<?php

use SenderSolutions\Email\Attachment\AttachmentFacade;
use SenderSolutions\Email\Email;
use SenderSolutions\Email\EmailAddress\EmailAddress;
use SenderSolutions\Email\Headers\EmailHeader;
use SenderSolutions\Email\Settings\EmailSettings;
use SenderSolutions\SenderSolutionsApi;
use SenderSolutions\Subscriber\Base;
use SenderSolutions\Subscriber\Subscriber;

// Initialize SDK
$SDK = new SenderSolutionsApi('{your-api-token}');

// Sending email
$email = new Email();
$email
    ->setHtml('<!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Test Email</title>
        </head>
        <body>
        <h1>Hello</h1>
        <p>It\'s test email content</p>
        </body>
        </html>'
    )
    ->setPlainText("Hello\r\nIt's test email content")
    ->addTo(new EmailAddress('user@example.com', 'Mr. Cat'))
    ->setFrom(new EmailAddress('info@example.org', 'MyBrand Team'))
    ->setSubject('Test Email via API')
    ->setSendAt(time() + 7200) // delayed sending
    ->setTrackOpen(true)
    ->setTrackLinks(true)
    ->setTrackUnsubscribe(true)
    ->setInlineImages(true)
;

$ApiResponse = $SDK->sendEmail($email);



// Create new Subscriber
$base = new Base(0, 'My New Base');
$Subscriber = new Subscriber('username1@example.com');
$Subscriber->setBase($base);
$resultSubscriber = $SDK->createSubscriber($Subscriber);

// Edit Subscriber
$resultSubscriber
    ->setFirstName('Cat')
    ->setLastName('Catstone')
;
$resultSubscriber = $SDK->editSubscriber($resultSubscriber);


// Delete subscriber
$SDK->deleteSubscriber(10145);


// Get subscribers list
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
