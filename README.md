# Geneo Test

This is an application where users can submit data via a contact form.

## Tasks

1.  Form fields should include Name, Email, Message, and ability to upload a File.
2.  All fields except File Upload should be required.
3.  Accepted file formats should be .pdf, .xlsx and .csv. All other formats should be declined.
4.  Email validation.
5.  Write unit tests that cover 2, 3 and 4 above.
6.  If the same user has used the form in the last 5 minutes, display a message telling them to wait before they can send a new message.
7.  Where necessary, display a message to the user informing them about failures or a successful submission.

## How to Setup

-   Clone repo
-   run `composer install`
-   run `cp .env.example .env` and edit your database information and mail smtp information
-   add an email to `MAIL_TO_ADDRESS` in `.env` to receive the mail
-   run `php artisan migrate` to run migration
-   run `php artisan serve` to start the application
-   to run tests `php artisan test`
-   to run queue `php artisan queue:restart && php artisan queue:work database --tries=5 --queue=high,default`

## Application Functionality

A user can't use the form until 5 minutes has elapsed after submission this is set in `app/Providers/RouteServiceProvider.php` using the `configureRateLimiting()`

## Note

-   File uploads are inside the `storage/app/uploads` directory
