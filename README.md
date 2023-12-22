# Brief-9-library-managment

# Library Management System - Enhanced

## Overview

The Enhanced Library Management System aims to modernize library management by adopting advanced architecture (MVC) to efficiently handle various functionalities.

## Features

### Backend Functionality

#### Authentication and Authorization:

- Secure user registration and login system.
- Role management: Administrator, User.

#### Book Management:

- Addition, modification, and deletion of books with detailed information.
- Tracking of available, borrowed, and reserved copies.

#### Reservations and Returns:

- Reservation process for available copies.
- Recording book returns.

#### Statistics and Reports:

- Statistics on most reserved books, most active members, etc.
- Monthly reports on library activity.

## User Stories

### Administrator:

- Register securely with an email and password.
- Secure login to access all system functionalities.
- Manage user roles, including administrator and visitor roles.
- Add new books to the catalog with necessary details.
- Modify information of existing books.
- Delete books from the catalog.
- View statistics on the most reserved books.
- Check statistics on the most active members.
- Generate monthly reports on library activity.
- Advanced search function by username, email, phone, etc.

### Authenticated User:

- Search for books in the catalog s.
- Borrow an available book and specify the reservation date if required.
- Record the return of a borrowed book.

## Project Structure

The project follows the MVC (Model-View-Controller) design pattern for better organization and separation of concerns:

- **Models:** Handle data logic and database interactions.
- **Views:** Manage the presentation layer and user interfaces.
- **Controllers:** Control application flow and handle user inputs.

## Installation and Usage

1. Clone the repository.
2. Set up your PHP environment.
3. Import the database schema provided (`schema.sql`).
4. Configure the database connection in the `config.php` file.
5. Run the application using a local server.

## Technologies Used

- PHP
- MVC design pattern
- DAO

## Contributing

Contributions are welcome! Feel free to fork the repository and create a pull request for any improvements or additional features.


## WebApp Link == https://mehdi-raji.com/views/auth/login.php

