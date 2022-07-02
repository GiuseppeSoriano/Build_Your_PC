var counter = 1;
var NUM_CONFIGURAZIONI = 3;

function go_up(){
    for(let i = 1; i <= NUM_CONFIGURAZIONI; i++){
        document.getElementById("Configurazione_"+i).classList.remove("content_visible");
    }
    counter++;
    document.getElementById("Configurazione_"+counter).classList.add("content_visible");
    if(counter == NUM_CONFIGURAZIONI)
        document.getElementById("right_arrow").classList.add("disabled");
    document.getElementById("left_arrow").classList.remove("disabled");
}

function go_down(){
    for(let i = 1; i <= NUM_CONFIGURAZIONI; i++){
        document.getElementById("Configurazione_"+i).classList.remove("content_visible");
    }
    counter--;
    document.getElementById("Configurazione_"+counter).classList.add("content_visible");
    if(counter == 1)
        document.getElementById("left_arrow").classList.add("disabled");
    document.getElementById("right_arrow").classList.remove("disabled");
}

function configura(cod){
    document.cookie = "TITOLO = " + document.getElementById("TITOLO_"+cod).value;
    document.cookie = "CPU = " + document.getElementById("CPU_"+cod).value;
    document.cookie = "MOTHERBOARD = " + document.getElementById("MOTHERBOARD_"+cod).value;
    document.cookie = "RAM = " + document.getElementById("RAM_"+cod).value;
    document.cookie = "COOLER = " + document.getElementById("COOLER_"+cod).value;
    if(document.getElementById("VIDEO_CARD_"+cod).value != "NO_CARD")
        document.cookie = "VIDEO_CARD = " + document.getElementById("VIDEO_CARD_"+cod).value;
    else
        document.cookie = "VIDEO_CARD= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    document.cookie = "ALIMENTATORE = " + document.getElementById("ALIMENTATORE_"+cod).value;
    document.cookie = "PC_CASE = " + document.getElementById("PC_CASE_"+cod).value;
    document.cookie = "SSD = " + document.getElementById("SSD_"+cod).value;
    document.cookie = "HARD_DISK = " + document.getElementById("HARD_DISK_"+cod).value;
    document.cookie = "MONITOR = " + document.getElementById("MONITOR_"+cod).value;
    go_building();
}