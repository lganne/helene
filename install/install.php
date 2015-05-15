<?php
$link=mysqli_connect('localhost', 'root', 'Vega2014*') or die("pb connexion");

// réinitialisation
$link->query("
        DROP DATABASE IF EXISTS heko;
        ") or die("drop database impossible");

$link->query("
        DELETE FROM mysql.user WHERE user='lganne' and host='localhost';
        ") or die("drop user impossible");

$link->query(
        "CREATE DATABASE IF NOT EXISTS `heko` DEFAULT CHARACTER SET utf8 "
        . "COLLATE utf8_general_ci;"
        ) or die("pb create database heko");

echo "ok database \n <br>";


$link->query(
        "GRANT ALL PRIVILEGES ON heko.* to 'lganne'@'localhost' IDENTIFIED BY
'Helene2015*' WITH GRANT OPTION;"
        ) or die("impossible de créer l'utilisateur lganne");

echo "Ok new user \n <br>";
mysqli_close($link);

$link=mysqli_connect('localhost', 'lganne', 'Helene2015*', 'heko') or die("pb connexion");

// table users
$link->query("
        CREATE TABLE `users` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
        `username` VARCHAR(30) NOT NULL,
        `password` VARCHAR(100) NOT NULL,
        `role` ENUM('administrator', 'editor', 'visitor') NOT NULL DEFAULT 'visitor',
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table users");
echo "Ok table user \n <br>";

// table menu
$link->query(
        "CREATE TABLE  `menu` (
        `id` INT UNSIGNED AUTO_INCREMENT,
        `nom` VARCHAR(30) NOT NULL,
         `categorie` ENUM ('menu','sous_menu') NOT NULL DEFAULT 'menu',
         PRIMARY KEY (`id`)
          ) ENGINE=InnoDB  AUTO_INCREMENT=1 ;"
        ) or die("pb create table menu");

echo "Ok table menu \n <br>";
// table contenu 
$link->query(
        "CREATE TABLE IF NOT EXISTS `contenu` (
        `id` INT UNSIGNED AUTO_INCREMENT,
        `menu_id` INT UNSIGNED,
        `title` VARCHAR(30) NOT NULL,
        `excerpt` TEXT NOT NULL,
        `content` TEXT NOT NULL,
        `date_created` DATETIME,
        `status` ENUM('publish', 'unpublish', 'draft', 'trash') NOT NULL DEFAULT 'publish',
        PRIMARY KEY (`id`),
        CONSTRAINT `fk_contenu_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu`(`id`) ON DELETE SET NULL
      ) ENGINE=InnoDB  AUTO_INCREMENT=1 ;"
        ) or die("pb create table contenu");

echo "Ok table contenu \n <br>";
// seed tables
$link->query("
        INSERT INTO users (`username`, `password`, `role`) VALUES 
        ('lganne', 'lganne', 'administrator'), ('helene', 'helene', 'editor');
        ")or die("pb insert data users");
