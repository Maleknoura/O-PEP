<?php
include_once "./config.php";


$idPlante = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM plante WHERE planteId = ?");
$stmt->bind_param("i", $idPlante);
$stmt->execute();
header("Location: plant.php");
