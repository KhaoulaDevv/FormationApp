-- Create the database
CREATE DATABASE IF NOT EXISTS FormationsApp CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE FormationsApp;

-- Table: Pays (Country)
CREATE TABLE Pays (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pays_name VARCHAR(100) NOT NULL
);

-- Table: Ville (City)
CREATE TABLE Ville (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ville_name VARCHAR(100) NOT NULL,
    pays_id INT NULL,
    FOREIGN KEY (pays_id) REFERENCES Pays(id) ON DELETE SET NULL
);

-- Table: Domaine
CREATE TABLE Domaine (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domaine_name VARCHAR(100) NOT NULL,
    description TEXT
);

-- Table: Sujet (Subject)
CREATE TABLE Sujet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sujet_name VARCHAR(100) NOT NULL,
    shortDescription TEXT,
    longDescription TEXT,
    individualBenefit TEXT,
    businessBenefit TEXT,
    logo VARCHAR(255),
    domaine_id INT NULL,
    FOREIGN KEY (domaine_id) REFERENCES Domaine(id) ON DELETE SET NULL
);

-- Table: Cours (Course)
CREATE TABLE Cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cours_name VARCHAR(100) NOT NULL,
    content TEXT,
    description TEXT,
    audience VARCHAR(255),
    duration INT,
    testIncluded BOOLEAN,
    testContent TEXT,
    logo VARCHAR(255),
    sujet_id INT NULL,
    FOREIGN KEY (sujet_id) REFERENCES Sujet(id) ON DELETE SET NULL
);

-- Table: Formateur (Trainer)
CREATE TABLE Formateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    description TEXT,
    photo VARCHAR(255)
);

-- Table: FormationDate
CREATE TABLE FormationDate (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL
);

-- Table: Users
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client') NOT NULL
);

-- Table: Formation (Training Program)
CREATE TABLE Formation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price DECIMAL(10, 2),
    mode ENUM('présentiel', 'distanciel'),
    cours_id INT NULL,
    formateur_id INT NULL,
    formation_date_id INT NULL,
    ville_id INT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(id) ON DELETE SET NULL,
    FOREIGN KEY (ville_id) REFERENCES Ville(id) ON DELETE SET NULL,
    FOREIGN KEY (formateur_id) REFERENCES Formateur(id) ON DELETE SET NULL,
    FOREIGN KEY (formation_date_id) REFERENCES FormationDate(id) ON DELETE SET NULL
);

-- Table: Inscription (Registration)
CREATE TABLE Inscription (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    company VARCHAR(100),
    paid BOOLEAN DEFAULT FALSE,
    formation_id INT NULL,
    user_id INT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE SET NULL,
    FOREIGN KEY (formation_id) REFERENCES Formation(id) ON DELETE SET NULL
);
