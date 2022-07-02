<?php
require_once('database.php');

if (isset($_POST['configura'])) {
    $codice = $_POST['conf_scelta'];
    $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");

    $query = "
                SELECT *
                FROM configurazioni
                WHERE id_configurazione = '".$codice."'
            ";
        
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    setcookie('TITOLO', $row['titolo'], time() + 24*60*60*1000);
    setcookie('CPU', $row['CPU'], time() + 24*60*60*1000);
    setcookie('MOTHERBOARD', $row['MOTHERBOARD'], time() + 24*60*60*1000);
    setcookie('RAM', $row['RAM'], time() + 24*60*60*1000);
    setcookie('COOLER', $row['COOLER'], time() + 24*60*60*1000);
    setcookie('ALIMENTATORE', $row['ALIMENTATORE'], time() + 24*60*60*1000);
    setcookie('PC_CASE', $row['PC_CASE'], time() + 24*60*60*1000);
    if ($row['VIDEO_CARD'] != null)
        setcookie('VIDEO_CARD', $row['VIDEO_CARD'], time() + 24*60*60*1000);
    else
        setcookie('VIDEO_CARD', '', time() - 24*60*60*1000);
    if ($row['SSD'] != null) 
        setcookie('SSD', $row['SSD'], time() + 24*60*60*1000);
    else
        setcookie('SSD', '', time() - 24*60*60*1000);
    if ($row['HARD_DISK'] != null) 
        setcookie('HARD_DISK', $row['HARD_DISK'], time() + 24*60*60*1000);
    else
        setcookie('HARD_DISK', '', time() - 24*60*60*1000);
    if ($row['MONITOR'] != null) 
        setcookie('MONITOR', $row['MONITOR'], time() + 24*60*60*1000);
    else
        setcookie('MONITOR', '', time() - 24*60*60*1000);
            
    header('Location: Building.php');
    
}

if (isset($_POST['elimina'])) {
    $codice = $_POST['conf_scelta'];

    $query = "
        DELETE FROM configurazioni
        WHERE id_configurazione = :codice
    ";

    $check = $pdo->prepare($query);
    $check->bindParam(':codice', $codice, PDO::PARAM_STR);
    $check->execute();

    header('Location: Mie_Configurazioni.php');
}


?>