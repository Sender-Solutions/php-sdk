# Change Log

## Version 1.2.0 (February 8th, 2026)
### Added

- Method `SenderSolutionsApi::getAllSuppressions`: Retrieve a list of Suppressions (as \Generator)
- Method `SenderSolutionsApi::getSuppressionsList`: Retrieve a list of Suppressions (as \SenderSolutions\ListResult)
- Method `SenderSolutionsApi::deleteSuppression`: Delete a Suppression by Id

## Version 1.1.0 (January 27th, 2026)
### Added

- Method `SenderSolutionsApi::sendEmail`: Sends a prepared Email

### Changed

- Method `SenderSolutionsApi::sendSubscriberIntoCampaign` returns data type SenderSolutions\ApiResponse;

## Version 1.0.1 (January 20th, 2026)
### Added

- Method `SenderSolutionsApi::sendSubscriberIntoCampaign`: added a third optional argument to support user
defined variables that will be passed to the template.

## Version 1.0.0 (January 18th, 2026)
### Added

- Implemented basic API request functionality.
- Added the core `SenderSolutionsApi` class with the following features:
    - Retrieve a list of subscribers using `getSubscribersList` and `getAllSubscribers`.
    - Create a new subscriber via `createSubscriber`.
    - Update an existing subscriber using `editSubscriber`.
    - Delete a subscriber with the `deleteSubscriber` method.
    - Send a subscriber to an email campaign using `sendSubscriberIntoCampaign`, which results in an email being sent.
