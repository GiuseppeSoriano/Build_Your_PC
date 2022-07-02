<?php
    session_start();
    require_once('database.php');

    if(isset($_SESSION['errorMessage'])){
        echo "<script type='text/javascript'>
                alert('" . $_SESSION['errorMessage'] . "');
            </script>";
        
        unset($_SESSION['errorMessage']);
    }
    include_once 'Manage_building.php';

    if (isset($_POST['save'])) {
        $username = $_SESSION['session_user'];

        if($video_card == "UNSELECTED")
            $video_card = null;
        if($ssd == "UNSELECTED")
            $ssd = null;
        if($hard_disk == "UNSELECTED")
            $hard_disk = null;
        if($monitor == "UNSELECTED")
            $monitor = null;

        $query = "
                INSERT INTO configurazioni
                VALUES (0, :username, :titolo, :cpu, :motherboard, :ram, :cooler, :video_card, :alimentatore, :pc_case, :ssd, :hard_disk, :monitor, :prezzo, :wattage)
            ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->bindParam(':titolo', $titolo, PDO::PARAM_STR);
        $check->bindParam(':cpu', $cpu, PDO::PARAM_STR);
        $check->bindParam(':motherboard', $motherboard, PDO::PARAM_STR);
        $check->bindParam(':ram', $ram, PDO::PARAM_STR);
        $check->bindParam(':cooler', $cooler, PDO::PARAM_STR);
        $check->bindParam(':video_card', $video_card, PDO::PARAM_STR);
        $check->bindParam(':alimentatore', $alimentatore, PDO::PARAM_STR);
        $check->bindParam(':pc_case', $pc_case, PDO::PARAM_STR);
        $check->bindParam(':ssd', $ssd, PDO::PARAM_STR);
        $check->bindParam(':hard_disk', $hard_disk, PDO::PARAM_STR);
        $check->bindParam(':monitor', $monitor, PDO::PARAM_STR);
        $check->bindParam(':prezzo', $prezzo_tot, PDO::PARAM_STR);
        $check->bindParam(':wattage', $estimated_wattage, PDO::PARAM_STR);
        $check->execute();

        //UNSET COOKIES
        setcookie('TITOLO', " ", time() - 300);
        setcookie('CPU', '', time() - 300);
        setcookie('MOTHERBOARD', '', time() - 300);
        setcookie('RAM', '', time() - 300);
        setcookie('COOLER', '', time() - 300);
        setcookie('ALIMENTATORE', '', time() - 300);
        setcookie('PC_CASE', '', time() - 300);
        if (isset($_COOKIE['VIDEO_CARD']))
            setcookie('VIDEO_CARD', '', time() - 300);
        if (isset($_COOKIE['SSD'])) 
            setcookie('SSD', '', time() - 300);
        if (isset($_COOKIE['HARD_DISK'])) 
            setcookie('HARD_DISK', '', time() - 300);
        if (isset($_COOKIE['MONITOR'])) 
            setcookie('MONITOR', '', time() - 300);
        if (isset($_COOKIE['SCHEDA_VIDEO_INTEGRATA'])) 
            setcookie('SCHEDA_VIDEO_INTEGRATA', '', time() - 300);
            
        header('Location: Mie_Configurazioni.php');

    }
?>


