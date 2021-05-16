## About Project

This is for a backend developer test built with Laravel. This is a contact form that sends submitted contact information to a given admin email on submission. The following requirement was added to it:

- Form fields include Name, Email, Message, and ability to upload a File.
- All fields except File Upload are required.
- Accepted file formats are .pdf, .xlsx and .csv.
- If the same user has used the form in the last 5 minutes, a message telling them to wait before they can send a new message is displayed.
- Where necessary, a message is displayed to the user informing them about failures or a successful submission.
- Unit test

Every contact submission was saved to a database.

## Packages and library used

 - Frontend
    - Bootstrap
    - Dropify
    - Bootstrap Notify
    - Jquery
- Backend
    - Purifier
 
## Implementation

- Repository design pattern was used.
- Frontend validation was done.
- Backend validation was done using laravel form request. All the necessary rules were implemented. For email validation regex is also added for proper validation.
- Laravel Notification was used to send the contact information via email to the admin. This notification was also queued to speed up response time on form submission.
- For the rate-limiting. The throttle middleware was added to the create route. In other to display the necessary message when the maximum request has been exceeded a custom throttle middleware was created which extends Laravel ThrottleRequests middleware.
- Security measures to prevent XSS, SQL Injection and CSRF attacks was also taken. Laravel by default provides a method for preventing CSRF attack while a middleware was created to clean up every input to prevent XSS and SQL Injection. To properly achieve this the purifier package was used.

    
## Instalation

- Pull the repository
```bash
git clone https://github.com/Edu-Vin/contact-form.git
```
- Install App
```bash
composer intall

cp .env.example .env

php artisan key:generate

Update env file with right DB credentials.

Update the following environment variables

ADMIN_MAIL
ADMIN_NAME

Update the MAIL environment variables.

You can get a free mailtrap account here https://mailtrap.io/signin which you can use for testing.

php artisan migrate

```

- Run App
```bash
- Local

php artisan serve

php artisan queue:work

```
- Testing
```bash

php artisan test

```
