<?php

?>

<html<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Page PHP</title>
</head>
<body>
    <h1>Bienvenue sur ma page PHP</h1>
    <p>Ceci est un paragraphe de démonstration.</p>
    <p>La date et l'heure actuelles sont : 
        <?php
            echo date('Y-m-d H:i:s');
        ?>
    </p>
<h1>Page d'inscription</h1>
<form action="index.php" method="post">
    <label for="username">Nom d'utilisateur:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Mot de passe:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="S'inscrire">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Ici, vous pouvez ajouter du code pour enregistrer les données dans une base de données

    echo "<h2>Inscription réussie!</h2>";
    echo "<p>Nom d'utilisateur: $username</p>";
    echo "<p>Email: $email</p>";
}
?>
</body>
</html>