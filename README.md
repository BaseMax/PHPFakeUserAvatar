# PHP FakeUserAvatar - RESTful API Project

PHP FakeUserAvatar is an open and free RESTful API project built on PHP 8.2, designed to generate fake user information with avatars or without avatars. The project follows good and clean architecture principles and implements Object-Oriented Programming (OOP) and SOLID principles for maintainability and extensibility. It does not use the Laravel framework.

## API Routes

### Authentication

- `POST /api/login`: Authenticate users and receive an access token to access protected routes.
- `POST /api/register`: Register new users and receive an access token upon successful registration.

### API Key Management

- `GET /api/get-keys`: Retrieve a list of API keys associated with the authenticated user.
- `POST /api/create-key`: Create a new API key for the authenticated user.
- `DELETE /api/delete-key/{key_id}`: Delete the specified API key belonging to the authenticated user.

### Fake User Information

- `GET /api/get-fake-users`: Retrieve a list of 10-20 fake user information, including avatars if available.
- `GET /api/get-random-fake-user`: Retrieve a random fake user's information, including the avatar if available.

## Architecture and Structure

The project follows a well-organized architecture and adheres to OOP and SOLID principles to maintain a clean and extensible codebase. Here is an overview of the project structure:

```markdown
- app/
  - ApiKey/
    - ApiKey.php
  - Auth/
    - Auth.php
  - Controllers/
    - AuthController.php
    - Controller.php
    - FakeUserController.php
    - KeyController.php
  - Database/
    - Database.php
    - Seeder.php
  - Models/
    - ApiKey.php
    - FakeUser.php
    - User.php
  - Router/
    - Abort.php
    - Response.php
    - Router.php
  - Validator/
    - IsValidator.php
    - RequiredValidator.php
    - UniqueValidator.php
    - Validator.php
- public/
  - .htaccess
  - index.php
- tests/
- composer.json
- composer.lock
- codeception.yml
- .env
- backup.sql
- openapi.yaml
- README.md
```

The `app/` directory contains the main application logic, separated into different components:

- `ApiKey/`: Contains classes responsible for api key check.
- `Auth/`: Contains classes responsible for user authentication.
- `Controllers/`: Contains app controllers.
- `Database/`: Contains classes for database oprations.
- `Models/`: Contains app models.
- `Router/`: Contains router classes.
- `Validator/`: Contains data validator usefull for validating request data in controllers.

The `public/` directory contains the entry point `index.php` for the application.
The `tests/` directory contains test files.

## Installation and Setup

- You need a MySQL database up and running and create tables in database or you can simply just use database `backup.sql` in project root
- Clone the repository: `git clone https://github.com/BaseMax/PHPFakeUserAvatar`
- Install dependencies: `composer install`
- Autoload files: `composer dump-autoload -o`
- Configure the database connection and JWT secret in `.env`
- Run database seeders: `cd app/Database/ && php Seeder.php`
- Run project: `cd public/ && php -S localhost:8000`.
- App is available on `http://localhost:8000`

## Usage

- Make sure the project is set up correctly and the web server is running.
- Use API client software (e.g., Postman) to interact with the API endpoints listed above.

## CLI Testing

- Make sure the project is set up correctly and the web server is running.
- Run tests `php vendor/bin/codecept run`

### Login:

```bash
curl -X POST -H "Content-Type: application/json" -d '{"email": "test@example.com", "password": "password"}' http://localhost:8000/api/login
```

### Register:

```bash
curl -X POST -H "Content-Type: application/json" -d '{"name": "Test User", "email": "test@example.com", "password": "password"}' http://localhost:8000/api/register
```

### Get API Keys (Requires authentication):

```bash
curl -X GET -H "Authorization: Bearer YOUR_ACCESS_TOKEN" http://localhost:8000/api/get-keys
```

### Create New API Key (Requires authentication):

```bash
curl -X POST -H "Authorization: Bearer YOUR_ACCESS_TOKEN" http://localhost:8000/api/create-key
```

### Delete API Key (Requires authentication):

```bash
curl -X DELETE -H "Authorization: Bearer YOUR_ACCESS_TOKEN" http://localhost:8000/api/delete-key/YOUR_API_KEY
```

### Get 10-20 Fake User Information with Avatar or Without Avatar (Requires Api Key):

```bash
curl -X GET -H "APIKEY: YOUR_API_KEY" http://localhost:8000/api/get-fake-users
```

### Get Random Fake User Information with Avatar or Without Avatar (Requires Api Key):

```bash
curl -X GET -H "APIKEY: YOUR_API_KEY" http://localhost:8000/api/get-random-fake-user
```

Make sure to replace `http://localhost:8000` with the actual base URL of your API server, and `YOUR_ACCESS_TOKEN` and `YOUR_API_KEY` with valid access token and API key respectively, acquired from previous requests (e.g., login, create-key).

These curl commands will allow you to test the API routes directly from the command line. You can modify the request data as per your test scenarios. Additionally, you can use tools like jq to format and filter the JSON responses for better readability.

## Table

**Users Table:**

```sql
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

**API Keys Table:**

```sql
CREATE TABLE IF NOT EXISTS api_keys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    api_key VARCHAR(64) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

**Fake Users Table:**

```sql
CREATE TABLE IF NOT EXISTS fake_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    avatar_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Contributing

Contributions to this project are welcome! Please submit pull requests or raise issues for bug reports and feature requests.

## License

This project is licensed under the GPL-3.0 License. See the LICENSE file for more information.

# Disclaimer

The fake user information generated by this API is for testing and development purposes only and should not be used for any illegal activities. The developers and maintainers of this project are not responsible for any misuse of the generated data.

Copyright 2023, Max Base
