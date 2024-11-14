<?php

require_once "models/base.php";

if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
        
    }


if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
$user_id = $_SESSION['user_id'];

$rezultat = $conn->query("SELECT email FROM users WHERE id = '$user_id'");

$user = $rezultat->fetch_assoc();






}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
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
<header class="flex fixed-top"  id="header"><!--header-start-->


<div class="nav-cont ">


  
  <div class="header_left">
    <a class="logo" href="index.php"><h1 id="header_h1" style="color: #343a40;">PRO<span style="color: rgb(28, 122, 165);">GASTRO</h1></a>
  </div>

  <div class="header_mid">
    
      <label for="menuTrigger" class="nav_ico"><i class='bx bx-menu' style='color:#343a40'  ></i></label>
      <input id="menuTrigger" type="checkbox" name="">
   
    <nav class="main_nav">
      <div class="hiddenTittle">
        <h1 style="color: #343a40;">PRO<span style="color: rgb(28, 122, 165);">GASTRO</h1>
          <label for="menuTrigger">
              <i class='bx bx-x ' style='color:#343a40'  ></i>
          </label>
      </div>
      <ul>
        <li><a href="#">O NAMA</a></li>
        
        <li class="products">
          <div class="products-nav">
            <a href="products.php">PROIZVODI</a>
            <i class='bx bx-chevron-down chevron-products' style='color:#343a40' ></i>
          </div>

          <ul>
              <li><a href="category.php?category=Nozevi">Nozevi</a>
                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                  <ul>
                  <li><a href="category.php?category=Nozevi&brand=Zwilling">Zwilling Nozevi</a></li>
                  <li><a href="category.php?category=Nozevi&brand=Swibo">Swibo Nozevi</a></li>
                  <li><a href="category.php?category=Nozevi&brand=Victorinox">Victorinox Nozevi</a></li>
                  
                  </ul>
              </li>
              <li><a href="#">Resetke i nozevi za masine</a>
                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                  <ul>
                  <li><a href="#">Zwilling </a></li>
                  <li><a href="#">Swibo</a></li>
                  <li><a href="#">Victorinox</a></li>
                  
                  </ul></li>

              <li><a href="category.php?category=Ostraci">Ostraci</a>
                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                  <ul>
                  <li><a href="category.php?category=Ostraci&brand=Zwilling">Zwilling Ostraci</a></li>
                  <li><a href="category.php?category=Ostraci&brand=Swibo">Swibo Ostraci</a></li>
                  <li><a href="category.php?category=Ostraci&brand=Victorinox">Victorinox Ostraci</a></li>
                 
                  </ul>
              </li>

              <li><a href="#">Masine za mljevenje mesa</a>
                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                  <ul>
                  <li><a href="#">Zwilling</a></li>
                  <li><a href="#">Swibo</a></li>
                  <li><a href="#">Victorinox</a></li>
                  <li><a href="#">Zwilling</a></li>
                  <li><a href="#">Swibo</a></li>
                  <li><a href="#">Victorinox</a></li>
                  </ul>
              </li>
              <li><a href="#">HTZ Oprema</a>
                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                  <ul>
                  <li><a href="#">Obuca</a></li>
                  <li><a href="#">Kecelje</a></li>
                  <li><a href="#">Mesarska uniforma</a></li>
                  </ul></li>

              <li><a href="#">Termometri</a></li>
          </ul>

          
        </li>
        <li><a href="contact.html">KONTAKT</a></li>
        
        <li><a href="cart.php">KORPA</a></li>
      </ul>

      
    </nav>   
     

    
  </div>

  
  
  
  <div class="header_right"> 

    <div class="search_bar">
        <form class="search_form" action="search_product.php" method="GET na ">
            <input class="search_input" type="text" name="pretraga" placeholder="Pretrazite proizvod...">
            <button class="search_button" type="submit"><i class="ri-search-2-line "></i></button>
        </form>
    </div>

    <div class="container search_mobile" >
            <form action="search_product.php" method="GET" class="search" id="search-bar">
                <input type="text" placeholder="Pretrazi proizvod..." name="pretraga" class="search__input">
    
                <div class="search__button" id="search-button">
                    <i class="ri-search-2-line search__icon"></i>
                    <i class="ri-close-line search__close"></i>
                </div>
            </form>
        </div>

    <div id="open-profile-info" class="my_profile">
     <label for="">
        <a  href="#"><i class='bx bx-user admin' style='color:#343a40'  ></i></a>
     </label>
     </div>
    
  </div>

  

  
</div>

<div id="profile-info" class="profile_info">
  <?php if(isset($_SESSION['loggedIn'])): ?>
      <i id="close-profile-info" class='bx bx-x close_icon'></i>

      <div class="info_elements">
        <i class='bx bx-envelope' ></i>
        <a href=""><?= $user['email'] ?></a>
      </div>

      <div class="info_elements">
        <i class='bx bx-user-check ' ></i>
        <a href="">Uredi profil</a>
      </div>

      <div class="info_elements">
        <i class='bx bx-log-out' ></i>
        <a href="logout.php">Odjava</a>
      </div>
  <?php else: ?>
    
      <i id="close-profile-info" class='bx bx-x close_icon'></i>
      <div class="info_elements">
        <i class='bx bx-log-in' ></i>
        <a href="login.php">Prijavi se</a>
      </div>
      <div class="info_elements">
        <i class='bx bx-user-plus' ></i>
        <a href="register.php">Registruj se</a>
      </div>
  <?php endif; ?>  
</div>
  
    
</header>



<script src="js/main.js"></script>
</body>
</html>