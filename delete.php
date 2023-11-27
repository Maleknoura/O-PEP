<?php
include_once "./config.php";

if (isset($_GET['id'])) {
    $idPlante = $_GET['id'];
    $sqlDelete = "DELETE FROM plante WHERE planteId = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $idPlante);
    echo $idPlante;
    if ($stmt->execute()) {
        header("Location: categories.php");
    } else {

        echo "Erreur lors de la suppression de la plante.";
    }
}
