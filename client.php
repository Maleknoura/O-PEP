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
    if (isset($_POST['searchPlante'])) {
        $searchPlante = '%' . $_POST['searchPlante'] . '%';
        $sqlPlante = "SELECT * FROM `plante` WHERE name LIKE ?";
        $stmtPlante = $conn->prepare($sqlPlante);
        $stmtPlante->bind_param('s', $searchPlante);
        $stmtPlante->execute();
        $resultatPlante = $stmtPlante->get_result();
    }
}

session_start();


if (empty($_SESSION['IDuser'])) {
    $id = $_SESSION['IDuser'];
    header("Location: login.php");
}

if (isset($_POST['cart'])) {
    $plantid = $_POST['cart'];
    $id = $_SESSION['IDuser'];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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
        <nav class="navbar mx-4">
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


            <div class="burger" id="burger">
                <i class='bx bx-dots-horizontal-rounded'></i>
            </div>





            <div class="flex-shrink-0 dropdown mr-5">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </a>
                <ul class="dropdown-menu text-small shadow w-25">

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="signout.php">Sign out</a></li>
                </ul>
            </div>
        </nav>

        <div class="container mt-4">

            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 ">
                    <h2 class="titlecl">All You Need is Plants</h2>
                    <p class="p1 mt-3">Dive into the calming and invigorating world of plants with our carefully curated collection. At our place, we firmly believe that all you need is plants. They bring a touch of green, a zen atmosphere, and positive energy to your living space.</p>
                </div>
                <div class="col-md-4">
                    <img class="img1 " src="./images/pllant3.jpg" alt="" class="" style="width:40vw ;height:50vh;">
                </div>
            </div>
        </div>
        
    </section>
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-9 mx-auto mt-3 my-2">
        <form action="" method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by plant name" name="searchPlante" ">
        <button class=" btn btn-outline-secondary" type="submit">Search Plants</button>
            </div>
    </div>
    </form>


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
                            <div class="card" style="width: 17rem; height:20rem; border: none; border-radius: 10px; box-shadow: 0px 20px 20px 0px #bebebe;">
                                <div class="card-body">
                                    <div class="col-md-1"></div>
                                    <h5 class="card-title text-center "><?php echo $namePlante; ?></h5>
                                    <img class="card-img w-100" mt-3 src="images/<?php echo $image; ?>" />
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
                                    <div class="card" style="width: 17rem; height:20rem; border: none; border-radius: 10px; box-shadow: 0px 20px 20px 0px #bebebe;">
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
                            <img class="card-img w-100" mt-3 src="images/<?php echo $image; ?>" />
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
    <div class=" mt-4">
    <h2 class="text-center" style="color: #bebebe;">Our Categories</h2>
    <div class="container mt-5" style="right: 240px;">
        <div class="row d-flex justify-content-between align-items-center">
        <div class="row d-flex justify-content-around align-items-center">
        <div class="container">
            
    <a href="client.php"<?php echo !isset($_GET['filter']) ? ' class="btn btn-outline-secondary active"' : ' class="btn btn-outline-secondary"'; ?>>View All</a>

    <a href="client.php?filter=herbes"<?php echo isset($_GET['filter']) && $_GET['filter'] == 'herbes' ? ' class="btn btn-outline-secondary active"' : ' class="btn btn-outline-secondary"'; ?>>Herbes </a>

    <a href="client.php?filter=arbres"<?php echo isset($_GET['filter']) && $_GET['filter'] == 'arbres' ? ' class="btn btn-outline-secondary active"' : ' class="btn btn-outline-secondary"'; ?>>Arbres </a>

   
</div>
 



            </div>
            <?php
         
            $sqlCategories = "SELECT * FROM categorie";

            
            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];
                if ($filter == 'arbres') {
                    $sqlCategories .= " WHERE categorieID = 1";
                } elseif ($filter == 'herbes') {
                    $sqlCategories .= " WHERE categorieID  = 4";
                }
            }

            // Exécution de la requête seulement si le filtre n'est pas présent
            if (!isset($_GET['filter']) || (isset($_GET['filter']) && $_GET['filter'] == 'herbes')|| $_GET['filter'] == 'arbres') {
                $stmtCategories = $conn->prepare($sqlCategories);
                $stmtCategories->execute();
                $resultatCategories = $stmtCategories->get_result();

                if ($resultatCategories->num_rows > 0) {
                    while ($rowCategorie = $resultatCategories->fetch_assoc()) {
                        $nomCategorie = $rowCategorie["nom"];
                        $saisonCroissance = $rowCategorie["saison_croisssance"];
                        $besoinSpecifique = $rowCategorie["besoin_specifiques"];
                        $img = $rowCategorie["img"];
            ?>
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-9 mx-auto mt-3 my-2 ">
                            <div class="card" style="width: 17rem;height:20rem; border: none; border-radius: 10px; box-shadow: 0px 20px 20px 0px #bebebe;">
                                <div class="card-body">
                                    <div class="col-md-1"></div>
                                    <h5 class="card-title text-center mt-2"><?php echo $nomCategorie; ?></h5>
                                    <img class=" card-img w-100  " src="<?php echo $img; ?>" />
                                    <p class="card-text text-center mt-4">
                                        Saison de Croissance : <?php echo $saisonCroissance; ?><br>
                                        Besoin Spécifique : <?php echo $besoinSpecifique; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo "Aucune catégorie n'a été trouvée.";
                }
            }
            ?>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>