<?php
include_once("config.php");
session_start();
$IDuser = $_SESSION['IDuser'];
if (isset($_POST['back'])) {
    header("location: client.php");
    exit();
}


if (isset($_POST['delete'])) {
    $planteIdToDelete = $_POST['delete'];
    $deleteItem = $conn->prepare("DELETE FROM panier WHERE userId = ? AND planteId = ?");
    $deleteItem->bind_param("ii", $IDuser, $planteIdToDelete);
    $deleteItem->execute();
    $deleteItem->close();
    header("location: panier.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
<!-- 
    <form action="" method="POST">
        <button type="SUBMIT" name="back">GO BACK</button>
    </form>

    <div class="container">
        <div class="row">
            <?php
            $select = $conn->prepare("SELECT * FROM panier JOIN plante ON plante.planteId = panier.planteId JOIN userr ON userr.userId = panier.userId WHERE panier.userId = ?");
            $select->bind_param("i", $IDuser);
            $select->execute();
            $resultselect = $select->get_result();
            while ($row = $resultselect->fetch_assoc()) {
            ?>

                <div class="card col-md-3">
                    <h1><?php echo $row['name'] ?></h1>
                    <p><?php echo $row['prix'] ?></p>
                    <img src="./images/<?php echo $row['image'] ?>" class="w-50 h-50" alt="">
                </div>

            <?php
            }

            ?>
        </div>
    </div>
 -->
 <section class="vh-100" style="background-color: #bebebe;">
  <div class="container h-100">
  
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <p><span class="h2">Shopping Cart </span><span class="h4"></span></p>

        <div class="card mb-4">
          <div class="card-body p-4">
          <?php
            $select = $conn->prepare("SELECT * FROM panier JOIN plante ON plante.planteId = panier.planteId JOIN userr ON userr.userId = panier.userId WHERE panier.userId = ?");
            $select->bind_param("i", $IDuser);
            $select->execute();
            $resultselect = $select->get_result();
            while ($row = $resultselect->fetch_assoc()) {
            ?>

            <div class="row align-items-center">
              <div class="col-md-2">
              <img src="./images/<?php echo $row['image'] ?>" class="w-75 h-25" alt="">
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                <h1><?php echo $row['name'] ?></h1>
                 
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                 
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
              
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Price</p>
                  <p><?php echo $row['prix'] ?></p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                  <form action="" method="POST">
                        <input type="hidden" name="delete" value="<?php echo $row['planteId']; ?>">
                        <button type="submit" class="btn btn-success btn-sm">Delete</button>
                    </form>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                 
                </div>
            </div>
            <?php
            }

            ?>
          </div>
        </div>

        <div class="card mb-5">
          <div class="card-body p-4">

            <div class="float-end">
              <p class="mb-0 me-5 d-flex align-items-center">
              
                 
              </p>
            </div>

          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="button" class="btn btn-light btn-lg me-2">Continue shopping</button>
         
        </div>
        <form action="" method="POST">
        <button type="SUBMIT" name="back" style="width: 90px;border:none ; border-radius: 10px;">GO BACK</button>
    </form>
      </div>
    </div>
  </div>
  
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>