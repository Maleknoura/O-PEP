<?php
include "config.php";

session_start();
if ($_SESSION) {
    $email = $_SESSION['email'];
    $select = $conn->prepare("SELECT * FROM userr WHERE Email = ?");
    $select->bind_param("s", $email);
    $select->execute();
    $result = $select->get_result();
    $row = $result->fetch_assoc();
    $id = $row['userId'];
}
// session_start();
$_SESSION['IDuser'] = $id;

// if (isset($_POST['0'])) {
//     $test = 0;
// } else if (isset($_POST['1'])) {
//     $test = 1;
// }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $role = $_POST["role"];
    $update_query = "UPDATE userr SET roleEmail = ? WHERE userId = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ii", $role, $id);
    $stmt->execute();
    $select->execute();
    $result = $select->get_result();
    $row = $result->fetch_assoc();

    if ($row['roleEmail'] == 1) {
        header("location: client.php");
        exit();
    } elseif ($row['roleEmail'] == 2) {
        header("location: admin.php");
        exit();
    } 
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <!-- <DIV>
        <h3 class="fixed-top text-center mt-3">Join Us To Fall In Love with Gardening </h3>
    </DIV> -->
    <section class="container mt-5">
        <div class=" row d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="images/admin.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <form action="" method="post">
                        <button class="buttonn" type="submit" name="role" value="2">Admin</button>
                    </form>

                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="images/client.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <form action="" method="post">
                        <button class="buttonn" type="submit" name="role"value="1" >Client</button>
                    </form>

                </div>
            </div>

        </div>



</body>

</html>