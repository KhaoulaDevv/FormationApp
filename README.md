first execute DB script to create database and it's related user

next create an admin user

you should generate the password with https://onlinephp.io/password-hash
before inserting it into the database with the query :

INSERT INTO Users (username, password, role) VALUES ('admin_user', 'generated_password_hash', 'admin');

links :
Login http://localhost/FormationApp/views/public/login.php
Inscription : http://localhost/FormationApp/views/public/register.php
Admin dashboard : http://localhost/FormationApp/views/admin/dashboard.php
Contact : http://localhost/FormationApp/views/client/contact.php
Home page : http://localhost/FormationApp/views/client/home.php

