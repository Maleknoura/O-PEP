<?php

include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES["productImg1"])) {
        insertProduct();
        // header("location: admin.php");
    }
}


function insertProduct()
{
    global $conn; // Assuming you have a MySQLi connection named $conn
    $img = $_FILES['productImg1']['name'];
    $size = $_FILES['productImg1']['size'];
    $tmp_name = $_FILES['productImg1']['tmp_name'];
    $error = $_FILES['productImg1']['error'];

    $nom = $_POST["Name1"];
    $besoin_specifiques= $_POST["besoin"];
    $saison_croisssance = $_POST["saison"];

    


    if ($error === 0) {
        if ($size > 4200000) {
            echo 'Sorry your file is too large. (max 4mb)';
            exit;
        } else {
            
            $img_ext = pathinfo($img, PATHINFO_EXTENSION);
            echo $img_ext;
            $img_ext_lc = strtolower($img_ext);

            $allowed_ext = array("jpg", "jpeg", "png", "webp", "avif");

            if (in_array($img_ext_lc, $allowed_ext)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ext_lc;
                $img_upload_path = 'images/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            } else {
                echo 'Unsupported format';
                exit;
            }
        }
    } else {
        $msg[] = 'Unknown error occurred';
        exit;
    }

    // Prepare the SQL statement
    $query = "INSERT INTO categorie (nom,img,besoin_specifiques,saison_croisssance) VALUES (?, ?, ?,?)";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param('ssss', $nom, $new_img_name, $besoin_specifiques,$saison_croisssance); // Change 'sisi' to 'sss'

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();
    header("location: category.php");
}
?>
