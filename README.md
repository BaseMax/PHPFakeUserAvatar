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
  - Auth/
    - Authentication.php
    - UserRepository.php
  - Key/
    - Key.php
    - KeyRepository.php
  - User/
    - User.php
    - UserRepository.php
  - Avatar/
    - Avatar.php
    - AvatarGenerator.php
  - Routes/
    - AuthRoutes.php
    - KeyRoutes.php
    - FakeUserRoutes.php
  - Helpers/
    - ApiResponse.php
    - AuthMiddleware.php
  - Config/
    - config.php
    - database.php
- public/
  - index.php
- .htaccess
- composer.json
- composer.lock
- .env
- README.md
```

The `app/` directory contains the main application logic, separated into different components:

- `Auth/`: Contains classes responsible for user authentication.
- `Key/`: Contains classes for API key management.
- `User/`: Contains classes related to user data.
- `Avatar/`: Contains classes for generating avatars for fake users.
- `Routes/`: Defines different API routes and their handlers.
- `Helpers/`: Contains helper classes and utilities.
- `Config/`: Holds configuration files for the application.

The `public/` directory contains the entry point `index.php` for the application.

## Installation and Setup

- Clone the repository: `git clone https://github.com/BaseMax/PHPFakeUserAvatar`
- Install dependencies: `composer install`
- Configure the database connection in `app/Config/database.php`
- Copy `.env.example` to `.env` and set your environment variables if necessary.
- Set up your web server (e.g., Apache) to point to the `public/` directory.

## Usage

- Make sure the project is set up correctly and the web server is running.
- Use API client software (e.g., Postman) to interact with the API endpoints listed above.

## Contributing

Contributions to this project are welcome! Please submit pull requests or raise issues for bug reports and feature requests.

## License

This project is licensed under the GPL-3.0 License. See the LICENSE file for more information.

# Disclaimer

The fake user information generated by this API is for testing and development purposes only and should not be used for any illegal activities. The developers and maintainers of this project are not responsible for any misuse of the generated data.

Copyright 2023, Max Base