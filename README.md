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
## Install
 1. `git clone https://github.com/pedrigalLJ/sweethome.git`
 2. `cd sweethome`
 3. `composer install`
 4. `cp .env.example .env`
 5. `php artisan key:generate`
 6. `php artisan migrate`
 7. `php artisan db:seed`
 8. `php artisan storage:link`
 9. `php artisan serve`
