**Installation**

1. Download the repo from https://github.com/aktoyyib/BE-Developer-Test-Iphonephotographysch
2. From the root directory run `composer install`
3. You must have a MySQL database running locally
4. Update the database details in `.env` to match your local setup
5. Run `php artisan migrate` to setup the database tables


**To run tests**
1. Create the database/test.sqlite file:     touch database/test.sqlite
2. Migrate and seed the test database:        php artisan migrate --seed --env=testing
3. Run tests: vendor/bin/phpunit

**Note**
While working on the assessment, I noticed an opportunity for improvement. I would like to recommend a modification to the LessonWatched event. Currently, it accepts a payload of lesson when fired. However, considering that the event is triggered when a user watches a lesson, it would be more semantically accurate for it to accept a payload of UserLesson instead of Lesson as the event will be fired when a user watches a lesson and not when a lesson is registered. This change would make the event more aligned with its purpose and improve code clarity. However, I implemented based on lesson in order for me to adhere to instruction since the cloned project accepts Lesson as the payload.