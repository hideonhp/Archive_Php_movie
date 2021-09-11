<?php
ob_start();
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");

try {
     $con = new PDO("mysql:dbname=movie;host=localhost", "root", "123456");
     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
     exit("Connect failed" . $e->getMessage());
}
