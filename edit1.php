<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_form"])) {

    $idToUpdate = $_GET["id"];

    $img = $_FILES['productImg']['name'];
    $size = $_FILES['productImg']['size'];
    $tmp_name = $_FILES['productImg']['tmp_name'];
    $error = $_FILES['productImg']['error'];
    $nom = $_POST['name'];
    $besoin_specifiques = $_POST['besoin_specifique'];
    $saison_croissance = $_POST['saison_croissance'];




    if ($error === 0) {
        if ($size > 4200000) {
            echo 'Sorry your file is too large. (max 4mb)';
            exit;
        } else {
            $img_ext = pathinfo($img, PATHINFO_EXTENSION);
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
        $msg[] = 'Unkown error occured';
        exit;
    }

    $sqlUpdate = "UPDATE categorie SET nom = ?, img = ?, besoin_specifiques	 = ?, saison_croisssance = ? WHERE categorieId = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssssi", $nom, $new_img_name, $besoin_specifiques, $saison_croissance, $idToUpdate);

    if ($stmt->execute()) {
        header("Location: category.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de la plante.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/edit.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <h3>Clean Air in Your Home</h3>
                <div class="card">

                    <form class="form-card" action="" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-evenly text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">categorie name<span class="text-danger">*</span></label>
                                <input type="text" id="fname" name="name" placeholder="Enter plant name">
                            </div>

                        </div>
                        <div class="row justify-content-evenly text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">besoin specifique<span class="text-danger">*</span></label>
                                <input type="text" id="text" name="besoin_specifique" placeholder="">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">saison de croissance<span class="text-danger">*</span></label>
                                <input type="text" id="text" name="saison_croissance" placeholder="">
                            </div>
                            <div class="form-group">


                                <div class="row justify-content-evenly text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">



                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input name="productImg" type="file" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="form-group col-sm-6">
                                            <button class="button3" type="submit" name="update_form" class="btn-block   ">Update</button>
                                        </div>
                                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

</html>