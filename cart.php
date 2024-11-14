<?php

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(!isset($_SESSION['loggedIn']))
{
    header("Location:login.php");
}

// 1. IZvuci sve narudzbenice zi baze na osnovu user_id
// 2. Ispisati sve narudzbe na stranici

require_once "models/base.php";




$user_id = $_SESSION['user_id'];





$rezultat = $conn->query("SELECT * FROM orders WHERE user_id = '$user_id' ");

// var_dump($rezultat);

$narudzbe = $rezultat->fetch_all(MYSQLI_ASSOC);


$ukupna_cijena = 0;




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/x-icon" href="assets/images/logo.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>  
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

  <?php include 'includes/header.php';  ?>



  <div class="cart_products">
    <h3>Sadržaj korpe</h3>
    <?php if($rezultat->num_rows == 0): ?>
        <h1>Vaša korpa je prazna</h1>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Proizvod</th>
                    <th class="quantity_header">Količina</th>
                    <th class="total_header">Ukupna cijena</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($narudzbe as $narudzba): ?>
                    <?php
                    $id_proizvoda = $narudzba['product_id'];
                    $proizvod_rezultat = $conn->query("SELECT * FROM products WHERE id = '$id_proizvoda'");
                    $proizvod = $proizvod_rezultat->fetch_assoc();
                    ?>
                    <tr>
                        <td class="product_cell">
                            <img src="<?= $proizvod['image'] ?>" alt="" class="product_image">
                            <span class="product_name"><?= $proizvod['product_name']; ?></span>
                        </td>
                        <td class="quantity_cell">
                            <div class="quantity_form">
                                <button class="quantity_btn minus">-</button>
                                <input type="number" class="quantity_input" data-product-id="<?= $narudzba['product_id']; ?>" data-product-price="<?= $proizvod['price']; ?>" value="<?= $narudzba['quantity']; ?>" min="1">
                                <button class="quantity_btn plus">+</button>
                            </div>
                        </td>
                        <td class="total_cell">
                            <span class="total_price"><?= $proizvod['price'] * $narudzba['quantity'] ?>&euro;</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h5 class="total_text">TOTAL: <?= $ukupna_cijena ?>&euro;</h5>
    <?php endif; ?>
</div>









<script src="js/main.js"></script>

</body>
</html>