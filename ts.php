<?php
include "config.php";
$sqlPlante = "SELECT * FROM `plante` ";
$resultatPlante = $conn->query($sqlPlante);
$sql = "SELECT *FROM categorie";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultatCategories = $stmt->get_result();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $sql = "SELECT * FROM categorie";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultatCategories = $stmt->get_result();
} 

elseif (isset($_POST['searchPlante'])) {
    $searchPlante = '%' . $_POST['searchPlante'] . '%';
    $sqlPlante = "SELECT * FROM `plante` WHERE name LIKE ?";
    $stmtPlante = $conn->prepare($sqlPlante);
    $stmtPlante->bind_param('s', $searchPlante);
    $stmtPlante->execute();
    $resultatPlante = $stmtPlante->get_result();
}

session_start();
$id = $_SESSION['IDuser'];
echo $id;

if (isset($_POST['cart'])) {
    $plantid = $_POST['cart'];
    $inserttocart = $conn->prepare("INSERT INTO panier (userId,planteid) VALUES (?,?)");
    $inserttocart->bind_param("ii", $id, $plantid);
    $inserttocart->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Categories.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iK7l5lOpHvqZMFPeJUu78E+5WEMRN/RVHQ6sds9bpOyFSp3yVmwE+8mg" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtFZj5me1TDA" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">




    <!-- css links-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <section>
        <nav class="navbar">
            <div class="d-flex justify-content-end align-items-center">
                <div class="logo">
                    <a href="#"><img class="" src="./images/logo.jpg" alt="" width="130px"></a>
                </div>
            </div>
            <ul class="nav d-flex justify-content-between" id="menu">
                <li><a href="#">Home</a></li>
                <li class="mx-2"><a href="#">Products</a></li>
                <li><a href="#">Category</a></li>
            </ul>


            <a href="panier.php">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class='bx fs-2 bx-cart-add'></i>
                </button>
            </a>
            <form action="" method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by plant name" name="searchPlante">
                <button class="btn btn-outline-secondary" type="submit">Search Plants</button>
            </div>
        </form>

            <div class="burger" id="burger">
                <i class='bx bx-dots-horizontal-rounded'></i>
            </div>
        </nav>

        <div class="container mt-4">
       
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 ">
                    <h2 class="titlecl">All You Need is Plants</h2>
                    <p class="p1 mt-3">Dive into the calming and invigorating world of plants with our carefully curated collection. At our place, we firmly believe that all you need is plants. They bring a touch of green, a zen atmosphere, and positive energy to your living space.</p>
                </div>
                <div class="col-md-6 text-center">
                    <img class="img1 image-3d" src="./images/pllant3.jpg" alt="Plant Image" class="" w-25>
                </div>
            </div>
        </div>
        </div>
    </section>


    <div class=" mt-4">
            <h2 class="text-center" style="color: #bebebe;">Our Plants</h2>
            <div class="container mt-5">
                <div class="row d-flex justify-content-between align-items-center">
                    <?php
                    if ($resultatPlante->num_rows > 0) {
                        while ($rowPlante = $resultatPlante->fetch_assoc()) {
                            $namePlante = $rowPlante["name"];
                            $image = $rowPlante["image"];

                            $prix = $rowPlante["prix"];
                    ?>
                            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-9 mx-auto mt-3 my-2">
                                <div class="card" style="width: 17rem; height:20rem; border: none; border-radius: 10px; box-shadow: 0px 3px 5px 0px #010101;">
                                    <div class="card-body">
                                        <div class="col-md-1"></div>
                                        <h5 class="card-title text-center "><?php echo $namePlante; ?></h5>
                                        <img class="card-img w-100"mt-3 src="images/<?php echo $image; ?>" />
                                        <p class="card-text text-center mt-2">
                                            Prix: <?php echo $prix; ?>
                                        <form action="" method="POST">
                                            <button class="btn btn-success btnn " name="cart" type="submit" value="<?php echo $rowPlante['planteId'] ?>">Add to Cart</button>
                                        </form><br>


                                        </p>

                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Aucun résultat trouvé.";
                    }
                    ?>
                </div>




    </div>
    <div>
        <div class=" mt-4">
            <h2 class="text-center" style="color: #bebebe;">Our Plants</h2>
            <div class="container mt-5">
            <div class="row d-flex justify-content-between align-items-center">
            <?php
            if ($resultatPlante->num_rows > 0) {
                while ($rowPlante = $resultatPlante->fetch_assoc()) {
                    $namePlante = $rowPlante["name"];
                    $image = $rowPlante["image"];
                    $prix = $rowPlante["prix"];
            ?>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-9 mx-auto mt-3 my-2">
                        <div class="card" style="width: 17rem; height:20rem; border: none; border-radius: 10px; box-shadow: 0px 3px 5px 0px #010101;">
                            <div class="card-body">
                                <div class="col-md-1"></div>
                                <h5 class="card-title text-center "><?php echo $namePlante; ?></h5>
                                <img class="card-img w-100 mt-3" src="images/<?php echo $image; ?>" />
                                <p class="card-text text-center mt-2">
                                    Prix: <?php echo $prix; ?>
                                    <form action="" method="POST">
                                        <button class="btn btn-success btnn " name="cart" type="submit" value="<?php echo $rowPlante['planteId'] ?>">Add to Cart</button>
                                    </form><br>
                                </p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "Aucun résultat trouvé.";
            }
            ?>
        </div>
    </div>
        </div>
    </div>
                    <?php
                    if ($resultatPlante->num_rows > 0) {
                        while ($rowPlante = $resultatPlante->fetch_assoc()) {
                            $namePlante = $rowPlante["name"];
                            $image = $rowPlante["image"];

                            $prix = $rowPlante["prix"];
                    ?>
                            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-9 mx-auto mt-3 my-2">
                                <div class="card" style="width: 17rem; height:20rem; border: none; border-radius: 10px; box-shadow: 0px 3px 5px 0px #010101;">
                                    <div class="card-body">
                                        <div class="col-md-1"></div>
                                        <h5 class="card-title text-center "><?php echo $namePlante; ?></h5>
                                        <img class="card-img w-100"mt-3 src="images/<?php echo $image; ?>" />
                                        <p class="card-text text-center mt-2">
                                            Prix: <?php echo $prix; ?>
                                        <form action="" method="POST">
                                            <button class="btn btn-success btnn " name="cart" type="submit" value="<?php echo $rowPlante['planteId'] ?>">Add to Cart</button>
                                        </form><br>


                                        </p>

                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Aucun résultat trouvé.";
                    }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>