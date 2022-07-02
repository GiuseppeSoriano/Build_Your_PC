function visualizza_configurazione(codice){
    document.getElementById("Popup_"+codice).classList.add("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_cpu_button)");
    page.forEach(element => {
        element.classList.add("disable_click");
    });
    document.getElementById("close_popup_"+codice).classList.remove("disable_click");
    document.getElementById("close_popup_"+codice).classList.add("enable_click");
}

function nascondi_configurazione(codice){
    document.getElementById("Popup_"+codice).classList.remove("content_visible");
    let page = document.querySelectorAll("body *:not(#close_popup_cpu_button)");
    page.forEach(element => {
        element.classList.remove("disable_click");
    });
}
