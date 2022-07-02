function effettua_prima_login(){
    alert("EFFETTUA PRIMA IL LOGIN");
    return;
}

function go_login(){
    document.location.href = "Login.html";
}

function go_register(){
    let _windowResult;
    if ((_windowResult == null) || (_windowResult.closed)) {
        _windowResult = window.open("", "Score", "width=300,height=400,resizable=yes,location=no,menubar=no,toolbar=no,titlebar=no");
        _windowResult.document.open();                                                          
        
    }
    _windowResult.focus();
    _windowResult.document.location.href = "Register.html";
}


function manage_account(){
    let box = document.getElementById("account_manage");
    if(box.className == "")
        box.setAttribute("class", "hidden");
    else
        box.removeAttribute("class", "hidden");            
}

var counter_animation = 1; 

function slide_animate(){
    counter_animation = (counter_animation%3)+1;
    document.getElementById("label"+counter_animation).click();
}

function begin(){
    setInterval(slide_animate, 4000);
}