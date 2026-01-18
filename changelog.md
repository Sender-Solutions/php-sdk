# Change Log

## Version 1.0.0 (January 18th, 2026)
### Added

- Implemented basic API request functionality.
- Added the core `SenderSolutionsApi` class with the following features:
    - Retrieve a list of subscribers using `getSubscribersList` and `getAllSubscribers`.
    - Create a new subscriber via `createSubscriber`.
    - Update an existing subscriber using `editSubscriber`.
    - Delete a subscriber with the `deleteSubscriber` method.
    - Send a subscriber to an email campaign using `sendSubscriberIntoCampaign`, which results in an email being sent.
