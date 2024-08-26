# Barber Shop Project

This repository contains the source code for the Barber Shop project, a dynamic and responsive web application designed to manage a barber shop's operations, including reservations, user management, and displaying work samples. The project demonstrates key web development practices, including front-end design, back-end development, and database integration.

## Directory Structure

### Assets

The `Assets` directory includes all the necessary static files for the frontend of the application:

- **css/**: Stylesheets that control the visual presentation of the website.
  - **style.css**: The primary stylesheet for the entire website.
  - **login.css**: Styles specifically for the login page.

- **images/**: A collection of images used throughout the website, including banners, icons, and photos of barbers and work samples.

- **js/**: JavaScript files that add interactivity to the web pages.
  - **angular/**: Contains AngularJS libraries for client-side scripting.
  - **barber_shop.js**: Core script managing the barber shop's web functionalities.
  - **main.js**: General JavaScript functions for the website's UI.

### Configs

- **config.php**: The configuration file for managing the database connections and other backend settings essential for the application’s operation.

### Models

The `Models` directory contains PHP scripts that represent the data structures and database interactions of the application:

- **barberShop.php**: Manages the barber shop's details.
- **user.php**: Handles user-related data and interactions.
- **reservation.php**: Manages the reservation system.
- **workSample.php**: Handles data related to the barber shop's work samples.

### Uploads

The `Uploads` directory stores files uploaded to the server, categorized by their use:

- **admin/**: Contains admin-uploaded photos.
- **barbershop/**: Stores the barber shop's logo and photos.
- **models/**: Photos related to models used by the barber shop.
- **worksamples/**: Contains images of work samples displayed on the website.

### Views

The `Views` directory contains the HTML templates used to render different pages of the website:

- **shared/**: Includes reusable components like the header, footer, and menu.
- **index.html**: The main landing page of the website.
- **login.html**: The login page for users and admins.
- **adminPanel.html**: The admin panel for managing the barber shop operations.
- **reserve.html**: The reservation page where users can book appointments.

### PHP Scripts

Key PHP scripts that handle the backend logic and interact with the database:

- **database.php**: Manages database connections.
- **login.php**: Handles user and admin login functionality.
- **register.php**: Manages user registration.
- **reserve.php**: Processes reservation requests.

### SQL

- **barber_shop.sql**: The SQL file used to set up the initial database structure for the project, including tables for users, reservations, and work samples.
