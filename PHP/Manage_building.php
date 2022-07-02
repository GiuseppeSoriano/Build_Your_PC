<?php
    $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
    $titolo = (isset($_COOKIE['TITOLO'])) ? $_COOKIE['TITOLO'] : "";
    $cpu = (isset($_COOKIE['CPU'])) ? $_COOKIE['CPU'] : "UNSELECTED";
    $motherboard = (isset($_COOKIE['MOTHERBOARD'])) ? $_COOKIE['MOTHERBOARD'] : "UNSELECTED";
    $ram = (isset($_COOKIE['RAM'])) ? $_COOKIE['RAM'] : "UNSELECTED";
    $cooler = (isset($_COOKIE['COOLER'])) ? $_COOKIE['COOLER'] : "UNSELECTED";
    $video_card = (isset($_COOKIE['VIDEO_CARD'])) ? $_COOKIE['VIDEO_CARD'] : "UNSELECTED";
    $alimentatore = (isset($_COOKIE['ALIMENTATORE'])) ? $_COOKIE['ALIMENTATORE'] : "UNSELECTED";
    $ssd = (isset($_COOKIE['SSD'])) ? $_COOKIE['SSD'] : "UNSELECTED";
    $hard_disk = (isset($_COOKIE['HARD_DISK'])) ? $_COOKIE['HARD_DISK'] : "UNSELECTED";
    $monitor = (isset($_COOKIE['MONITOR'])) ? $_COOKIE['MONITOR'] : "UNSELECTED";
    $pc_case = (isset($_COOKIE['PC_CASE'])) ? $_COOKIE['PC_CASE'] : "UNSELECTED";
    $socket = select_socket();
    $tipo_ram = select_tipo_ram();
    $dimensione = select_dimensione();
    $nvme = select_nvme();

    $prezzo_tot = calcola_prezzo();
    $estimated_wattage = calcola_wattage();
?>

<?php
    function select_socket(){
        $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
        $cpu = (isset($_COOKIE['CPU'])) ? $_COOKIE['CPU'] : "UNSELECTED";
        $motherboard = (isset($_COOKIE['MOTHERBOARD'])) ? $_COOKIE['MOTHERBOARD'] : "UNSELECTED";
        if($cpu != "UNSELECTED"){
            $query = "
                    SELECT Socket
                    FROM CPU
                    WHERE Codice = '".$cpu."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['Socket'];
        }
        else if($motherboard != "UNSELECTED"){
            $query = "
                    SELECT Socket_CPU
                    FROM motherboard
                    WHERE Codice = '".$motherboard."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['Socket_CPU'];
        } 
        else
            return null;
    }

    function set_scheda_integrata(){
        $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
        $cpu = (isset($_COOKIE['CPU'])) ? $_COOKIE['CPU'] : "UNSELECTED";
        $query = "
                    SELECT *
                    FROM CPU
                    WHERE Codice = '".$cpu."'
            ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if($row['Scheda grafica'] != "NO")
            setcookie("SCHEDA_VIDEO_INTEGRATA", $row['Scheda grafica'], time() + 1000 * 24 * 60 * 60);
    }

    function select_tipo_ram(){
        $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
        $motherboard = (isset($_COOKIE['MOTHERBOARD'])) ? $_COOKIE['MOTHERBOARD'] : "UNSELECTED";
        $ram = (isset($_COOKIE['RAM'])) ? $_COOKIE['RAM'] : "UNSELECTED";
        if($ram != "UNSELECTED"){
            $query = "
                    SELECT Tipologia
                    FROM ram
                    WHERE Codice = '".$ram."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['Tipologia'];
        }
        else if($motherboard != "UNSELECTED"){
            $query = "
                    SELECT RAM
                    FROM motherboard
                    WHERE Codice = '".$motherboard."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['RAM'];
        } 
        else
            return null;
    }

    function select_dimensione(){
        $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
        $motherboard = (isset($_COOKIE['MOTHERBOARD'])) ? $_COOKIE['MOTHERBOARD'] : "UNSELECTED";
        $alimentatore = (isset($_COOKIE['ALIMENTATORE'])) ? $_COOKIE['ALIMENTATORE'] : "UNSELECTED";
        $pc_case = (isset($_COOKIE['PC_CASE'])) ? $_COOKIE['PC_CASE'] : "UNSELECTED";
        if($motherboard != "UNSELECTED"){
            $query = "
                    SELECT Tipologia
                    FROM motherboard
                    WHERE Codice = '".$motherboard."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['Tipologia'];
        } elseif($alimentatore != "UNSELECTED"){
            $query = "
                    SELECT Dimensioni
                    FROM power_supply
                    WHERE Codice = '".$alimentatore."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['Dimensioni'];
        } elseif($pc_case != "UNSELECTED"){
            $query = "
                    SELECT Dimensioni
                    FROM pc_case
                    WHERE Codice = '".$pc_case."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['Dimensioni'];
        }
        else
            return null;
    }

    function select_nvme(){
        $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
        $motherboard = (isset($_COOKIE['MOTHERBOARD'])) ? $_COOKIE['MOTHERBOARD'] : "UNSELECTED";
        $ssd = (isset($_COOKIE['SSD'])) ? $_COOKIE['SSD'] : "UNSELECTED";
        if($ssd != "UNSELECTED"){
            $query = "
                    SELECT NVME
                    FROM ssd
                    WHERE Codice = '".$ssd."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['NVME'];
        }
        else if($motherboard != "UNSELECTED"){
            $query = "
                    SELECT NVME
                    FROM motherboard
                    WHERE Codice = '".$motherboard."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['NVME'];
        } 
        else
            return null;
    }

    function calcola_prezzo(){
        $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
        $cpu = (isset($_COOKIE['CPU'])) ? $_COOKIE['CPU'] : "UNSELECTED";
        $motherboard = (isset($_COOKIE['MOTHERBOARD'])) ? $_COOKIE['MOTHERBOARD'] : "UNSELECTED";
        $ram = (isset($_COOKIE['RAM'])) ? $_COOKIE['RAM'] : "UNSELECTED";
        $cooler = (isset($_COOKIE['COOLER'])) ? $_COOKIE['COOLER'] : "UNSELECTED";
        $video_card = (isset($_COOKIE['VIDEO_CARD'])) ? $_COOKIE['VIDEO_CARD'] : "UNSELECTED";
        $alimentatore = (isset($_COOKIE['ALIMENTATORE'])) ? $_COOKIE['ALIMENTATORE'] : "UNSELECTED";
        $ssd = (isset($_COOKIE['SSD'])) ? $_COOKIE['SSD'] : "UNSELECTED";
        $hard_disk = (isset($_COOKIE['HARD_DISK'])) ? $_COOKIE['HARD_DISK'] : "UNSELECTED";
        $monitor = (isset($_COOKIE['MONITOR'])) ? $_COOKIE['MONITOR'] : "UNSELECTED";
        $pc_case = (isset($_COOKIE['PC_CASE'])) ? $_COOKIE['PC_CASE'] : "UNSELECTED";

        $prezzo_tot = 0;

        if($cpu != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM CPU
                    WHERE Codice = '".$cpu."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($motherboard != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM motherboard
                    WHERE Codice = '".$motherboard."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($ram != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM ram
                    WHERE Codice = '".$ram."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($cooler != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM cooler
                    WHERE Codice = '".$cooler."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($video_card != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM video_card
                    WHERE Codice = '".$video_card."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($alimentatore != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM power_supply
                    WHERE Codice = '".$alimentatore."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($pc_case != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM pc_case
                    WHERE Codice = '".$pc_case."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($ssd != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM ssd
                    WHERE Codice = '".$ssd."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($hard_disk != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM hard_disk
                    WHERE Codice = '".$hard_disk."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }
        if($monitor != "UNSELECTED"){
            $query = "
                    SELECT Prezzo
                    FROM monitor
                    WHERE Codice = '".$monitor."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $prezzo_tot += $row['Prezzo'];
        }

        return $prezzo_tot;
    }

    function calcola_wattage(){
        $conn = mysqli_connect("localhost", "root", "", "build_your_pc_db");
        $cpu = (isset($_COOKIE['CPU'])) ? $_COOKIE['CPU'] : "UNSELECTED";
        $motherboard = (isset($_COOKIE['MOTHERBOARD'])) ? $_COOKIE['MOTHERBOARD'] : "UNSELECTED";
        $ram = (isset($_COOKIE['RAM'])) ? $_COOKIE['RAM'] : "UNSELECTED";
        $cooler = (isset($_COOKIE['COOLER'])) ? $_COOKIE['COOLER'] : "UNSELECTED";
        $video_card = (isset($_COOKIE['VIDEO_CARD'])) ? $_COOKIE['VIDEO_CARD'] : "UNSELECTED";
        $ssd = (isset($_COOKIE['SSD'])) ? $_COOKIE['SSD'] : "UNSELECTED";
        $hard_disk = (isset($_COOKIE['HARD_DISK'])) ? $_COOKIE['HARD_DISK'] : "UNSELECTED";

        $wattage_tot = 0;

        if($cpu != "UNSELECTED"){
            $query = "
                    SELECT Wattaggio
                    FROM CPU
                    WHERE Codice = '".$cpu."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $wattage_tot += $row['Wattaggio'];
        }
        if($motherboard != "UNSELECTED"){
            $query = "
                    SELECT Wattaggio
                    FROM motherboard
                    WHERE Codice = '".$motherboard."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $wattage_tot += $row['Wattaggio'];
        }
        if($ram != "UNSELECTED"){
            $query = "
                    SELECT Wattaggio
                    FROM ram
                    WHERE Codice = '".$ram."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $wattage_tot += $row['Wattaggio'];
        }
        if($cooler != "UNSELECTED"){
            $query = "
                    SELECT Wattaggio
                    FROM cooler
                    WHERE Codice = '".$cooler."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $wattage_tot += $row['Wattaggio'];
        }
        if($video_card != "UNSELECTED"){
            $query = "
                    SELECT Wattaggio
                    FROM video_card
                    WHERE Codice = '".$video_card."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $wattage_tot += $row['Wattaggio'];
        }
        if($ssd != "UNSELECTED"){
            $query = "
                    SELECT Wattaggio
                    FROM ssd
                    WHERE Codice = '".$ssd."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $wattage_tot += $row['Wattaggio'];
        }
        if($hard_disk != "UNSELECTED"){
            $query = "
                    SELECT Wattaggio
                    FROM hard_disk
                    WHERE Codice = '".$hard_disk."'
                ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $wattage_tot += $row['Wattaggio'];
        }

        return $wattage_tot;
    }
?>
    