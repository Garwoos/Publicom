<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Se connecter">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        // Connexion à la base de données
        $conn = new mysqli("localhost", "root", "", "Publicom");

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Préparer la requête de sélection
        $sql = "SELECT mailUser, username, passwordUser FROM utilisateur WHERE mailUser = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($email, $username, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                // Démarrer une session
                $_SESSION['mailUser'] = $email;
                $_SESSION['username'] = $username;
                echo "Connexion réussie. Bienvenue, $username!";
                exit();
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet email.";
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>