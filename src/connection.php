<meta charset="utf-8">
<?php

$servername = "localhost";
$username = "root";
$password = "coderslab";
$basename = "twitter";

//Tworzenie nowego połączenia
$conn = new mysqli($servername, $username, $password, $basename);

//sprawdzenie poprawności połączenia
if ($conn->connect_error) {
    die("Błąd przy polączeniu do bazy danych: $conn->connect_error");
}
$conn->set_charset("utf8");