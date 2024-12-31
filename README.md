# Laravel API Setup Guide

This guide provides step-by-step instructions to set up and run your Laravel API project and test it using Postman.

---

## Setup Instructions

```bash
# Step 1: Clone the Repository
git clone https://github.com/joseneves-dev/agilecontent.git

# Step 2: Install Dependencies
composer install

# Step 3: Generate the Application Key
php artisan key:generate

# Step 4: Configure the Database
# You must create a .env file in the project root. Copy the .env.example file and update the following details with your database settings:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=database_user
DB_PASSWORD=database_password

# Step 5: Run Migrations and Seed the Database
php artisan migrate
php artisan db:seed

# Step 6: Start the Development Server
php artisan serve

---

### Testing with Postman

# Login Endpoint
# URL: http://127.0.0.1:8000/api/login
# Method: POST
{
  "email": "string",
  "password": "string"
}

# Register Endpoint
# URL: http://127.0.0.1:8000/api/register
# Method: POST
{
  "name": "string",
  "email": "string",
  "password": "string",
  "password_confirmation": "string",
  "countryId": "number (1 to 10)"
}

# For subsequent requests, use:
# Auth Type: Bearer Token (use the token from login)
# Header: "Accept": "application/json"

# Show User Endpoint
# URL: http://127.0.0.1:8000/api/user/show
# Method: GET

# Update User Endpoint
# URL: http://127.0.0.1:8000/api/user/update
# Method: PUT (returns 403 Forbidden if user is inactive)
{
  "name": "string",
  "email": "string",
  "password": "string",
  "password_confirmation": "string",
  "countryId": "number (1 to 10)"
}

# Delete User Endpoint
# URL: http://127.0.0.1:8000/api/user/delete
# Method: DELETE


