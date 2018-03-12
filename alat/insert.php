<?php
$host = 'carepolserver.mysql.database.azure.com';
$username = 'carepol@carepolserver';
$password = 'Unikom123*';
$db_name = 'carepol';

//Establishes the connection

$conn = mysqli_init();
mysqli_ssl_set($conn,NULL,NULL, "/var/www/html/BaltimoreCyberTrustRoot.crt.pem", NULL, NULL) ;
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}


if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}

$key = $_POST['key_alat'];

$sql = "INSERT INTO parameter (key_alat) VALUES($key)";

$query = mysqli_query($conn, $sql);

if ($query) {
  echo "berhasil";
}else{
  die ('SQL Error: ' . mysqli_error($conn));
}
 ?>
