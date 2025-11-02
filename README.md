# sugar-sensation-bakery-system
A system developed for my academic Study 
Overview
Sugar Sensation is a PHP-based Bakery Management System designed to digitalize bakery operations.
It allows admins to manage inventory, supply chains, and products while enabling customers to browse, order, and manage their accounts online.
This project is built as part of a Software Engineering coursework to demonstrate practical skills in web development, database management, and system design.

 Features
- Admin Module
  Add, update, and delete bakery products
  Manage inventory and supply chain
  View and respond to contact messages
  Manage delivery details
  Monitor customer orders and transactions

 - Customer Module
  Register and log in securely
  Browse and view bakery products
  Add items to a shopping cart
  Place orders and track delivery status
  Contact bakery staff via “Contact Us
  Interact with a bakery chatbot

- Reports & Dashboard
  Visual insights into product sales, orders, and inventory
  Data visualization using charts and graphs

 Technologies Used
Category	Technologies
Frontend	HTML, CSS, Bootstrap, JavaScript
Backend	PHP 
Database	MySQL
Server	XAMPP 
Visualization	Chart.js / Google Charts 

 System Modules

Home Page – Overview and featured products
Menu Page – Displays all available bakery items
About Us – Bakery story and brand details
Contact Us – User inquiries linked to customer database
Shopping Cart – Manage and confirm orders
Delivery Module – Tracks delivery and status updates
Admin Dashboard – Central hub for managing system data
Chatbot – Interactive bakery assistant (Java-based or integrated PHP bot)

 Installation Instructions
Prerequisites
XAMPP installed
Web browser
Git (optional)
MySQL database
Steps
Clone or Download this repository

git clone https://github.com/<yourusername>/sugar-sensation-bakery-system.git

Copy the folder to your local server directory:
For XAMPP: C:\xampp\htdocs\sugar-sensation

Import the database:
Open phpMyAdmin → Create a new database (e.g., sugarsensationbakery)
Import the file sugarsensationbakery.sql located in the project folder
Open databaseconnect.php and configure:
$conn = mysqli_connect("localhost", "root", "", "sugarsensationbakery");

Start Apache and MySQL from XAMPP Control Panel.

Visit the project in your browser:
 http://localhost/sugar-sensation

Login Details (Sample)
Role	Username	Password
Admin	admin	admin123

Author
Zoona Mufeed
BEng(Hons) Software engineering
zoonamufeed2022@gmail.com


