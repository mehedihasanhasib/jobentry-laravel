# JobSite

JobSite is a job portal platform, built using Laravel, MySql, Jquery, Bootstrap.

## Features

- **Job Listings**: Browse and search for jobs based on different criteria like title, location, company, and more.
- **Job Applications**: Apply for jobs directly through the platform.
- **User Profiles**: Both job seekers and employers can create and manage their profiles.
- **Admin Panel**: Manage job postings, users, and other platform settings.

## Tech Stack

- **Backend**: Laravel
- **Frontend**: HTML, CSS, JQuery
- **Database**: MySQL
- **Styling**: Bootstrap

## Setup Instructions

### Prerequisites

- PHP >= 8.1
- Node.js >= 18.x
- Composer
- MySQL

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/mehedihasanhasib/jobentry-laravel.git
   cd jobentry-laravel
2. Install PHP dependencies:
    ```bash
    composer install
3. Copy the .env.example file to .env and configure your environment variables:
    ```bash
    cp .env.example .env
4. Generate an application key:
    ```bash
    php artisan key:generate
5. Set up your database and run migrations:
    ```bash
    php artisan migrate --seed
6. Run the development server:
    ```bash
    php artisan serve

