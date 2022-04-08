# SWEETHOME: AN ONLINE SYSTEM FOR REAL ESTATE SERVICES

SweetHome is a PHP based on Laravel that helps real estate agent's properties more visible to seekers, which they can find a legitimate agent they can trust as well.

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
 4. `copy .env.example .env`
 5. `php artisan key:generate`
 6. `php artisan migrate`
 7. `php artisan db:seed`
 8. `php artisan storage:link`
 9. `php artisan serve`
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
