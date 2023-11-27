<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_form"])) {
    
    $idToUpdate = $_GET["id"];
    $newName = $_POST["plant_name"];
    $newImage = $_FILES["image"]["tmp_name"];
    $newCategoryId = $_POST["plant_cat"];

    $sqlUpdate = "UPDATE plante SET name = ?, image = ?, id_pn = ? WHERE planteId = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssii", $newName, $newImage, $newCategoryId, $idToUpdate);

    if ($stmt->execute()) {
        header("Location: categories.php");
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
                                <label class="form-control-label px-3">Plant name<span class="text-danger">*</span></label>
                                <input type="text" id="fname" name="plant_name" placeholder="Enter plant name">
                            </div>

                        </div>
                        <div class="row justify-content-evenly text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Price<span class="text-danger">*</span></label>
                                <input type="text" id="text" name="plant_price" placeholder="">
                            </div>
                            <div class="form-group">


                                <div class="row justify-content-evenly text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label for="category">category</label>
                                        <input type="text" id="text" name="plant_cat" placeholder="">


                                        <div class="form-group">
    <label for="image">Image</label>
    <input name="image" type="file" class="form-control">
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