<?php

if(!isset($_POST['email']) || empty($_POST['email']))
{
    die("Niste unijeli e-mail");
}

if(!isset($_POST['password']) || empty($_POST['password']))
{
    die("Niste unijeli sifru");
}

require_once "base.php";

$email = $_POST['email'];
$password = $_POST['password'];

// Koraci:
// 1. Provjeriti da li korisnik postoji
// 2. Provjeriti da li je sifra dobra
// 3. Ispisati poruke (dobrodosao/la -korisnik ne postoji - sifra nije tacna)

$rezultat = $conn->query("SELECT * FROM users WHERE email = '$email' ");

if($rezultat->num_rows == 1)
{
    // Ovako uzimamo podatke od korisnika ako korisnik postoji
    $korisnik = $rezultat->fetch_assoc();

    // Poredimo podatak $password iz forme (sifra iz forme = 123)
    // Sa podatkom iz baze $2y$10$DkKsOqqMyY5AXMGALK8ziOjcTjtEdi3zZBl2Zv/SLtQGRYXRt6686

    $verifikovanaSifra = password_verify($password, $korisnik['password']);

    if($verifikovanaSifra == true)
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        
        }

        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $korisnik['id'];
        
        header("Location: ../index.php");
    }

    else{
        echo"Sifra je netacna";
    }
}

else {
    echo"Korisnik ne postoji";
}