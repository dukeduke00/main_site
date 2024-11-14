<?php

// Validacija unosa iz forme
if(!isset($_POST['product_name']) || empty($_POST['product_name'])) {
    die("You have not entered a product name");
}

if(!isset($_POST['description']) || empty($_POST['description'])) {
    die("You have not entered a product description");
}

if(!isset($_POST['price']) || empty($_POST['price'])) {
    die("You have not entered a product price");
}

if(!isset($_POST['quantity']) || empty($_POST['quantity'])) {
    die("You have not entered a product quantity");
}

if(!isset($_POST['category']) || empty($_POST['category'])) {
    die("You have not entered a product category");
}

if(!isset($_POST['brand']) || empty($_POST['brand'])) {
    die("You have not entered a product brand");
}

require_once "models/base.php";

// Unos podataka iz forme
$product_name = $conn->real_escape_string($_POST['product_name']);
$description = $conn->real_escape_string($_POST['description']);
$price = $conn->real_escape_string($_POST['price']);
$category = $conn->real_escape_string($_POST['category']);
$brand = $conn->real_escape_string($_POST['brand']);
$quantity = $conn->real_escape_string($_POST['quantity']);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Provjerite je li datoteka stvarna slika ili lažna slika
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Datoteka je slika - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Datoteka nije slika.";
        $uploadOk = 0;
    }
}

// Provjerite postoji li datoteka već
if (file_exists($target_file)) {
    echo "Datoteka već postoji.";
    $uploadOk = 0;
}

// Provjerite veličinu datoteke
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Vaša datoteka je prevelika.";
    $uploadOk = 0;
}

// Dopuštene su određene formate datoteka
$allowed_file_types = ['jpg', 'jpeg', 'png', 'gif'];
if(!in_array($imageFileType, $allowed_file_types)) {
    echo "Samo JPG, JPEG, PNG & GIF datoteke su dopuštene.";
    $uploadOk = 0;
}

// Provjerite je li $uploadOk postavljen na 0 zbog pogrešaka
if ($uploadOk == 0) {
    echo "Nažalost, vaša datoteka nije prenesena.";
} else {
    // Provjerite i kreirajte direktorij ako ne postoji
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Datoteka ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " je uspješno prenesena.";

        // Pohrana informacija o slici u bazu podataka
        $file_path = $conn->real_escape_string($target_file);
        $file_name = $conn->real_escape_string(basename($_FILES["fileToUpload"]["name"]));

        $sql = "INSERT INTO products (product_name, description, brand, category, image, image_name, price, quantity)
                VALUES ('$product_name', '$description', '$brand', '$category', '$file_path', '$file_name', '$price', '$quantity')";

        if ($conn->query($sql) === TRUE) {
            echo "Informacije o slici uspješno su pohranjene u bazu podataka.";
        } else {
            echo "Došlo je do pogreške prilikom pohrane informacija o slici u bazu podataka: " . $conn->error;
        }
      
    } else {
        echo "Nažalost, došlo je do pogreške prilikom prijenosa vaše datoteke.";
    }
}




