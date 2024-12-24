# DoggoCare
Pet Management System for rescue and adoption of dogs

This is a web developemnt project which makes use of HTML and CSS on frontend, and PHP and MySQL on backend.
A Database with necessary tables is created on MySQL Workbench and is used to store the data.

Steps to deploy this project on your system:
1. Clone this repository.
2. Open MySQL Workbench (install if not already installed) and create a new database.
3. Run the database.sql file in the database created. database.sql file contains the necessary commands for creation of all tables.
4. Open the cloned project folder and change the username and password in each of the .php files to your MySQL Workbench username and password respectively. (admin_details.php, admin_edit.php, admin_login.php, adopt_del.php, adoption.php, adoption_form.php, adoptions.php, donation.php, pet_display_edit.php, pet_edit.php, pet_veternary.php, rescue_2.php, veternary_details.php)
5. PHP can run only when hosted. To host it locally, you can use any software like XAMPP, WAMP, etc
6. The homepage of the website is homePage.html. So start by running homePage.html.

This project contains the following functionalities:
  User:
- Reporting a rescue dog by a rescuer.
- Adoption of a dog in the shelter cum rescue center.
- Donation of money to the shelter.

  Administrator
- View and edit pet details.
- View Adoption details.
- Add veternary details for pets.
- View Veternary details.
