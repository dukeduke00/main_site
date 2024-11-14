<?php

require_once "models/base.php";

// Postavljanje broja proizvoda po stranici
$proizvodiPoStranici = 25;

// Računanje broja proizvoda
$rezultat = $conn->query("SELECT COUNT(*) AS total FROM products");
$brojProizvoda = $rezultat->fetch_assoc()['total'];

// Računanje ukupnog broja stranica
$ukupnoStranica = ceil($brojProizvoda / $proizvodiPoStranici);

// Određivanje trenutne stranice
$trenutnaStranica = isset($_GET['stranica']) ? $_GET['stranica'] : 1;

// Računanje početnog indeksa proizvoda za trenutnu stranicu
$pocetak = ($trenutnaStranica - 1) * $proizvodiPoStranici;

// Dobijanje proizvoda za trenutnu stranicu
$rezultat = $conn->query("SELECT * FROM products LIMIT $pocetak, $proizvodiPoStranici");
$proizvodi = $rezultat->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" style="text/css">
    <title>Proizvodi</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>  
</head>
<body>

  <?php include 'includes/header.php';  ?>

  <div class="proizvodi">
                
    <?php foreach($proizvodi as $proizvod): ?>
        <div class="proizvod">
            <h4><?= $proizvod['product_name'] ?></h4>
            <img src="<?= $proizvod['image']; ?>" alt="<?= $proizvod['image_name']; ?>">
            <h5>Cijena: <?= $proizvod['price'] ?>&euro;</h5>
            <?php if($proizvod['quantity'] == 0): ?>
                <p style="color: rgb(255, 40, 40);">NEMA NA STANJU</p>
            <?php else: ?>
                <p style="color: rgb(1, 146, 1);">Ima na stanju</p>
            <?php endif; ?>
            <a href="product.php?id=<?= $proizvod['id'] ?>">Pogledaj proizvod</a>
        </div>
    <?php endforeach; ?>

  </div>

  <div class="pagination-container">
    <div class="pagination">
        <?php if ($ukupnoStranica > 1): ?>
            <?php if ($ukupnoStranica <= 7): ?>
                <?php for ($i = 1; $i <= $ukupnoStranica; $i++): ?>
                    <a href="?stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            <?php else: ?>
                <?php if ($trenutnaStranica <= 4): ?>
                    <?php for ($i = 1; $i <= max(5, $trenutnaStranica + 2); $i++): ?>
                        <a href="?stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    <span>...</span>
                    <a href="?stranica=<?= $ukupnoStranica ?>"><?= $ukupnoStranica ?></a>
                <?php elseif ($trenutnaStranica >= $ukupnoStranica - 3): ?>
                    <a href="?stranica=1">1</a>
                    <span>...</span>
                    <?php for ($i = $ukupnoStranica - 5; $i <= $ukupnoStranica; $i++): ?>
                        <a href="?stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                <?php else: ?>
                    <a href="?stranica=1">1</a>
                    <span>...</span>
                    <?php for ($i = $trenutnaStranica - 2; $i <= $trenutnaStranica + 2; $i++): ?>
                        <a href="?stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    <span>...</span>
                    <a href="?stranica=<?= $ukupnoStranica ?>"><?= $ukupnoStranica ?></a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>


<script src="js/main.js"></script>
</body>
</html>
