# Setup Guide

## Prerequisites

Before you begin, ensure you have met the following requirements:

- **PHP** >= 8.0
- **Composer** (Dependency Manager for PHP)
- **MySQL** or another supported database

## Installation Steps

1. **Clone the Repository**

   Clone the project repository to your local machine:

   ```bash
   git clone https://github.com/phonixcode/hms.git
   cd hms

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up your environment file**:
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key**:
   ```bash
   php artisan key:generate
   ```

5. **Configure your database**: 
   Open the `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Configure your email**: 
   Open the `.env` file and set your email credentials:
   ```env
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=
    MAIL_PASSWORD=
    MAIL_FROM_ADDRESS="hello@example.com"
   ```

6. **Run database migrations**:
   ```bash
   php artisan migrate
   ```

7. **(Optional) Seed the database**: 
   You can seed your database with initial data using:
   ```bash
   php artisan db:seed
   ```

### Project Structure

- **Controllers**: Contains the API logic for handling requests and responses.
- **Models**: Represents the database entities.
- **Requests**: Handles validation of incoming requests.
- **Traits**: Contains reusable methods (e.g., `ApiResponseTrait` for consistent API responses).
- **Exceptions**: Custom exception handling.
- **Routes**: API routes are defined in the `routes/api.php` file, providing endpoints for transactions and users.

### API Endpoints

check the complete documentation here [Documentation](https://documenter.getpostman.com/view/36429449/2sAY4rGRKv).
