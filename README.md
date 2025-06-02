# SWEETHOME: AN ONLINE SYSTEM FOR REAL ESTATE SERVICES

SweetHome is a PHP based on Laravel that helps real estate agent's properties more visible to seekers, which they can find a legitimate agent they can trust as well.

##Pre-requites Installation
- Install PHP, refer to this link: https://www.geeksforgeeks.org/php/how-to-install-php-in-windows-10/
- Install composer, refer to this link: https://www.geeksforgeeks.org/installation-guide/how-to-install-php-composer-on-windows/

## Frameworks
 - Laravel 8
 - Bootstrap
## Features
### Admin will manage:
 - agent's verification
 - both users approval
 - receive notifications
### Agent can:
 - manage profile & listings
 - cancel/decline appointments
 - upload, view, download, & update documents
 - message to seeker
 - receive notifications via email
### Seeker can:
 - manage profile
 - search & view properties & agents
 - add/remove to favorites(properties)
 - message to agent
 - add star rating & comments to agent
 - request & cancel appoinment for site viewing
 - receive notifications via email
## Installations
 1. `git clone https://github.com/pedrigalLJ/sweethome.git`
 2. `cd sweethome`
 3. `composer install`
     - When encountered an error message: "Your lock file does not contain a compatible set of packages. Please run composer update." (means your PHP installation is missing the fileinfo extension, which is required by Laravel and other packages  like league/flysystem.)
     - To fix:
       1. Open your PHP folder
       2. Edit php.ini
       3. Search for the following;
          ;extension=fileinfo
          ;extension=openssl
          ;extension=mbstring
          ;extension=pdo_mysql, and uncomment it by removing the semicolon(;)
       5. Save the file. Then run composer install again.
 5. `copy .env.example .env`
 6. `php artisan key:generate`
 7. `php artisan migrate`
 8. `php artisan db:seed`
 9. `php artisan storage:link`
 10. `php artisan serve`
## Configurations
 - email in the .env
 > MAIL_DRIVER=smtp
 > 
 > MAIL_HOST=smtp.gmail.com
 > 
 > MAIL_PORT=587 *port mail server (TLS: 587 | SSL: 465)
 > 
 > MAIL_USERNAME=*your gmail address (to be an email server)
 > 
 > MAIL_PASSWORD=*your password of gmail address
 > 
 > MAIL_ENCRYPTION=tsl *method mail ecryption (tls | ssl)
 - the controller in App/Http/Controllers/AdminController.php, App/Http/Controllers/AgentAppointmentController.php, App/Http/Controllers/SeekerAppointmentController.php
     `Mail::to('*Your Email')->send(new SendMail($data));`
 - pusher credentials *for the message feature
 > PUSHER_APP_ID=
 > 
 > PUSHER_APP_KEY=
 > 
 > PUSHER_APP_SECRET=
 > 
 > PUSHER_APP_CLUSTER=
