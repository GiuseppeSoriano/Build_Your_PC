function go_home(){
    counter_animation = 1;
    document.location.href = '../PHP/HOME.php';
}

function go_configurazioni(){
    counter_animation = 1;
    clearInterval(slide_animate);
    document.location.href = '../PHP/Configurazioni.php';
}

function go_mie_configurazioni(){
    counter_animation = 1;
    clearInterval(slide_animate);
    document.location.href = '../PHP/Mie_Configurazioni.php';
}

function go_building(){
    counter_animation = 1;
    clearInterval(slide_animate);
    document.location.href = "../PHP/Building.php";
}

function manage_account(){
    let box = document.getElementById("profile");
    if(box.className == "")
        box.setAttribute("class", "hidden");
    else
        box.removeAttribute("class", "hidden");            
}

function modify_account(){
    document.location.href = "../Update_account/Update_account.html";
}

var counter_animation = 1; 

function slide_animate(){
    counter_animation = (counter_animation%3)+1;
    document.getElementById("label"+counter_animation).click();
}

function begin(){
    setInterval(slide_animate, 4000);
}
