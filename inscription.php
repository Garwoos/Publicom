<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Publicom";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
echo "Connexion réussie"; 
echo "<p><a href='connexion.php'>Cliquez ici pour vous connecter</a></p>"
?>

<!DOCTYPE html>
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
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

    // Préparer la requête d'insertion
    $sql = "INSERT INTO utilisateur (username, mailUser, passwordUser) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Nouvel enregistrement créé avec succès";
    } else {
        echo "Erreur : " . $stmt->error;
    }
    echo "<h2>Inscription réussie!</h2>";
    echo "<p>Nom d'utilisateur: $username</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Mot de passe: $password</p>";

    // Fermer la connexion
    $stmt->close();
}
$conn->close();
?>
</body>
</html>