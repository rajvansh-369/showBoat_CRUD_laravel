ShowBoat CRUD Laravel
This repository contains the code for the ShowBoat CRUD Laravel application.

Installation
Clone the repository:
bash
```
git clone https://github.com/rajvansh-369/showBoat_CRUD_laravel.git
```

Install dependencies:
```
cd showBoat_CRUD_laravel
composer update

```
Configure the database:
Copy the .env.example file to .env:
```
cp .env.example .env
```


Open the .env file and update the database connection details with your own database credentials.

Run the database migrations:
```
php artisan migrate
```
Run the seeders:
```
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=StateSeeder
php artisan db:seed --class=DistrictSeeder

```
The seeders will populate the State and District tables with sample data.

Usage
To start the development server, run the following command:

```
php artisan storage:link
php artisan serve

```
The application will be accessible at http://localhost:8000.
```
Admin Details
Email: admin@showboat.com
Password: 123456
```
Please note that these are basic instructions to get the application up and running. You may need to adjust the steps based on your specific environment and requirements.
