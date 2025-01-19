# Project Setup Instructions

This file contains all the instructions you need to set up the project on your local machine.

Before running the project, ensure you have the following software installed on your machine:

 **[XAMPP/WAMP/MAMP](https://www.apachefriends.org/index.html)**:
   - Used to run the Apache server and MySQL database locally.
   - Download and install the appropriate version for your operating system.
   - PHP is required to run the backend code of this project.
   - XAMPP, WAMP, or MAMP comes with PHP pre-installed.
   - MySQL is the database system used in this project. XAMPP, WAMP, or MAMP also provides MySQL.

   ## Setup Instructions
   Follow these steps to set up the project:

 1. Clone the Repository
 2.Set Up XAMPP/WAMP/MAMP 
 If you're using XAMPP, WAMP, or MAMP, launch the Control Panel and start the following services:
 Apache (for the server)
 MySQL (for the database)
 Make sure both services are running before you proceed.
3.Configure Database Settings
/constant.php
<?php
    $servername = "localhost";  // For local setup, 'localhost' works
    $username = "root";         // Default username for MySQL in XAMPP/WAMP/MAMP is 'root'
    $password = "";             // Default password for MySQL in XAMPP/WAMP/MAMP is empty
    $dbname = "user_system";    // Database name (ensure you create this database in MySQL)
?>
 update it according to your local setup
 4. Create the Database