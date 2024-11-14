<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: products.php");
    exit();
}

require_once "models/base.php";

$id_proizvoda = $conn->real_escape_string($_GET['id']);

$rezultat = $conn->query("SELECT * FROM products WHERE id = '$id_proizvoda'");

if ($rezultat->num_rows == 0) {
    die("Ovaj proizvod ne postoji");
}

$proizvod = $rezultat->fetch_assoc();

if (session_status() == PHP_SESSION_NONE) {
    
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/images/logo.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>  
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= htmlspecialchars($proizvod['product_name'], ENT_QUOTES, 'UTF-8') ?></title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="single_product">
        <div class="single_product_left">
            <img src="<?= $proizvod['image']; ?>" alt="<?= $proizvod['image_name']; ?>">
        </div>
        <div class="single_product_right">
            <h5><?= $proizvod['brand'] ?></h5>
            <h2><?= $proizvod['product_name'] ?></h2>
            <p><?= nl2br($proizvod['description']) ?></p>
            <h3><?= $proizvod['price'] ?>&euro;</h3>
            <?php if (isset($_SESSION['loggedIn'])): ?>
                <form class="product_input" action="models/cart.php" method="POST">
                    <input type="number" min="1" name="kolicina" placeholder="Unesite kolicinu">
                    <input type="hidden" name="id_proizvoda" value="<?= htmlspecialchars($id_proizvoda, ENT_QUOTES, 'UTF-8') ?>">
                    <button>Dodaj u korpu</button>
                </form>
            <?php else: ?>
                <a  href="login.php">Prijavite se kako biste dodali proizvod u korpu!</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
