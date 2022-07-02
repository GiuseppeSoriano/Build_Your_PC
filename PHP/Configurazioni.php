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
$query = "
        SELECT *
        FROM users
        WHERE username = '".$_SESSION['session_user']."';
    ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$tipo_utente = $row['tipo_utente'];
?>

<!DOCTYPE html>

<?php echo "<html class='" . $tipo_utente . "'>" ?>
    
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="../logo.svg" />
        <title>Configurazioni</title>
        
        <link rel="stylesheet" href="..\CSS\style_index.css">
        <link rel="stylesheet" href="..\CSS\style_header.css">
        <link rel="stylesheet" href="..\CSS\style_popup_configurazioni.css">
        <link rel="stylesheet" href="..\CSS\style_configurazioni.css">
        <script src="..\JAVASCRIPT\Home_scripts.js"></script>
        <script src="..\JAVASCRIPT\Configurazioni_scripts.js"></script>
    
    </head>

    <body id="PAGE">

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
                FROM	configurazioni_standard CONF left outer join 
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
                WHERE CONF.tipo_username = '".$tipo_utente."'
                ORDER BY CONF.id_configurazione;
            ";
        $result = mysqli_query($conn, $query);
        $counter = 0;
        while($row = mysqli_fetch_assoc($result)){
            $counter++;
            echo "<div>";
            echo "<div id='Configurazione_" . $counter . "' class='content"; if($counter==1) echo " content_visible'>"; else echo "'>";
            echo "<div class='header'><h2>" . $row['titolo'] . "</h2></div>";
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
            echo "<button id='close_popup_" . $counter . "' class='close-btn' onclick='configura(" . $counter . ");'>CONFIGURA</button>";
            echo "</div>"; 
            echo "</div>"; 

            // SALVO RISULTATI PER CONFIGURA
            echo "<input id='TITOLO_" . $counter . "' value='" . $row['titolo'] . "' class='hidden'>";
            echo "<input id='CPU_" . $counter . "' value='" . $row['CPU'] . "' class='hidden'>";
            echo "<input id='MOTHERBOARD_" . $counter . "' value='" . $row['MOTHERBOARD'] . "' class='hidden'>";
            echo "<input id='RAM_" . $counter . "' value='" . $row['RAM'] . "' class='hidden'>";
            echo "<input id='COOLER_" . $counter . "' value='" . $row['COOLER'] . "' class='hidden'>";
            if($row['VIDEO_CARD'])
                echo "<input id='VIDEO_CARD_" . $counter . "' value='" . $row['VIDEO_CARD'] . "' class='hidden'>";
            else
                echo "<input id='VIDEO_CARD_" . $counter . "' value='NO_CARD' class='hidden'>";
            echo "<input id='ALIMENTATORE_" . $counter . "' value='" . $row['ALIMENTATORE'] . "' class='hidden'>";
            echo "<input id='PC_CASE_" . $counter . "' value='" . $row['PC_CASE'] . "' class='hidden'>";
            echo "<input id='SSD_" . $counter . "' value='" . $row['SSD'] . "' class='hidden'>";
            echo "<input id='HARD_DISK_" . $counter . "' value='" . $row['HARD_DISK'] . "' class='hidden'>";
            echo "<input id='MONITOR_" . $counter . "' value='" . $row['MONITOR'] . "' class='hidden'>";
        }
        ?>

            <div class="freccia_destra"><img id="right_arrow" class="freccia" src="../Images_configurazioni/next.png" onclick="go_up();"></div>
            <div class="freccia_sinistra"><img id="left_arrow" class="freccia disabled" src="../Images_configurazioni/before.png" onclick="go_down();"></div>
    </body>

</html>
