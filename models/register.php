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
$confirm_password = $_POST['confirm_password'];
$rezultat = $conn->query("SELECT * FROM users WHERE email = '$email' ");

if($rezultat->num_rows > 0 )
{
    die("Vec postoji korisnik sa istim emailom");
}

else {
    if($password != $confirm_password)
    { 
        die("Sifre se ne podudaraju!");
        
    }

    else {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        echo"Uspjesno ste se registrovali";
        $conn->query("INSERT INTO users (email, password) VALUES ('$email','$password') ");
    }
}