<?php
	$servername = "localhost";
	$username = "root";
	$password = "cullygme";
	$dbname = "dbMkMeMgc";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=mysql", $username, $password);
		// Error mode: exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE `dbMkMeMgc`";
		$conn->exec($sql);
		echo "[ DB CREATED ]<br/>";	
		$conn = null;
	}
	catch (PDOException $exception) {
		echo "[ DATABASE FAIL: " . $exception->getMessage() . " ]<br/>";
	}

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE `tbladmin` (
				`id` INT(8) PRIMARY KEY,
				`login` VARCHAR(32) NOT NULL, 
				`email` VARCHAR(32) NOT NULL,
				`passwd` VARCHAR(256) NOT NULL,
				`verif` INT(2) DEFAULT '0')";
		$conn->exec($sql);
		echo "[ TABLE ADMIN CREATED ]" . PHP_EOL;
		$sql = "CREATE TABLE `tblimg` (
				`id` INT(8) PRIMARY KEY,
				`name` VARCHAR(32) NOT NULL, 
				`creator` VARCHAR(32) NOT NULL,
				`url` VARCHAR(64) NOT NULL,
				`likes` INT(8) DEFAULT '0')";
		$conn->exec($sql);
		echo "[ TABLE IMG CREATED ]<br/>";
		$conn = null;
	}
	catch (PDOException $exception) {
		echo "[ TABLE FAIL: " . $exception->getMessage() . " ]<br/>";
	}

	if (!file_exists("../comments/"))
		mkdir("../comments/");
?>