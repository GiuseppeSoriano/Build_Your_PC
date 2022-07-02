<?php
session_start();
require_once('database.php');

if(isset($_SESSION['errorMessage'])){
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['errorMessage'] . "');
          </script>";
    
    unset($_SESSION['errorMessage']);
}
?>

<!DOCTYPE html>

<html id="main_page_P">
    
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="../logo.svg" />
        <title>Homepage</title>
        
        <link rel="stylesheet" href="..\CSS\style_index.css">
        <link rel="stylesheet" href="..\CSS\style_header.css">
        <script src="..\JAVASCRIPT\Home_scripts.js"></script>
    
    </head>

    <body id="PAGE" onload="begin();">

        <header>
            <div class="navbar">
                <img id="banner" src="../logo.svg">
                
                
                <ul class="menu">
                    <li onclick="go_home()" class="normal-text">
                        <img src="../Images_navbar/HOME1.png" alt="">
                        HOME
                    </li>
                    <li onclick="go_configurazioni()" class="normal-text">
                        <img src="../Images_navbar/CONFIGURA1.png" alt="">
                        CONFIGURAZIONI
                    </li>
                    <li onclick="go_building()" class="normal-text">
                        <img src="../Images_navbar/PC1.png" alt="">
                        BUILD YOUR PC
                    </li>
                </ul>
                
                <div id="account_management">
                    <img id="image_account" onclick="manage_account()" src="../Images_navbar/ACCOUNT.png">    
                </div>
            </div>
            <div class="spaziatura_navbar"></div>
            
            <div id="profile" class="hidden">
                Ciao <strong><?php printf($_SESSION['session_user']); ?></strong><br>
                <button id="mie_configurazioni_button" onclick="go_mie_configurazioni()" class="configurazioni_button">Le mie configurazioni</button><br>
                <button id="login_button" onclick="modify_account()" class="account_buttons">Gestisci</button>
                <form method="post" action="logout.php" class="next_to">
                    <button id="LOGOUT_BUTTON" name="logout" type="submit" class="account_buttons">Logout</button>
                </form>
                
            </div>
        </header>
        <br>    
        <div class="slidershow">
            <div class="slides">
                <input type="radio" name="r" id="r1" checked>
                <input type="radio" name="r" id="r2">
                <input type="radio" name="r" id="r3">
            
                <div class="slide s1">
                    <img src="../slide_index/slide_1.png" alt="">
                </div>
                <div class="slide">
                    <img src="../slide_index/slide_2.png" alt="" onclick="go_configurazioni();">
                </div>
                <div class="slide">
                    <img src="../slide_index/slide_3.png" alt="" onclick="go_building();">
                </div>
            </div>

            <div class="navigation">
                <label id="label1" for="r1" class="bar"></label>
                <label id="label2" for="r2" class="bar"></label>
                <label id="label3" for="r3" class="bar"></label>
            </div>
        </div>

    </body>

</html>
