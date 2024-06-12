var projet =document.querySelector('#projet');
var role=document.querySelector("#role");
var confirmer3=document.querySelector("#confirmer3");

function champs_obligatoire3(){
    if(projet.value=="" ||role.value=="")
        return 0;
    return 1;
}
confirmer3.addEventListener("click",function(event){
    if(champs_obligatoire3()==0)
        event.preventDefault();
})