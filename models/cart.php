<?php

// korpa.php -> POST
// proslijediti -    $_POST['id_proizvoda'] iz POST-a izvlacimo id_proizvoda
// proslijediti kolicinu - $_POST['kolicina']
// uzeti iz sesije id korisnika $_SESSION['user_id] tako smo ga nazvali u login
// Cijena -> ? SELECT price FROM products WHERE id = '..'

// Dodavanje narudzbe u bazu

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(!isset($_POST['id_proizvoda']) || empty($_POST['id_proizvoda']))
{
    header("location:../products.php");
}

if(!isset($_POST['kolicina']) || empty($_POST['kolicina']))
{
    die("Morate unijeti kolicinu");
}

require_once "base.php";




$idProizvoda = $_POST['id_proizvoda'];
$kolicina = $_POST['kolicina'];
$idKorisnika = $_SESSION['user_id'];

$rezultat = $conn->query("SELECT price FROM products WHERE id='$idProizvoda' ");

$redIzBaze = $rezultat->fetch_assoc();
$cijena = $redIzBaze['price'];
$ukupnaCijena = $cijena * $kolicina;

$idProizvoda = $conn->real_escape_string($idProizvoda);
$kolicina = $conn->real_escape_string($kolicina);
$ukupnaCijena = $conn->real_escape_string($ukupnaCijena);
$idKorisnika = $conn->real_escape_string($idKorisnika);

$conn->query("INSERT INTO orders (product_id, user_id, total_price, quantity) VALUES ($idProizvoda, $idKorisnika, $ukupnaCijena, $kolicina)");

if($conn)
{
    header("location:../products.php");
}

else
{
    echo"Niste dodali proizvod";
}