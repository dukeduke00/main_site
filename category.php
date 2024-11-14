<?php

require_once "models/base.php";

$brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$rezultat = $conn->query("SELECT * FROM products WHERE category = '$category' ");

if (!empty($brand)) {
    $rezultat = $conn->query("SELECT * FROM products WHERE category = '$category' AND brand = '$brand'");
}

$proizvodi = $rezultat->fetch_all(MYSQLI_ASSOC);

// Postavljanje broja proizvoda po stranici
$proizvodiPoStranici = 2;
// Računanje broja proizvoda
$brojProizvoda = count($proizvodi);

// Računanje ukupnog broja stranica
$ukupnoStranica = ceil($brojProizvoda / $proizvodiPoStranici);

// Određivanje trenutne stranice
$trenutnaStranica = isset($_GET['stranica']) ? $_GET['stranica'] : 1;

// Računanje početnog indeksa proizvoda za trenutnu stranicu
$pocetak = ($trenutnaStranica - 1) * $proizvodiPoStranici;

// Dobijanje proizvoda za trenutnu stranicu
$proizvodiZaStranicu = array_slice($proizvodi, $pocetak, $proizvodiPoStranici);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>  
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

<?php include 'includes/header.php';  ?>


<div class="proizvodi">
    <?php if(!empty($proizvodiZaStranicu)): ?>
        <?php foreach($proizvodiZaStranicu as $proizvod): ?>
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
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nismo pronašli proizvod</p>
    <?php endif; ?>
</div>

<div class="pagination-container">
    <div class="pagination">
        <?php if ($ukupnoStranica > 1): ?>
            <?php if ($ukupnoStranica <= 7): ?>
                <?php for ($i = 1; $i <= $ukupnoStranica; $i++): ?>
                    <a href="?category=<?= urlencode($category) ?>&brand=<?= urlencode($brand) ?>&stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            <?php else: ?>
                <?php if ($trenutnaStranica <= 4): ?>
                    <?php for ($i = 1; $i <= max(5, $trenutnaStranica + 2); $i++): ?>
                        <a href="?category=<?= urlencode($category) ?>&brand=<?= urlencode($brand) ?>&stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    <span>...</span>
                    <a href="?category=<?= urlencode($category) ?>&brand=<?= urlencode($brand) ?>&stranica=<?= $ukupnoStranica ?>"><?= $ukupnoStranica ?></a>
                <?php elseif ($trenutnaStranica >= $ukupnoStranica - 3): ?>
                    <a href="?category=<?= urlencode($category) ?>&brand=<?= urlencode($brand) ?>&stranica=1">1</a>
                    <span>...</span>
                    <?php for ($i = $ukupnoStranica - 5; $i <= $ukupnoStranica; $i++): ?>
                        <a href="?category=<?= urlencode($category) ?>&brand=<?= urlencode($brand) ?>&stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                <?php else: ?>
                    <a href="?category=<?= urlencode($category) ?>&brand=<?= urlencode($brand) ?>&stranica=1">1</a>
                    <span>...</span>
                    <?php for ($i = $trenutnaStranica - 2; $i <= $trenutnaStranica + 2; $i++): ?>
                        <a href="?category=<?= urlencode($category) ?>&brand=<?= urlencode($brand) ?>&stranica=<?= $i ?>" class="<?= $i == $trenutnaStranica ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    <span>...</span>
                    <a href="?category=<?= urlencode($category) ?>&brand=<?= urlencode($brand) ?>&stranica=<?= $ukupnoStranica ?>"><?= $ukupnoStranica ?></a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
