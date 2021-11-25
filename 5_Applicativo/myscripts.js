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

function top10(){
    
}

function goBack(){
    location.href = document.referrer;
}

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}
  
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

function openForm() {
    document.getElementById("myForm").style.display = "block";
    document.getElementById("main").style.opacity = 0.2;
}
  
function closeForm() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("main").style.opacity = 1;
}