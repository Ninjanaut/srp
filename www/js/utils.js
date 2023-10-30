function redirect(url){
    window.location.replace(url);
}

function closeModal(elementId){
    M.Modal.getInstance(document.getElementById(elementId)).close();
}

function disablePage(){
    document.body.classList.add("unclickable");
}

function enablePage(){
    document.body.classList.remove("unclickable");
}