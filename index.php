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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>OPEP</title>
</head>

<body>
    <!-- <header>
        <nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
            <a class="navbar-brand" href="#">
                <img src="/images/Capture d'écran 2023-11-25 165710.png" alt="" width="30px" height="20px">
            </a>

           
        </nav>
    </header> -->
    <section class="first mt-5">
        <div class="d-flex">
            <section>
                <img src="images/img3.jpg" alt="" width="400px" height="500">
            </section>

            <form action="" method="post">
                <h4 class="text-center mb-5">SIGN UP</h4>
                <input type="text" name="nom" placeholder="Nom"><br>
                <input type="text" name="prenom" placeholder="Prénom"><br>
                <input type="email" name="email" placeholder="Email"><br>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe"><br>
                <button type="submit" class="button">Register</button>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-H+K7U5CnXl1DghKcC3R1O9ZyT0eBJmR4BCmjf5fBWH8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofP+pL3uuU8P2gjk1zlv9Uvwwk1z21SdX" crossorigin="anonymous"></script>
</body>

</html>
