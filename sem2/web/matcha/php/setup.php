<?php
	$DB_DSN = "mysql:host=localhost;dbname=matcha";
	$DB_USER = "root";
	$DB_PASSWORD = "cullygme";

	try {
		$conn = new PDO("mysql:host=localhost;dbname=mysql", $DB_USER, $DB_PASSWORD);
		// Error mode: exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE `matcha`";
		$conn->exec($sql);
		echo "[ DB CREATED ]<br/>";	
		$conn = null;
	}
	catch (PDOException $exception) {
		echo $exception;
	}

	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE `tbladmin` (
				`id` INT(8) PRIMARY KEY AUTO_INCREMENT,
				`usrname` VARCHAR(32) NOT NULL,
				`firstname` VARCHAR(32),
				`lastname` VARCHAR(32),
				`gender` VARCHAR(32),
				`sexpref` VARCHAR(256),
				`bio` VARCHAR(128),
				`interests` VARCHAR(128),
				`email` VARCHAR(32) NOT NULL,
				`passwd` VARCHAR(256) NOT NULL,
				`profpic` VARCHAR(256),
				`verif` INT(2) DEFAULT '0')";
		$conn->exec($sql);
		echo "[ TABLE ADMIN CREATED ]" . PHP_EOL;
	}
	catch (PDOException $exception) {
		echo $exception;
	}
	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE `tblimg` (
				`id` INT(8) PRIMARY KEY AUTO_INCREMENT,
				`name` VARCHAR(64) NOT NULL, 
				`creator` VARCHAR(32) NOT NULL,
				`url` VARCHAR(64) NOT NULL)";
		$conn->exec($sql);
		echo "[ TABLE IMG CREATED ]<br/>";
		$conn = null;
	}
	catch (PDOException $exception) {
	}
/*
	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE `tblimpose` (
				`id` INT(8) PRIMARY KEY AUTO_INCREMENT,
				`name` VARCHAR(32) NOT NULL, 
				`url` VARCHAR(64) NOT NULL)";
		$conn->exec($sql);
		echo "[ TABLE IMPOSE CREATED ]<br/>";
		$conn = null;
	}
	catch (PDOException $exception) {
	}

	if (!file_exists("../comments/"))
		mkdir("../comments/");
		*/
?>