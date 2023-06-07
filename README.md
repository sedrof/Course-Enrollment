[Course Enrollment Task]

========================================

Overview
----------------------------------------

This is a Course Enrollment application built using Laravel. It provides functionality for managing course enrollments with admin, user, instructor, roles, and permissions features.

Installation
----------------------------------------

1. Clone the repository:

2. Copy the `.env.example` file to `.env` and update the database credentials in the `.env` file.

3. Install the required dependencies using Composer: `composer install`, in some cases you need to `composer update` first.


4. Generate an application key:`php artisan key:generate`


5. Migrate the database and seed it with initial data:`php artisan migrate --seed`



Usage
----------------------------------------

- To access the admin panel, go to the `/login` URL and use the following credentials:
- Email: admin@admin.com
- Password: password

- To access the institution user panel, use the following credentials:
- Email: institution@institution.com
- Password: password



Ideally seed the database first.









