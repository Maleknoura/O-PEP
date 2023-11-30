<?php
include "config.php";
$sqlPlante = "SELECT * FROM `plante` ";
$resultatPlante = $conn->query($sqlPlante);
$sql = "SELECT *FROM categorie";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultatCategories = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Categories.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iK7l5lOpHvqZMFPeJUu78E+5WEMRN/RVHQ6sds9bpOyFSp3yVmwE+8mg" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtFZj5me1TDA" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- css links-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <title>Document</title>


</head>
<body>
    
    <div class="d-flex">
        <div class="aside border-end w-25 d-none d-sm-block ">
            <ul class=" d-flex flex-column d-flex p-4 m-4 gap-5">
                <li><a href="admin.php" class="text-dark fs-4 fw-bold text-decoration-none"><i class='bx bxs-grid-alt'></i>Dashboard</a></li>
                <li><a href="plant.php" class="text-dark fs-4 fw-bold text-decoration-none"><i class='bx bxs-shopping-bag-alt'></i>Products</a></li>
                <li><a href="category.php" class="text-dark fs-4 fw-bold text-decoration-none"><i class='bx bxs-shopping-bag-alt'></i>Categories</a></li>
            </ul>
        </div>
        <div>
        <a href="#addEmployeeModal2" class="btn btn-success" data-toggle="modal"  style="position: absolute; top: 10px; right: 20px; "><i
                                    class=" material-icons">&#xE147;</i> <span>Add new category</span></a>
        </div>
        
        <div class=" mt-4">
        <h2 class="text-center" style="color: #bebebe;">Our Categories</h2>
        <div class="container mt-5 style=" right: 240px; ">
        <div class=" row d-flex justify-content-between align-items-center">
            <?php



            if ($resultatCategories->num_rows > 0) {
                while ($rowCategorie = $resultatCategories->fetch_assoc()) {
                    $nomCategorie = $rowCategorie["nom"];
                    $saisonCroissance = $rowCategorie["saison_croisssance"];
                    $besoinSpecifique = $rowCategorie["besoin_specifiques"];
                    $img = $rowCategorie["img"];
                    $categorieId = $rowCategorie["categorieId"];

            ?>
                    <div class="col-xl-4 col-lg-3 col-md-5 col-sm-9 mx-auto mt-3 my-2 ">
                        <div class="card" style="width: 17rem;height:20rem; border: none; border-radius: 10px; box-shadow: 0px 3px 5px 0px #010101;">
                            <div class="card-body">
                                <div class="col-md-1"></div>
                                <h5 class="card-title text-center mt-2"><?php echo $nomCategorie; ?></h5>
                                <img class=" card-img w-100  " src="<?php echo $img; ?>" />

                                <p class="card-text text-center mt-4">
                                    Saison de Croissance : <?php echo $saisonCroissance; ?><br>
                                    Besoin Spécifique : <?php echo $besoinSpecifique; ?>
                                </p>
                                <a href="edit1.php?id=<?= $categorieId ?>" class="btnn btn btn-success"  ">Update</a>

                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "Aucune catégorie n'a été trouvée.";
            }
            ?>
        </div>
    </div>
    </div>
    <div id="addEmployeeModal2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="./add2.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add new category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name of category</label>
                            <input name="Name1" id="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>saison_croisssance</label>
                            <input name="saison" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>besoin specifiques</label>
                            <input name="besoin" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>image</label>
                            <input name="productImg1" type="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-success">add</button </div>
                </form>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
