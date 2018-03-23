<?php 
date_default_timezone_set('Asia/Dhaka');

$host = 'localhost';
$user = 'root';
$password = 'root';
$database = "matrika_lottery";




$db = mysqli_connect($host, $user, $password);
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create database
$sql="CREATE DATABASE IF NOT EXISTS matrika_lottery";
if (mysqli_query($db,$sql))
{
    echo "Database Created Successfully";
}
else
{
    echo "Error creating database: " . mysqli_error($db);
}


$link = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

echo "<br>";
//Create tabe applicants_bn
$q1 = "CREATE TABLE IF NOT EXISTS `applicants_bn` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(63) NOT NULL,
 `father` varchar(63) NOT NULL,
 `mother` varchar(63) NOT NULL,
 `bd` date NOT NULL,
 `roll` int(5) NOT NULL,
 `pic` varchar(128) NOT NULL,
 `marked` tinyint(1) NOT NULL DEFAULT '0',
 `add_dt` date NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `roll` (`roll`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8";

$r1 = mysqli_query($link, $q1);
if ($r1) {
    echo "Table applicants_bn created.";
} else {
    echo "Table applicants_bn couldn't be created.";
}

echo "<br>";

//Create tabe applicants_en
$q2 = "CREATE TABLE IF NOT EXISTS `applicants_en` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(63) NOT NULL,
 `father` varchar(63) NOT NULL,
 `mother` varchar(63) NOT NULL,
 `bd` date NOT NULL,
 `roll` int(5) NOT NULL,
 `pic` varchar(128) NOT NULL,
 `marked` tinyint(1) NOT NULL DEFAULT '0',
 `add_dt` date NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `roll` (`roll`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8";

$r2 = mysqli_query($link, $q2);
if ($r2) {
    echo "Table applicants_en created.";
} else {
    echo "Table applicants_en couldn't be created." . mysqli_error($link);
}


echo "<br>";

//create table result_bn
$q3 = "CREATE TABLE IF NOT EXISTS `result_bn` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `roll` int(5) NOT NULL,
 `name` varchar(64) NOT NULL,
 `father` varchar(64) NOT NULL,
 `mother` varchar(64) NOT NULL,
 `timestamp` datetime NOT NULL,
 `queue` varchar(16) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$r3 = mysqli_query($link, $q3);
if ($r3) {
    echo "Table result_bn created.";
} else {
    echo "Table result_bn couldn't be created." . mysqli_error($link);
}


echo "<br>";

//create table result_bn
$q4 = "CREATE TABLE IF NOT EXISTS `result_en` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `roll` int(5) NOT NULL,
 `name` varchar(64) NOT NULL,
 `father` varchar(64) NOT NULL,
 `mother` varchar(64) NOT NULL,
 `timestamp` datetime NOT NULL,
 `queue` varchar(16) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$r4 = mysqli_query($link, $q4);
if ($r4) {
    echo "Table result_en created.";
} else {
    echo "Table result_en couldn't be created." . mysqli_error($link);
}


echo "<br>";

//create table vacancy
$q5 = "CREATE TABLE IF NOT EXISTS `vacancy` (
 `vacancy_bn` int(4) NOT NULL,
 `vacancy_bn_sby` int(4) NOT NULL,
 `vacancy_en` int(4) NOT NULL,
 `vacancy_en_sby` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$r5 = mysqli_query($link, $q5);
if ($r5) {
    echo "Table vacancy created.";
} else {
    echo "Table vacancy couldn't be created." . mysqli_error($link);
}

}
?>