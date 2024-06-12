var id=document.querySelector("#Nom");
var pass=document.querySelector("#password");
var connecter=document.querySelector("#Seconnecter");
function verifier(){
    if(id.value=="" || pass.value=="") return 0;
    return 1;
}
connecter.addEventListener("click",function(event){
    if(verifier()==0) event.preventDefault();
})
