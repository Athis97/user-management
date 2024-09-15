# User Management API in Laravel 10

![Register user](https://github.com/user-attachments/assets/aa478ff9-c967-4081-b11b-ed369336f8e6)
![Login](https://github.com/user-attachments/assets/1078e75a-41a9-447d-8c68-b1d73da0a6c3)
![show single user](https://github.com/user-attachments/assets/69b00189-6f50-4360-b6c1-108dbf9bcb52)

## Overview

This project is a **User Management API** built using **Laravel 10**. It provides functionalities for user registration, login, and CRUD operations on user data. The API is protected by JWT-based authentication and throttling to ensure secure access.

SQLite was used as the database for simplicity, and test cases have been implemented for the various endpoints.

## Features

- **User Registration**: Allows users to register with details like name, email, password, location, etc.
- **User Login**: Enables users to log in and get a JWT token for authenticated access.
- **User CRUD**:
  - View all users
  - View a single user by ID
  - Update user details
  - Delete a user
- **Throttling**: Rate limiting for API endpoints (60 requests per minute).
- **Logging**: Request and response details are logged using a custom middleware.
- **Test Cases**: Feature tests for all API endpoints.

## API Endpoints

- `POST /api/register`: Registers a new user.
- `POST /api/login`: Logs in a user and returns a JWT token.
- `GET /api/users`: Retrieves a list of all users (authenticated).
- `GET /api/users/{id}`: Retrieves a single user by ID (authenticated).
- `PUT /api/users/{id}`: Updates a user's information (authenticated).
- `DELETE /api/users/{id}`: Deletes a user by ID (authenticated).

## Prerequisites

- PHP (>= 8.0)
- Composer
- Laravel 10
- SQLite (for database)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/Athis97/user-management.git
    cd user-management-api
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Configure the database for SQLite:
    ```env
    DB_CONNECTION=sqlite
    ```

4. Run the database migrations:
    ```bash
    php artisan migrate
    ```

5. Generate the JWT secret key:
    ```bash
    php artisan jwt:secret
    ```

6. Start the development server:
    ```bash
    php artisan serve
    ```

The API should now be running at `http://127.0.0.1:8000`.

## Code Structure

- **Routes**: Defined in `routes/api.php`.
- **Controllers**: API logic is managed by `UserController.php`.
- **Models**: `User.php` represents the user data structure.
- **Middleware**: A custom logging middleware logs request and response data.
- **Tests**: Feature tests are in `tests/Feature/UserTest.php`.

## Project Structure

```bash
app/
├── Http/
│   ├── Controllers/
│   │   └── UserController.php
├── Middleware/
│   └── LogRequest.php (Custom logging middleware)
├── Models/
│   └── User.php
database/
├── migrations/
tests/
├── Feature/
│   └── UserTest.php
routes/
└── api.php
```

## Testing

This project includes feature tests for the API endpoints. To run the tests, use the following command:

```bash
php artisan test
```

![Testing result](https://github.com/user-attachments/assets/8e445615-cb3d-42ba-94fe-87bddf3de177)

## Example API Requests

### Register User

```http
POST /api/register
Content-Type: application/json

{
    "first_name": "John",
    "last_name": "Doe",
    "role": "Admin",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password",
    "location": {
        "latitude": 37.7749,
        "longitude": -122.4194
    },
    "dob": "1990-01-01",
    "timezone": "UTC"
}
```

### Login User

```http
POST /api/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password"
}
```

### Get Users (Authenticated)

```http
GET /api/users
Authorization: Bearer {token}
```

### Contact

For any questions or feedback, feel free to reach out via [trichyathis@gmail.com].
