<?php
include "config.php";
$categorieid = null;
$sqlCategorie = "SELECT * FROM `categorie` ";
$resultatCategorie = $conn->query($sqlCategorie);
$sqlPlante = "SELECT * FROM `plante` ";
$resultatPlante = $conn->query($sqlPlante);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Categories.css">
    <title>Document</title>
</head>

<body>
    <div class="d-flex">
        <div class="aside border-end w-25 d-none d-sm-block ">
            <ul class=" d-flex flex-column d-flex p-4 m-4 gap-5">
                <li><a href="admin.php" class="text-dark fs-5 fw-bold text-decoration-none"><i class='bx bxs-grid-alt'></i>Dashboard</a>
                </li>
         

                <li><a href="plant.php" class="text-dark fs-5  fw-bold text-decoration-none"><i class='bx bxs-shopping-bag-alt'></i>Products</a>
                </li>
                <li><a href="category.php" class="text-dark fs-5  fw-bold text-decoration-none"><i class='bx bxs-shopping-bag-alt'></i>Categories</a>
                </li>
            </ul>
        </div>

        <div class=" d-flex justify-content-evenly align-items-center">
            <div class="card" style="width: 18rem;">

                <div class="card-body">
                    <p class="card-text">Total des visiteurs</p>
                    <h3>20M</h3>
                </div>
            </div>
            <div class="card" style="width: 18rem;">

                <div class="card-body">
                    <p class="card-text">Total des produits</p>
                    <h3>80 Un</h3>
                </div>
            </div>
            <div class="card" style="width: 18rem;">

                <div class="card-body">
                    <p class="card-text">Total des categories</p>
                    <h3>25 Un</h3>
                </div>
            </div>
        </div>


</body>

</html>