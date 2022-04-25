<?php

$host = "localhost";
$username = "tukarcoi_whatsapp";
$password = "Tikaluph1";
$db = "tukarcoi_whatsapp";
//error_reporting(0);
$koneksi = mysqli_connect($host, $username, $password, $db) or die("GAGAL");
$koneksi->set_charset('utf8mb4');
$base_url = "http://whatsapp.sidopulsa.com/";
date_default_timezone_set('Asia/Jakarta');
