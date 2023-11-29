<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES["productImg1"])) {
        checkFileError();
        insertProduct();
        // header("location: admin.php");
    }
}

function checkFileError()
{
    switch ($_FILES['productImg1']['error']) {
        case UPLOAD_ERR_OK:
            echo 'File is valid, and was successfully uploaded.';
            break;
        case UPLOAD_ERR_INI_SIZE:
            echo 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
            break;
        case UPLOAD_ERR_FORM_SIZE:
            echo 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
            break;
        case UPLOAD_ERR_PARTIAL:
            echo 'The uploaded file was only partially uploaded.';
            break;
        case UPLOAD_ERR_NO_FILE:
            echo 'No file was uploaded.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            echo 'Missing a temporary folder. Introduced in PHP 5.0.3.';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            echo 'Failed to write file to disk. Introduced in PHP 5.1.0.';
            break;
        case UPLOAD_ERR_EXTENSION:
            echo 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.';
            break;
        default:
            echo 'Unknown upload error';
            break;
    }
}

function insertProduct()
{
    global $conn;

    $img = $_FILES['productImg1']['name'];
    $size = $_FILES['productImg1']['size'];
    $tmp_name = $_FILES['productImg1']['tmp_name'];
    $error = $_FILES['productImg1']['error'];

    $name = $_POST["productName1"];
    $prix = $_POST["product_price1"];
    $categorieId = $_POST["category1"];

    if ($error === 0) {
        if ($size > 4200000) {
            echo 'Sorry, your file is too large. (max 4mb)';
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
        $msg[] = 'Unknown error occurred';
        exit;
    }

    // Prepare the SQL statement
    $query = "INSERT INTO categorie (nom, img, prix) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param('sss', $name, $new_img_name, $prix);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();
    header("location: category.php");
}
?>
