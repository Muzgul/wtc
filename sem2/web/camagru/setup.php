<?php
	include "config.php";

	try {
		$conn = new PDO("mysql:host=localhost;dbname=mysql", $DB_USER, $DB_PASSWORD);
		// Error mode: exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE `dbMkMeMgc`";
		$conn->exec($sql);
		echo "[ DB CREATED ]<br/>";	
		$conn = null;
	}
	catch (PDOException $exception) {
	}

	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE `tbladmin` (
				`id` INT(8) PRIMARY KEY AUTO_INCREMENT,
				`login` VARCHAR(32) NOT NULL, 
				`email` VARCHAR(32) NOT NULL,
				`passwd` VARCHAR(256) NOT NULL,
				`verif` INT(2) DEFAULT '0')";
		$conn->exec($sql);
		echo "[ TABLE ADMIN CREATED ]" . PHP_EOL;
	}
	catch (PDOException $exception) {
	}
	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE `tblimg` (
				`id` INT(8) PRIMARY KEY AUTO_INCREMENT,
				`name` VARCHAR(64) NOT NULL, 
				`creator` VARCHAR(32) NOT NULL,
				`url` VARCHAR(64) NOT NULL,
				`likes` INT(8) DEFAULT '0')";
		$conn->exec($sql);
		echo "[ TABLE IMG CREATED ]<br/>";
		$conn = null;
	}
	catch (PDOException $exception) {
	}

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
?>