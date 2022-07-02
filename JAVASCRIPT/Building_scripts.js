function manage_titolo(){
    let titolo = document.getElementById("titolo_configurazione").value;
    if(document.getElementById("titolo_configurazione").value == ""){
        unset_titolo();
        return;
    }
    document.cookie = "TITOLO = " + titolo;
    location.reload();
    check_save();
}

function manage_cpu(){
    let codice = document.getElementById("CPU").value;
    document.cookie = "CPU = " + codice;
    location.reload();
    check_wattage();
    check_save();
}

function manage_motherboard(){
    let codice = document.getElementById("MOTHERBOARD").value;
    document.cookie = "MOTHERBOARD = " + codice;
    location.reload();
    check_wattage();
    check_save();
}

function manage_ram(){
    let codice = document.getElementById("RAM").value;
    document.cookie = "RAM = " + codice;
    location.reload();
    check_wattage();
    check_save();
}

function manage_cooler(){
    let codice = document.getElementById("COOLER").value;
    document.cookie = "COOLER = " + codice;
    location.reload();
    check_wattage();
    check_save();
}

function manage_video_card(){
    let codice = document.getElementById("VIDEO_CARD").value;
    document.cookie = "VIDEO_CARD = " + codice;
    location.reload();
    check_wattage();
    check_save();
}

function manage_alimentatore(){
    let codice = document.getElementById("ALIMENTATORE").value;
    document.cookie = "ALIMENTATORE = " + codice;
    location.reload();
    check_save();
}

function manage_ssd(){
    let codice = document.getElementById("SSD").value;
    document.cookie = "SSD = " + codice;
    location.reload();
    check_wattage();
    check_save();
}

function manage_hard_disk(){
    let codice = document.getElementById("HARD_DISK").value;
    document.cookie = "HARD_DISK = " + codice;
    location.reload();
    check_wattage();
    check_save();
}

function manage_pc_case(){
    let codice = document.getElementById("PC_CASE").value;
    document.cookie = "PC_CASE = " + codice;
    location.reload();
    check_save();
}

function manage_monitor(){
    let codice = document.getElementById("MONITOR").value;
    document.cookie = "MONITOR = " + codice;
    location.reload();
}

function unset_titolo(){
    document.cookie = "TITOLO= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_cpu(){
    document.cookie = "CPU= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    document.cookie = "SCHEDA_VIDEO_INTEGRATA= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_motherboard(){
    document.cookie = "MOTHERBOARD= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_ram(){
    document.cookie = "RAM= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_cooler(){
    document.cookie = "COOLER= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_video_card(){
    document.cookie = "VIDEO_CARD= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_alimentatore(){
    document.cookie = "ALIMENTATORE= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_ssd(){
    document.cookie = "SSD= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_hard_disk(){
    document.cookie = "HARD_DISK= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_pc_case(){
    document.cookie = "PC_CASE= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function unset_monitor(){
    document.cookie = "MONITOR= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";     //unset cookie  
    location.reload();
}

function check_save(){
    document.getElementById("save").disabled = true;;
    if(getCookie("CPU") != null && getCookie("MOTHERBOARD") != null && getCookie("RAM") != null && getCookie("COOLER") != null && getCookie("ALIMENTATORE") != null && getCookie("PC_CASE") != null && getCookie("TITOLO") != null){
        if(getCookie("SSD") != null || getCookie("HARD_DISK") != null){
            if(getCookie("VIDEO_CARD") != null || getCookie("SCHEDA_VIDEO_INTEGRATA") != null){
                document.getElementById("save").disabled = false;
            }
        }
    }
}

function check_wattage(){
    let wattage = document.getElementById("estimated_wattage").value;
    if(getCookie("ALIMENTATORE") != null){
        let max_wattage = document.getElementById("current_wattage").value;
        if(wattage > max_wattage * 0.7){
            unset_alimentatore();
            alert("LIMITE POTENZA SUPERATO!");
        }
    }
}

function mostra_popup_cpu(){
    document.getElementById("Popup_CPU").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_cpu_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_cpu_button").classList.add("enable_click");
    document.getElementById("Link_amazon_CPU").classList.remove("disable_click");
    document.getElementById("Link_amazon_CPU").classList.add("enable_click");
}

function close_popup_cpu(){
    document.getElementById("Popup_CPU").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_cpu_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_motherboard(){
    document.getElementById("Popup_MOTHERBOARD").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_motherboard_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_motherboard_button").classList.add("enable_click");
    document.getElementById("Link_amazon_MOTHERBOARD").classList.remove("disable_click");
    document.getElementById("Link_amazon_MOTHERBOARD").classList.add("enable_click");
}

function close_popup_motherboard(){
    document.getElementById("Popup_MOTHERBOARD").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_motherboard_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_ram(){
    document.getElementById("Popup_RAM").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_ram_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_ram_button").classList.add("enable_click");
    document.getElementById("Link_amazon_RAM").classList.remove("disable_click");
    document.getElementById("Link_amazon_RAM").classList.add("enable_click");
}

function close_popup_ram(){
    document.getElementById("Popup_RAM").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_ram_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_cooler(){
    document.getElementById("Popup_COOLER").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_cooler_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_cooler_button").classList.add("enable_click");
    document.getElementById("Link_amazon_COOLER").classList.remove("disable_click");
    document.getElementById("Link_amazon_COOLER").classList.add("enable_click");
}

function close_popup_cooler(){
    document.getElementById("Popup_COOLER").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_cooler_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_video_card(){
    document.getElementById("Popup_VIDEO_CARD").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_video_card_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_video_card_button").classList.add("enable_click");
    document.getElementById("Link_amazon_VIDEO_CARD").classList.remove("disable_click");
    document.getElementById("Link_amazon_VIDEO_CARD").classList.add("enable_click");
}

function close_popup_video_card(){
    document.getElementById("Popup_VIDEO_CARD").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_video_card_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_alimentatore(){
    document.getElementById("Popup_ALIMENTATORE").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_alimentatore_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_alimentatore_button").classList.add("enable_click");
    document.getElementById("Link_amazon_ALIMENTATORE").classList.remove("disable_click");
    document.getElementById("Link_amazon_ALIMENTATORE").classList.add("enable_click");
}

function close_popup_alimentatore(){
    document.getElementById("Popup_ALIMENTATORE").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_alimentatore_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_pc_case(){
    document.getElementById("Popup_PC_CASE").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_pc_case_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_pc_case_button").classList.add("enable_click");
    document.getElementById("Link_amazon_PC_CASE").classList.remove("disable_click");
    document.getElementById("Link_amazon_PC_CASE").classList.add("enable_click");
}

function close_popup_pc_case(){
    document.getElementById("Popup_PC_CASE").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_pc_case_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_ssd(){
    document.getElementById("Popup_SSD").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_ssd_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_ssd_button").classList.add("enable_click");
    document.getElementById("Link_amazon_SSD").classList.remove("disable_click");
    document.getElementById("Link_amazon_SSD").classList.add("enable_click");
}

function close_popup_ssd(){
    document.getElementById("Popup_SSD").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_ssd_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_hard_disk(){
    document.getElementById("Popup_HARD_DISK").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_hard_disk_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_hard_disk_button").classList.add("enable_click");
    document.getElementById("Link_amazon_HARD_DISK").classList.remove("disable_click");
    document.getElementById("Link_amazon_HARD_DISK").classList.add("enable_click");
}

function close_popup_hard_disk(){
    document.getElementById("Popup_HARD_DISK").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_hard_disk_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

function mostra_popup_monitor(){
    document.getElementById("Popup_MONITOR").classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_monitor_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_monitor_button").classList.add("enable_click");
    document.getElementById("Link_amazon_MONITOR").classList.remove("disable_click");
    document.getElementById("Link_amazon_MONITOR").classList.add("enable_click");
}

function close_popup_monitor(){
    document.getElementById("Popup_MONITOR").classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_monitor_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}

//Funzioni realizzate da terzi
function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    // because unescape has been deprecated, replaced with decodeURI
    //return unescape(dc.substring(begin + prefix.length, end));
    return decodeURI(dc.substring(begin + prefix.length, end));
} 