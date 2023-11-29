<?php
include "config.php";
$sqlPlante = "SELECT * FROM `plante` ";
$resultatPlante = $conn->query($sqlPlante);
$sql = "SELECT *FROM categorie";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fichier.css">
    <title>Document</title>
</head>
<body>
<style>
  .p-name-centered {
    text-align: center;
  }
</style>
<div class="container page-wrapper">
  <div class="page-inner">
    <?php
    if($resultatPlante->num_rows > 0) {
        while ($rowPlante = $resultatPlante->fetch_assoc()) {
            $namePlante = $rowPlante["name"];
            $image = $rowPlante["image"];
            $id_pn = $rowPlante["id_pn"];
            $prix = $rowPlante["prix"];
    ?>
            <div class="row">
                <div class="el-wrapper">
                    <div class="box-up">
                        <img class="img card-img " src="images/<?php echo $image; ?>" alt="">
                        <div class="img-info">
                            <div class="info-inner">
                              
                                <span class="p-company"><?php echo $id_pn; ?></span>
                            </div>
                            <!-- Ajoutez ici des informations supplémentaires si nécessaire -->
                        </div>
                    </div>

                    <div class="box-down">
                        <div class="h-bg">
                            <div class="h-bg-inner"></div>
                        </div>
                       
                        <span class="p-name-centered"><h3><?php echo $namePlante; ?></H3></span>
                        <span class="p-company"><?php echo $prix; ?></span>
                                <span class="p-company"><?php echo $id_pn;  ?></span>

                        <!-- Vous pouvez ajouter un lien ici si nécessaire -->
                        <a class="cart" href="#">
                            <!-- Utilisez une variable pour le prix si applicable -->
                           
                            <span class="add-to-cart">
                                <span class="txt">Add in cart</span>
                            </span>
                        </a>
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

</body>
</html>