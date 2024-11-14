<?php

require_once "models/base.php";

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(!isset($_GET['pretraga']) || empty($_GET['pretraga']))
{
    header("Location: index.php");
}

// Preuzimanje vrednosti iz GET parametara
$pretraga = isset($_GET['pretraga']) ? $_GET['pretraga'] : '';

// Razdvajanje pretrage na reči
$words = explode(' ', $pretraga);

// Osiguravanje da su pretrage bezbedne za upotrebu u SQL upitu (izbegavanje SQL injekcija)
foreach ($words as &$word) {
    $word = mysqli_real_escape_string($conn, $word);
}

// Kreiranje regex izraza za pretragu reči u bilo kom redosledu
$regexParts = [];
foreach ($words as $word) {
    $regexParts[] = "(?=.*$word)";
}
$regex = implode('', $regexParts);

// Postavljanje broja proizvoda po stranici na 3
$proizvodiPoStranici = 1;
// Određivanje trenutne stranice
$trenutnaStranica = isset($_GET['stranica']) ? $_GET['stranica'] : 1;

// Izračunavanje offseta za LIMIT u SQL upitu
$offset = ($trenutnaStranica - 1) * $proizvodiPoStranici;

// Izvršavanje upita na bazi podataka sa pretragom i ograničenjem na broj proizvoda po stranici
$rezultati = $conn->query("SELECT * FROM products WHERE CONCAT(product_name, '', category, '', brand, '', description) REGEXP '$regex' LIMIT $proizvodiPoStranici OFFSET $offset");

// Izračunavanje ukupnog broja proizvoda koji zadovoljavaju pretragu
$rezultatiBroj = $conn->query("SELECT COUNT(*) as total FROM products WHERE CONCAT(product_name, '', category, '', brand, '', description) REGEXP '$regex'");
$brojProizvoda = $rezultatiBroj->fetch_assoc()['total'];

// Izračunavanje ukupnog broja stranica
$ukupnoStranica = ceil($brojProizvoda / $proizvodiPoStranici);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" style="text/css">
    <title>Pretraga</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>  
</head>
<body>

<?php include 'includes/header.php';  ?>

<div class="proizvodi">
    <?php if($rezultati->num_rows > 0): ?>
        <?php while($proizvod = $rezultati->fetch_assoc()): ?>
            <div class="proizvod">
                <h4><?= $proizvod['product_name'] ?></h4>
                <img src="<?= $proizvod['image']; ?>" alt="<?= $proizvod['image_name']; ?>">
                <h5>Cijena: <?= $proizvod['price'] ?>&euro;</h5>
                <?php if($proizvod['quantity'] == 0): ?>
                    <p>Nema na stanju</p>
                <?php else: ?>
                    <p>Ima na stanju</p>
                <?php endif; ?>
                <a href="product.php?id=<?= $proizvod['id'] ?>">Pogledaj proizvod</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nismo pronašli proizvod</p>
    <?php endif; ?>
</div>

<div class="pagination-container">
    <div class="pagination">
        <?php if ($ukupnoStranica > 1): ?>
            <?php if ($ukupnoStranica <= 7): ?>
                <?php for ($i = 1; $i <= $ukupnoStranica; $i++): ?>
                    <a href="?pretraga=<?= urlencode($pretraga) ?>&stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            <?php else: ?>
                <?php if ($trenutnaStranica <= 4): ?>
                    <?php for ($i = 1; $i <= max(5, $trenutnaStranica + 2); $i++): ?>
                        <a href="?pretraga=<?= urlencode($pretraga) ?>&stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    <span>...</span>
                    <a href="?pretraga=<?= urlencode($pretraga) ?>&stranica=<?= $ukupnoStranica ?>"><?= $ukupnoStranica ?></a>
                <?php elseif ($trenutnaStranica >= $ukupnoStranica - 3): ?>
                    <a href="?pretraga=<?= urlencode($pretraga) ?>&stranica=1">1</a>
                    <span>...</span>
                    <?php for ($i = $ukupnoStranica - 5; $i <= $ukupnoStranica; $i++): ?>
                        <a href="?pretraga=<?= urlencode($pretraga) ?>&stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                <?php else: ?>
                    <a href="?pretraga=<?= urlencode($pretraga) ?>&stranica=1">1</a>
                    <span>...</span>
                    <?php for ($i = $trenutnaStranica - 2; $i <= $trenutnaStranica + 2; $i++): ?>
                        <a href="?pretraga=<?= urlencode($pretraga) ?>&stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    <span>...</span>
                    <a href="?pretraga=<?= urlencode($pretraga) ?>&stranica=<?= $ukupnoStranica ?>"><?= $ukupnoStranica ?></a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>








</body>
</html>
