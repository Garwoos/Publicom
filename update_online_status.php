<?php
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

$id = $_POST['id'];
$status = $_POST['status'];

// Mettre à jour le statut 'Online' dans la base de données
$sql = "UPDATE message SET Online = ? WHERE idMessage = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $status, $id);

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
