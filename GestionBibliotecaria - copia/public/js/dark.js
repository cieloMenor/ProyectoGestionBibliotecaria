let modo=document.getElementById("modo");
let body=document.body;
let nav=document.getElementById("navprincipal");

modo.addEventListener("click",function(){
    let val = body.classList.toggle("darkmode")
    let val2 = nav.classList.toggle("navbar-dark")

    localStorage.setItem("modo",val)
})
let valor = localStorage.getItem("modo")

if(valor=="true"){
    body.classList.add("darkmode");
    nav.classList.add("navbar-dark");
}
else{
    body.classList.remove("darkmode");
    nav.classList.remove("navbar-dark")
}