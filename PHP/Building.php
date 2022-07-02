<?php
session_start();
require_once('database.php');

if(isset($_SESSION['errorMessage'])){
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['errorMessage'] . "');
          </script>";
    
    unset($_SESSION['errorMessage']);
}
include_once 'Manage_building.php'
?>

<!DOCTYPE html>

<html id="main_page_P">
    
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="../logo.svg" />
        <title>Build Your PC</title>
        
        <link rel="stylesheet" href="..\CSS\style_index.css">
        <link rel="stylesheet" href="..\CSS\style_header.css">
        <link rel="stylesheet" href="..\CSS\style_Building.css">
        <link rel="stylesheet" href="..\CSS\style_popup.css">
        <script src="..\JAVASCRIPT\Home_scripts.js"></script>
        <script src="..\JAVASCRIPT\Building_scripts.js"></script>
    </head>

    <body id="PAGE" onload="check_save();">

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
    
        <div id="box_configura">

            <div id="box_titolo">
                <?php echo "<input id='titolo_configurazione' placeholder='Nome della configurazione' onchange='manage_titolo();' value=$titolo>" ?>
            </div><br>

            <div id="select_CPU" class="spaziatura_componenti">
                <?php
                    if($socket==null){
                        if($cooler != "UNSELECTED"){
                            $query = "
                                SELECT C.*
                                FROM CPU C inner join compatibile_cpu_cooler CPC ON C.Socket = CPC.Socket
                                WHERE CPC.Codice_Cooler = '".$cooler."';
                            ";
                        }
                        else{
                            $query = "
                                SELECT *
                                FROM CPU;
                            ";
                        }
                    } else{
                        $query = "
                            SELECT *
                            FROM CPU
                            WHERE Socket = '".$socket."'
                        ";
                    }
                    $result = mysqli_query($conn, $query);
                    if($cpu == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>CPU  </div>";
                        echo "<div class='elenco_componenti next_to'><select id='CPU' onchange='manage_cpu()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_cpu' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM CPU
                            WHERE Codice = '".$cpu."';
                        ";
                        echo "<div class='nome_componente next_to'>CPU  </div>";
                        
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_cpu();'>" . $row['Marca'] . "  " . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_cpu' onclick='unset_cpu()'>UNSELECT</button>";
                        set_scheda_integrata();
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_CPU' class='content'>";
                        echo "<div class='header'><h2>" . $row['Marca'] . "  " . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>VELOCITA'</td><td>CORES</td><td>THREADS</td><td>SOCKET</td><td>WATTAGGIO</td><td>DISSIPATORE<br>INCLUSO</td><td>SCHEDA GRAFICA<br>INCLUSA</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Velocita\''] . "</td>";
                            echo "<td>" . $row['Cores'] . "</td>";
                            echo "<td>" . $row['Threads'] . "</td>";
                            echo "<td>" . $row['Socket'] . "</td>";
                            echo "<td>" . $row['Wattaggio'] . " Watt</td>";
                            echo "<td>"; echo ($row['Dissipatore incluso']==1)?"SI":"NO"; echo "</td>";
                            echo "<td>" . $row['Scheda grafica'] . "</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_CPU' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_cpu_button' class='close-btn' onclick='close_popup_cpu();'>CLOSE</button>";
                        echo "</div>";
                    }
                ?>
            </div><br>

            <div id="select_MOTHERBOARD" class="spaziatura_componenti">
                <?php
                    if($socket==null){
                        if($tipo_ram == null){
                            if($cooler != "UNSELECTED"){
                                if($dimensione != null){
                                    if($nvme != null){
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Tipologia = '".$dimensione."' AND
                                                    M.NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Tipologia = '".$dimensione."';
                                        ";
                                    }
                                }
                                else{
                                    if($nvme != null){
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE CPC.Codice_Cooler = '".$cooler."';
                                        ";
                                    }
                                }
                            }
                            else{
                                if($dimensione != null){
                                    if($nvme != null){
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   Tipologia = '".$dimensione."' AND
                                                    NVME = '".$nvme."';
                                        ";                                
                                    }
                                    else{
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE Tipologia = '".$dimensione."';
                                        ";                                
                                    }
                                }
                                else{
                                    if($nvme != null){
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT *
                                            FROM motherboard;
                                        ";
                                    }
                                }
                            }
                        } else{
                            if($cooler != "UNSELECTED"){
                                if($dimensione != null){
                                    if($nvme != null){
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.RAM = '".$tipo_ram."' AND
                                                    M.Tipologia = '".$dimensione."' AND
                                                    M.NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.RAM = '".$tipo_ram."' AND
                                                    M.Tipologia = '".$dimensione."';
                                        ";
                                    }
                                }
                                else{
                                    if($nvme != null){
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.RAM = '".$tipo_ram."' AND
                                                    M.NVME = '".$nvme."';
                                        ";
                                    }
                                    else {
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.RAM = '".$tipo_ram."';
                                        ";
                                    }
                                }
                            }
                            else{
                                if($dimensione != null){
                                    if($nvme != null){
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   RAM = '".$tipo_ram."' AND
                                                    Tipologia = '".$dimensione."' AND
                                                    NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   RAM = '".$tipo_ram."' AND
                                                    Tipologia = '".$dimensione."';
                                        ";
                                    }
                                }
                                else{
                                    if($nvme != null){
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   RAM = '".$tipo_ram."' AND
                                                    NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE RAM = '".$tipo_ram."'
                                        ";
                                    }
                                }
                            }
                        }
                    } else{
                        if($tipo_ram == null){
                            if($cooler != "UNSELECTED"){
                                if($dimensione != null){
                                    if($nvme != null){
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Socket_CPU = '".$socket."' AND
                                                    M.Tipologia = '".$dimensione."' AND
                                                    M.NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Socket_CPU = '".$socket."' AND
                                                    M.Tipologia = '".$dimensione."';
                                        ";
                                    }
                                }
                                else{
                                    if($nvme != null){
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Socket_CPU = '".$socket."' AND
                                                    M.NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Socket_CPU = '".$socket."';
                                        ";
                                    }
                                }
                            }
                            else{
                                if($dimensione != null){
                                    if($nvme != null){
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   Socket_CPU = '".$socket."' AND
                                                    Tipologia = '".$dimensione."' AND
                                                    NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   Socket_CPU = '".$socket."' AND
                                                    Tipologia = '".$dimensione."';
                                        ";
                                    }
                                }
                                else{
                                    if($nvme != null){
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   Socket_CPU = '".$socket."' AND
                                                    NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE Socket_CPU = '".$socket."'
                                        ";
                                    }
                                }
                            }
                        } else{
                            if($cooler != "UNSELECTED"){
                                if($dimensione != null){
                                    if($nvme != null){
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Socket_CPU = '".$socket."'AND
                                                    M.RAM = '".$tipo_ram."' AND
                                                    M.Tipologia = '".$dimensione."' AND
                                                    M.NVME = '".$nvme."';
                                        ";                                    
                                    }
                                    else{
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Socket_CPU = '".$socket."'AND
                                                    M.RAM = '".$tipo_ram."' AND
                                                    M.Tipologia = '".$dimensione."';
                                        ";
                                    }
                                }
                                else{
                                    if($nvme != null){
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Socket_CPU = '".$socket."'AND
                                                    M.RAM = '".$tipo_ram."' AND
                                                    M.NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT M.*
                                            FROM motherboard M inner join compatibile_cpu_cooler CPC ON M.Socket_CPU = CPC.Socket
                                            WHERE   CPC.Codice_Cooler = '".$cooler."' AND
                                                    M.Socket_CPU = '".$socket."'AND
                                                    M.RAM = '".$tipo_ram."';
                                        ";
                                    }
                                }
                            }
                            else{
                                if($dimensione != null){
                                    if($nvme != null){
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   Socket_CPU = '".$socket."' AND
                                                    RAM = '".$tipo_ram."' AND
                                                    Tipologia = '".$dimensione."' AND
                                                    NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   Socket_CPU = '".$socket."' AND
                                                    RAM = '".$tipo_ram."' AND
                                                    Tipologia = '".$dimensione."';
                                        ";
                                    }
                                }
                                else{
                                    if($nvme != null){
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   Socket_CPU = '".$socket."' AND
                                                    RAM = '".$tipo_ram."' AND
                                                    NVME = '".$nvme."';
                                        ";
                                    }
                                    else{
                                        $query = "
                                            SELECT *
                                            FROM motherboard
                                            WHERE   Socket_CPU = '".$socket."' AND
                                                    RAM = '".$tipo_ram."';
                                        ";
                                    }
                                }
                            }
                            
                        }
                    }
                    
                    $result = mysqli_query($conn, $query);

                    if($motherboard == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>MOTHERBOARD  </div>";
                        echo "<div class='elenco_componenti next_to'><select id='MOTHERBOARD' onchange='manage_motherboard()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_motherboard' disabled>UNSELECT</button>";
                    }
                    else{
                        echo "<div class='nome_componente next_to'>MOTHERBOARD  </div>";

                        $query = "
                            SELECT *
                            FROM motherboard
                            WHERE Codice = '".$motherboard."'
                        ";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to'  onclick='mostra_popup_motherboard();'>" . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_motherboard' onclick='unset_motherboard()'>UNSELECT</button>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_MOTHERBOARD' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>TIPOLOGIA</td><td>RAM SUPPORTATA</td><td>SOCKET CPU</td><td>NVME SUPPORTATA<td>WATTAGGIO</td></td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Tipologia'] . "</td>";
                            echo "<td>" . $row['RAM'] . "</td>";
                            echo "<td>" . $row['Socket_CPU'] . "</td>";
                            echo "<td>"; echo ($row['NVME']==1)?"SI":"NO"; echo "</td>";
                            echo "<td>" . $row['Wattaggio'] . " Watt</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_MOTHERBOARD' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_motherboard_button' class='close-btn' onclick='close_popup_motherboard();'>CLOSE</button>";
                        echo "</div>";
                    }
                ?>
            </div><br>

            <div id="select_RAM">
                <?php
                    if($tipo_ram==null){
                        $query = "
                            SELECT *
                            FROM ram;
                        ";
                    } else{
                        $query = "
                            SELECT *
                            FROM ram
                            WHERE Tipologia = '".$tipo_ram."'
                        ";
                    }
                    $result = mysqli_query($conn, $query);
                    if($ram == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>RAM  </div>";
                        echo "<div class='elenco_componenti next_to'><select id='RAM' onchange='manage_ram()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . " " . $row['Memoria'] . " " . $row['Velocita'] . " MHz" . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_ram' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM ram
                            WHERE Codice = '".$ram."'
                        ";
                        echo "<div class='nome_componente next_to'>RAM  </div>";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_ram();'>" . $row['Nome_Serie'] . " " . $row['Memoria'] . " " . $row['Velocita'] . " MHz" . "</div>";
                        
                        echo "<button id='BUTTON_unselect_ram' onclick='unset_ram()'>UNSELECT</button>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_RAM' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie']  . " " . $row['Memoria'] . " " . $row['Velocita'] . " MHz" . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>TIPOLOGIA</td><td>MEMORIA</td><td>VELOCITA</td><td>WATTAGGIO</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Tipologia'] . "</td>";
                            echo "<td>" . $row['Memoria'] . "</td>";
                            echo "<td>" . $row['Velocita'] . " MHz</td>";
                            echo "<td>" . $row['Wattaggio'] . " Watt</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_RAM' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_ram_button' class='close-btn' onclick='close_popup_ram();'>CLOSE</button>";
                        echo "</div>";
                    }
                ?>
            </div><br>

            <div id="select_COOLER">
                <?php
                    if($socket==null){
                        $query = "
                            SELECT *
                            FROM cooler;
                        ";
                    } else{
                        $query = "
                            SELECT C.*
                            FROM cooler C inner join compatibile_cpu_cooler CPC ON C.Codice = CPC.Codice_Cooler
                            WHERE CPC.Socket = '".$socket."'
                        ";
                    }
                    $result = mysqli_query($conn, $query);
                    if($cooler == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>DISSIPATORE</div>";
                        echo "<div class='elenco_componenti next_to'><select id='COOLER' onchange='manage_cooler()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_cooler' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM cooler
                            WHERE Codice = '".$cooler."'
                        ";
                        echo "<div class='nome_componente next_to'>DISSIPATORE</div>";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_cooler();'>" . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_cooler' onclick='unset_cooler()'>UNSELECT</button>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_COOLER' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>TIPOLOGIA</td><td>DIMENSIONI</td><td>WATTAGGIO</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Tipologia'] . "</td>";
                            echo "<td>" . $row['Dimensioni'] . " cm</td>";
                            echo "<td>" . $row['Wattaggio'] . " Watt</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_COOLER' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_cooler_button' class='close-btn' onclick='close_popup_cooler();'>CLOSE</button>";
                        echo "</div>";
                    }
                ?>
            </div><br>

            <div id="select_VIDEO_CARD">
                <?php
                    $query = "
                        SELECT *
                        FROM video_card;
                    ";
                    
                    $result = mysqli_query($conn, $query);
                    
                    if($video_card == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>SCHEDA VIDEO</div>";
                        echo "<div class='elenco_componenti next_to'><select id='VIDEO_CARD' onchange='manage_video_card()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_video_card' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM video_card
                            WHERE Codice = '".$video_card."'
                        ";
                        
                        echo "<div class='nome_componente next_to'>SCHEDA VIDEO</div>";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_video_card();'>" . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_video_card' onclick='unset_video_card()'>UNSELECT</button>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_VIDEO_CARD' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>TIPOLOGIA</td><td>MEMORIA</td><td>WATTAGGIO</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Tipologia'] . "</td>";
                            echo "<td>" . $row['Memoria'] . "</td>";
                            echo "<td>" . $row['Wattaggio'] . " Watt</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_VIDEO_CARD' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_video_card_button' class='close-btn' onclick='close_popup_video_card();'>CLOSE</button>";
                        echo "</div>";
                    }

                ?>
            </div><br>

            <div id="select_ALIMENTATORE">
                <?php
                    if($dimensione==null){
                        $query = "
                            SELECT *
                            FROM power_supply
                            WHERE Potenza > '".$estimated_wattage."' / 0.7;
                        ";
                    } else{
                        $query = "
                            SELECT *
                            FROM power_supply
                            WHERE Dimensioni = '".$dimensione."' AND Potenza > '".$estimated_wattage."' / 0.7;
                        ";
                    }
                    $result = mysqli_query($conn, $query);
                    if($alimentatore == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>ALIMENTATORE</div>";
                        echo "<div class='elenco_componenti next_to'><select id='ALIMENTATORE' onchange='manage_alimentatore()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_alimentatore' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM power_supply
                            WHERE Codice = '".$alimentatore."'
                        ";
                        echo "<div class='nome_componente next_to'>ALIMENTATORE</div>";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_alimentatore();'>" . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_alimentatore' onclick='unset_alimentatore()'>UNSELECT</button>";
                        echo "<input id='current_wattage' readonly='0' value='" . $row['Potenza'] . "' class='hidden'></input>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_ALIMENTATORE' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>POTENZA</td><td>TIPOLOGIA</td><td>DIMENSIONI</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Potenza'] . " Watt</td>";
                            echo "<td>" . $row['Tipologia'] . "</td>";
                            echo "<td>" . $row['DImensioni'] . "</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_ALIMENTATORE' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_alimentatore_button' class='close-btn' onclick='close_popup_alimentatore();'>CLOSE</button>";
                        echo "</div>";
                    }

                ?>
            </div><br>

            <div id="select_PC_CASE">
                <?php
                    if($dimensione==null){
                        $query = "
                            SELECT *
                            FROM pc_case;
                        ";
                    } else{
                        $query = "
                            SELECT *
                            FROM pc_case
                            WHERE Dimensioni = '".$dimensione."'
                        ";
                    }
                    $result = mysqli_query($conn, $query);
                    if($pc_case == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>CASE</div>";
                        echo "<div class='elenco_componenti next_to'><select id='PC_CASE' onchange='manage_pc_case()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_pc_case' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM pc_case
                            WHERE Codice = '".$pc_case."'
                        ";
                        echo "<div class='nome_componente next_to'>CASE</div>";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_pc_case();'>" . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_pc_case' onclick='unset_pc_case()'>UNSELECT</button>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_PC_CASE' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>DIMENSIONI</td><td>VETRO TEMPERATO</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Dimensioni'] . "</td>";
                            echo "<td>"; echo ($row['Vetro temperato']==1)?"SI":"NO"; echo "</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_PC_CASE' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_pc_case_button' class='close-btn' onclick='close_popup_pc_case();'>CLOSE</button>";
                        echo "</div>";
                    }

                ?>
            </div><br>

            <div id="select_SSD">
                <?php
                    if($nvme == null){
                        $query = "
                            SELECT *
                            FROM ssd;
                        ";
                    } else{
                        $query = "
                            SELECT S.*
                            FROM ssd S inner join motherboard M on S.NVME = M.NVME
                            WHERE M.Codice = '".$motherboard."'
                        ";
                    }
                    $result = mysqli_query($conn, $query);
                    if($ssd == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>SSD</div>";
                        echo "<div class='elenco_componenti next_to'><select id='SSD' onchange='manage_ssd()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_ssd' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM ssd
                            WHERE Codice = '".$ssd."';
                        ";
                        echo "<div class='nome_componente next_to'>SSD</div>";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_ssd();'>" . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_ssd' onclick='unset_ssd()'>UNSELECT</button>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_SSD' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>VELOCITA'</td><td>DIMENSIONI</td><td>NVME</td><td>WATTAGGIO</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Velocita\' (MB/s)'] . " MB/s</td>";
                            echo "<td>" . $row['Dimensioni'] . "</td>";
                            echo "<td>"; echo ($row['NVME']==1)?"SI":"NO"; echo "</td>";
                            echo "<td>" . $row['Wattaggio'] . " Watt</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_SSD' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_ssd_button' class='close-btn' onclick='close_popup_ssd();'>CLOSE</button>";
                        echo "</div>";
                    }

                ?>
            </div><br>

            <div id="select_HARD_DISK">
                <?php
                    $query = "
                        SELECT *
                        FROM hard_disk;
                    ";
                    
                    $result = mysqli_query($conn, $query);
                    
                    if($hard_disk == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>HARD DISK</div>";
                        echo "<div class='elenco_componenti next_to'><select id='HARD_DISK' onchange='manage_hard_disk()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_hard_disk' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM hard_disk
                            WHERE Codice = '".$hard_disk."'
                        ";
                        echo "<div class='nome_componente next_to'>HARD DISK</div>";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_hard_disk();'>" . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_hard_disk' onclick='unset_hard_disk()'>UNSELECT</button>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_HARD_DISK' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>VELOCITA'</td><td>DIMENSIONI</td><td>WATTAGGIO</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Velocita\' (giri/min)'] . " giri/min</td>";
                            echo "<td>" . $row['Dimensioni'] . "</td>";
                            echo "<td>" . $row['Wattaggio'] . " Watt</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_HARD_DISK' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_hard_disk_button' class='close-btn' onclick='close_popup_hard_disk();'>CLOSE</button>";
                        echo "</div>";
                    }

                ?>
            </div><br>

            <div id="select_MONITOR">
                <?php
                    $query = "
                        SELECT *
                        FROM monitor;
                    ";
                    
                    $result = mysqli_query($conn, $query);
                    
                    if($monitor == "UNSELECTED"){
                        echo "<div class='nome_componente next_to'>MONITOR</div>";
                        echo "<div class='elenco_componenti next_to'><select id='MONITOR' onchange='manage_monitor()'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option selected='false' value='" . $row['Codice'] . "'>" . $row['Nome_Serie'] . "</option>";
                        }
                        echo "<option id='0' selected='true' value='UNSELECTED'>NON SELEZIONATO</option>";
                        echo "</select></div>";
                        echo "<button id='BUTTON_unselect_monitor' disabled>UNSELECT</button>";
                    }
                    else{
                        $query = "
                            SELECT *
                            FROM monitor
                            WHERE Codice = '".$monitor."'
                        ";
                        echo "<div class='nome_componente next_to'>MONITOR</div>";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='componente_scelta next_to' onclick='mostra_popup_monitor();'>" . $row['Nome_Serie'] . "</div>";
                        echo "<button id='BUTTON_unselect_monitor' onclick='unset_monitor()'>UNSELECT</button>";
                        //POPUP
                        echo "<div>";
                        echo "<div id='Popup_MONITOR' class='content'>";
                        echo "<div class='header'><h2>" . $row['Nome_Serie'] . "</h2>";
                        echo "</div>";
                        echo "<table>";
                            echo "<tr class='prima_riga'><td>MARCA</td><td>NOME SERIE</td><td>FREQUENZA</td><td>DIMENSIONI</td><td>TIPOLOGIA</td><td>RISOLUZIONE</td><td>TEMPO RISPOSTA</td><td>PREZZO</td><td>LINK</td>";
                            echo "<tr><td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Nome_Serie'] . "</td>";
                            echo "<td>" . $row['Frequenza (Hz)'] . " Hz</td>";
                            echo "<td>" . $row['Dimensioni (pollici)'] . "\"</td>";
                            echo "<td>" . $row['Tipologia'] . "</td>";
                            echo "<td>" . $row['Risoluzione'] . "</td>";
                            echo "<td>" . $row['Tempo risposta (ms)'] . " ms</td>";
                            echo "<td>" . $row['Prezzo'] . " €</td>";
                            echo "<td><a href='" . $row['Link'] . "' id='Link_amazon_MONITOR' target='_blank'>AMAZON</a></td>";
                        echo "</table>";
                        echo "<div class='line'></div>";
                        echo "<button id='close_popup_monitor_button' class='close-btn' onclick='close_popup_monitor();'>CLOSE</button>";
                        echo "</div>";
                    }

                ?>
            </div><br>

            <div id="box_prezzo">
                Prezzo €
                <?php 
                    echo "<input readonly='0' value='$prezzo_tot' class='classe_prezzo'></input>";
                    echo "<input id='estimated_wattage' readonly='0' value='$estimated_wattage' class='hidden'></input>";
                ?>
            </div><br>

            <form method="post" action="salva_configurazione.php">
                <button id="save" type="submit" name="save">SALVA CONFIGURAZIONE</button>
            </form>
        </div>

    </body>

</html>
