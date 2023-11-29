<?php
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $sql = "INSERT INTO userr (nom, prenom, Email, paassword) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe_hache')";
    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION["email"] = $email;
        header("location: role.php");
        exit();
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="loginn">
<section class="first2 mb-5">
   
<form action="" method="post">
                <h4 class="text-center mb-5">Login</h4>
                <input type="email" name="email" placeholder="Email"><br>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe"><br>
                <button type="submit" class="button">Register</button>
            </form>
            </div>
</section>
</body>
</html>