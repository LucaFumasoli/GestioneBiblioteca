function VerificaPassword() {

    ConfirmStatus = true;

    if (ConfirmStatus == true) {
        window.location.replace("./LibriNoleggiati.php");
    }
}

function openBook(id){
    var libroID = id;

    var params = new URLSearchParams();
    params.append("libroID", libroID);

    var url = "./PaginaLibro.php?" + params.toString();
    location.href = url;
}

//funzione per aprire il side menu
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}
  
//funzione per chiudere il side menu
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

//funzione per aprire il form
function openForm() {
    document.getElementById("myForm").style.display = "block";
    document.getElementById("main").style.opacity = 0.2;
}
  
//funzione per chiudere il form
function closeForm() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("main").style.opacity = 1;
}