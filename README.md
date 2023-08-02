## Installation
1. composer install
2. npm install
3. php artisan migrate
4. php artisan serve

## Pre Requirement / Doc Reference
[Email Config]
https://support.google.com/accounts/answer/185833?hl=en
1. Go to your Google Account.
2. Select Security.
3. Under "Signing in to Google," select 2-Step Verification.
4. At the bottom of the page, select App passwords.
5 . Enter a name that helps you remember where you’ll use the app password.
6. Select Generate.
7. To enter the app password, follow the instructions on your screen. The app password is the 16-character code that generates on your device.
8. Select Done.

[Queue]
https://laravel.com/docs/10.x/queues
**Requirement**
```bash
php artisan queue:table
php artisan migrate
```

**Run Services**
```bash
php artisan queue:work --queue=emails     
```

[Email Content]
https://laravel.com/docs/10.x/mail
