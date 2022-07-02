<?php
session_start();
require_once('database.php');

if(isset($_SESSION['errorMessage'])){
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['errorMessage'] . "');
          </script>";
    
    unset($_SESSION['errorMessage']);
}
$conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
?>

<!DOCTYPE html>

<html id="main_page_P">
    
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="../logo.svg" />
        <title>Configurazioni</title>
        
        <link rel="stylesheet" href="..\CSS\style_index.css">
        <link rel="stylesheet" href="..\CSS\style_header.css">
        <link rel="stylesheet" href="..\CSS\style_Mie_Configurazioni.css">
        <link rel="stylesheet" href="..\CSS\style_popup_configurazioni.css">
        <script src="..\JAVASCRIPT\Home_scripts.js"></script>
        <script src="..\JAVASCRIPT\Mie_Configurazioni_scripts.js"></script>
    
    </head>

    <body id="PAGE_MIE_CONFIGURAZIONI">

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

        <?php
            $username = $_SESSION['session_user'];

            $query = "
                    SELECT 	CONF.*, 
                            C.Nome_Serie AS Nome_CPU, C.Marca AS Marca_CPU,
                            M.Nome_Serie AS Nome_MOTHERBOARD,
                            R.Nome_Serie AS Nome_RAM, R.Memoria AS Memoria_RAM, R.Velocita AS Velocita_RAM,
                            CO.Nome_Serie AS Nome_COOLER,
                            V.Nome_Serie AS Nome_VIDEO_CARD,
                            P.Nome_Serie AS Nome_ALIMENTATORE,
                            CA.Nome_Serie AS Nome_PC_CASE,
                            S.Nome_Serie AS Nome_SSD,
                            H.Nome_Serie AS Nome_HARD_DISK,
                            MO.Nome_Serie AS Nome_MONITOR
                    FROM	configurazioni CONF left outer join 
                            cpu C on CONF.CPU = C.Codice left outer join
                            motherboard M on CONF.MOTHERBOARD = M.Codice left outer join
                            ram R on CONF.RAM = R.Codice left outer join
                            cooler CO on CONF.COOLER = CO.Codice left outer join
                            video_card V on CONF.VIDEO_CARD = V.Codice left outer join
                            power_supply P on CONF.ALIMENTATORE = P.Codice left outer join
                            pc_case CA on CONF.PC_CASE= CA.Codice left outer join
                            ssd S on CONF.SSD = S.Codice left outer join
                            hard_disk H on CONF.HARD_DISK = H.Codice left outer join
                            monitor MO on CONF.MONITOR = MO.Codice
                    WHERE username = '".$username."'
                    ORDER BY CONF.titolo;
                ";

            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result)){
                echo "<div id='configurazione_" . $row['id_configurazione'] . "' class='blocco_configurazioni'>";
                echo "<h2>" . $row['titolo'] . "</h2>";
                echo "<button id='visualizza' onclick='visualizza_configurazione(" . $row['id_configurazione'] .");' class='button_conf'>VISUALIZZA</button>";
                echo "<form method='post' action='Manage_Mie_Configurazioni.php' class='next_to'>";
                    echo "<input id='conf_scelta' name='conf_scelta' class='hidden' value=" . $row['id_configurazione'] . ">";
                    echo "<button id='configura' name='configura' type='submit' class='button_conf'>CONFIGURA</button>";
                    echo "<button id='elimina' name='elimina' type='submit' class='button_conf'>ELIMINA</button>";
                echo "</form>";
                echo "</div>";
                //POPUP
                echo "<div>";
                echo "<div id='Popup_" . $row['id_configurazione'] . "' class='content'>";
                echo "<div class='header'><h2>" . $row['titolo'] . "</h2>";
                echo "</div>";
                echo "<table>";
                echo "<tr><td>CPU</td><td>" . $row['Marca_CPU'] . " " . $row['Nome_CPU'] . "</td></tr>";
                echo "<tr><td>MOTHERBOARD</td><td>" . $row['Nome_MOTHERBOARD'] . "</td></tr>";
                echo "<tr><td>RAM</td><td>" . $row['Nome_RAM'] . " " . $row['Memoria_RAM'] . " " . $row['Velocita_RAM'] . " MHz</td></tr>";
                echo "<tr><td>DISSIPATORE</td><td>" . $row['Nome_COOLER'] . "</td></tr>";
                echo "<tr><td>SCHEDA VIDEO</td><td>" . $row['Nome_VIDEO_CARD'] . "</td></tr>";
                echo "<tr><td>ALIMENTATORE</td><td>" . $row['Nome_ALIMENTATORE'] . "</td></tr>";
                echo "<tr><td>CASE</td><td>" . $row['Nome_PC_CASE'] . "</td></tr>";
                echo "<tr><td>SSD</td><td>" . $row['Nome_SSD'] . "</td></tr>";
                echo "<tr><td>HARD DISK</td><td>" . $row['Nome_HARD_DISK'] . "</td></tr>";
                echo "<tr><td>MONITOR</td><td>" . $row['Nome_MONITOR'] . "</td></tr>";
                echo "<tr><td>CONSUMO STIMATO</td><td>" . $row['WATTAGE'] . " Watt</td></tr>";
                echo "<tr><td>PREZZO</td><td>" . $row['PREZZO'] . " €</td></tr>";
                echo "</table>";
                echo "<div class='line'></div>";
                echo "<button id='close_popup_" . $row['id_configurazione'] . "' class='close-btn' onclick='nascondi_configurazione(" . $row['id_configurazione'] . ");'>CLOSE</button>";
                echo "</div>";                
            }
        ?>
    </body>

</html>
