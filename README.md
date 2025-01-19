Signup and Login System for Web Application

Project Overview
This project implements a Signup and Login system for a web application, where users can register and authenticate to access different sections of the site based on their roles. The system features role-based redirection, where users are directed to different dashboards based on their assigned role—either as a user or as an admin.

The web application consists of two main parts:

Signup Page: Allows users to register by providing their username, email, password, and role (user or admin).

Login Page: Enables users to log in with their credentials and redirects them based on their role after successful authentication.

Key Features:
Signup functionality: Users can create an account by providing their credentials (username, email, password, and role).
Login functionality: Authenticates users with username/email and password, redirecting them to appropriate pages based on their role:
User Role: Redirects to the user dashboard (users/dashboard.php).
Admin Role: Redirects to the admin dashboard (admin/dashboard.php).
Password hashing: User passwords are hashed using a secure algorithm (e.g., bcrypt or Argon2) to enhance security.
Database integration: User information is stored securely in a MySQL database.
Role-based access control: Different content is displayed to users based on their roles.

Technologies Used:
Frontend:HTML,CSS,JavaScript
Backend:PHP (for handling server-side logic)
Database:
MySQL (for storing user data)
PHPMyAdmin (for managing the MySQL database)
Password hashing: bcrypt or Argon2 (for secure password storage)
