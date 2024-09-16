<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Publicom";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
	$id = intval($_POST['id']);
	$sql = "DELETE FROM message WHERE idMessage = $id";

	if ($conn->query($sql) === TRUE) {
		echo "Message supprimé avec succès";
	} else {
		echo "Erreur lors de la suppression du message : " . $conn->error;
	}
} else {
	echo "ID de message non fourni.";
}

$conn->close();
?>