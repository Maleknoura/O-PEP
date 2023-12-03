<?php
include "config.php";

$sqlPlante = "SELECT * FROM `plante` ";
$resultatPlante = $conn->query($sqlPlante);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_product"])) {
    $idToDelete = $_POST["id_product"];

    // Assurez-vous de faire les vérifications de sécurité nécessaires ici avant de supprimer
    $sqlDelete = "DELETE FROM `plante` WHERE `planteId` = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $idToDelete);

    if ($stmt->execute()) {
        // Suppression réussie
        header("Location: categories.php"); // Redirigez vers la page principale après la suppression
        exit();
    } else {
        // Erreur lors de la suppression
        echo "Erreur lors de la suppression de la plante.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
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
    <title>Document</title>

</head>

<body>
    <div class="d-flex ">
        <div class="aside border-end w-25 d-none d-sm-block  ">
            <ul class="d-flex flex-column d-flex p-4 m-4 gap-5">
                <li><a href="admin.php" class="text-dark fs-5 fw-bold text-decoration-none"><i class='bx bxs-grid-alt'></i>Dashboard</a></li>
                <li><a href="plant.php" class="text-dark fs-5 fw-bold text-decoration-none"><i class='bx bxs-shopping-bag-alt'></i>Products</a></li>
                <li><a href="category.php" class="text-dark fs-5 fw-bold text-decoration-none"><i class='bx bxs-shopping-bag-alt'></i>categories</a></li>


            </ul>
        </div>
        <div>

        </div>
        <div>
            <!-- <a href="add.php?id=<?= $planteId ?>" class="btn btn-success" mt-5 data-bs-toggle="" data-bs-target="#exampleModal-<?= $planteId ?>"> +add</a> -->
        </div>
        <div>
            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" style="position: absolute; top: 10px; right: 20px; "><i
                                    class=" material-icons">&#xE147;</i> <span>Add new product</span></a>
        </div>
        <div>
            <?php
            if ($resultatPlante->num_rows > 0) {
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rowPlante = $resultatPlante->fetch_assoc()) {
                            $planteId = $rowPlante["planteId"];
                            $namePlante = $rowPlante["name"];
                            $image = $rowPlante["image"];
                            $categorieID = $rowPlante["categorieID"];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $planteId; ?></th>
                                <td><img class=" card-img  " src="images/<?php echo $image; ?>" /></td>
                                <td><?php echo $namePlante; ?></td>
                                <td><?php echo $categorieID; ?></td>
                                <td>
                                    <a href="delete.php?id=<?= $planteId ?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal-<?= $planteId ?>">Delete</a>
                                    <a href="edit.php?id=<?= $planteId ?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal-<?= $planteId ?>">Update</a>



                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "Aucun résultat trouvé.";
            }
            ?>
        </div>
    </div>
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="./add.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add new product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="productName" id="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input name="product_price" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="category">category</label>
                            <select id="category" name="category">
                                <OPTIon>1</OPTIon>
                                <OPTIon>2</OPTIon>
                                <OPTIon>3</OPTIon>
                                <OPTIon>4</OPTIon>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>image</label>
                            <input name="productImg" type="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-success">add</button </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>