<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    $query = "SELECT * FROM userr WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        

        if (password_verify($password, $user['paassword'])) {
            session_start();
            
            
            if ($row["roleEmail"] == 1) {
                header("Location: admin.php");
               
                echo $user['roleEmail'];
                exit();
            } else {
                $_SESSION['userId'] = $row['iduser'];
                header("Location: client.php");
              
                exit();
            }
        } else {
            echo "$email ";
            echo "$password ";
           
        }
    } else {
        echo "Invalid email.";
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
    <section class="first mt-5">
        <div class="d-flex">
            <section>
                <img src="images/img3.jpg" alt="" width="400px" height="500">
            </section>

            <form action="login.php" method="post" class="mt-5">
                <h4 class="text-center mb-5">Login</h4>
                <input type="email" name="email" placeholder="Email" class="form-control mb-3">
                <input type="password" name="mot_de_passe" placeholder="Mot de passe"><br>
                <button type="submit" class="button">Login</button>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-H+K7U5CnXl1DghKcC3R1O9ZyT0eBJmR4BCmjf5fBWH8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofP+pL3uuU8P2gjk1zlv9Uvwwk1z21SdX" crossorigin="anonymous"></script>
</body>

</html>
