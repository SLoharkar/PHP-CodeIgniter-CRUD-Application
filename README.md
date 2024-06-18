# PHP CodeIgniter 3 CRUD Application

This repository contains a comprehensive CRUD (Create, Read, Update, Delete) application developed using PHP and CodeIgniter 3. The application demonstrates a well-structured MVC (Model-View-Controller) architecture with additional features for session management, validation, and security. It includes a `HomeController`, `CrudController`, `CrudService`, `CrudRepository`, and `DatabaseModel`, along with a Validation Helper and View Handling.

## Features

- **MVC Architecture**: Organized code structure for maintainability and scalability.
- **CRUD Operations**: Perform Create, Read, Update, and Delete operations.
- **Session Management**: Secure and efficient session handling.
- **Validation**: Extensive form validation using CodeIgniter's `form_validation`.
- **Security**: User passwords are stored using `password_hash` for enhanced security.
- **Unified Form**: Registration and update are managed through a single form.
- **Exception Handling**: Proper exception handling throughout the application.
- **Logging**: Specific logging for tracking application behavior.
- **Code Commenting**: Well-commented code for better understanding and maintainability.
- **Professional Project Structure**: Adheres to professional standards for project creation and management.

## Usage

### Register and Update Form

- **Register**: Access the registration form to create a new user. Passwords are securely hashed using `password_hash`.
- **Update**: Use the same form to update user information.

### CRUD Operations

- **Create**: Add new records to the database.
- **Read**: Retrieve and display records from the database.
- **Update**: Modify existing records in the database.
- **Delete**: Remove records from the database.

## Code Structure

- **Controllers**: Handle incoming requests and interact with services.
  - `HomeController`: Manages the Login, Register, and Logout operations.
  - `CrudController`: Manages CRUD operations and interactions with services.
- **Libraries**: Contain business logic and act as intermediaries between controllers and repositories.
  - `CrudService`: Handles the business logic for CRUD operations.
- **Models**: Represent database entities and handle data operations.
  - `CrudRepository`: Mediator of `CrudService` and `DatabaseModel`, managing data persistence and retrieval.
  - `DatabaseModel`: Contains all database-related operations.
  - **View Handler**: Manages the presentation layer of the application.
- **Helpers**: Provide utility functions for validation and other common tasks.
  - `Validation Helper`: Manages form validation related functions.

## Installation and Setup

### Prerequisites

- PHP (>= 7.4)
- MySQL
- Apache Server (or any compatible web server)

### Steps

1. **Clone the repository**:
   ```sh
   git clone https://github.com/SLoharkar/PHP-CodeIgniter-CRUD-Application.git
   cd PHP-CodeIgniter-CRUD-Application
   ```

2. **Configure the database**:
   - Create a database in MySQL.
   - Update the database configuration in `application/config/database.php` with your database credentials.

4. **Run the migrations**:
   - Import the `database.sql` file located in the root of the project to your MySQL database. This will create the necessary tables.

5. **Configure the base URL**:
   - Update the base URL in `application/config/config.php` to match your local or production environment.

6. **Start the application**:
   - Place the project in the web root directory of your server (e.g., `htdocs` for XAMPP).
   - Start the Apache server.
   - Access the application via your browser at `http://localhost/PHP-CodeIgniter-CRUD-Application`.

## Video Trailer

For a quick overview of the application, watch the video trailer below:

https://github.com/SLoharkar/PHP-CodeIgniter-CRUD-Application/assets/68845746/f20945c3-1262-4b18-a0b9-2c1d8703402e


