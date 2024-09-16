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
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer tous les messages
$sql = "SELECT * FROM message";
$data = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Messages</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Texte</th>
            <th>Lien</th>
            <th>Mail du créateur</th>
            <th>Online</th>
            <th>Modifier</th>
            <th>supprimer</th>
        </tr>
        <?php
                if ($data->num_rows > 0) {
                    // Afficher les données de chaque ligne
                    while($row = $data->fetch_assoc()) {
                        echo "<tr>
                        <td>" . $row["idMessage"]. "</td>
                        <td>" . $row["Title"]. "</td>
                        <td>" . $row["Text"]. "</td>
                        <td><a href='" . $row["lien"] . "'>" . $row["lien"] . "</a></td>
                        <td>" .$row["mailUser"]. "</td> <td>";
                        
                        // Afficher une checkbox pour le champ Online
                        if ($row["Online"]) {
                            echo "<input type='checkbox' checked disabled>";
                        } else {
                            echo "<input type='checkbox' disabled>";
                        }
                        
                        // Ajouter les boutons Modifier et Supprimer
                        echo "</td><td><a href='modifier.php?id=" . $row["idMessage"] . "'>Modifier</a></td>";
                        echo "<td><a href='#' onclick='confirmDelete(" . $row["idMessage"] . ")'>Supprimer</a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Aucun message trouvé</td></tr>";
                }
                $conn->close();
                ?>
            </table>
            <script>
            function confirmDelete(id) {
                if (confirm("Êtes-vous sûr de vouloir supprimer ce message ?")) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "supprimer.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            alert(xhr.responseText);
                            // Rafraîchir la page pour refléter les changements
                            location.reload();
                        }
                    };
                    xhr.send("id=" + id);
                }
            }
            </script>
</body>
</html> 