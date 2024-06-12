var competence =document.querySelector('#competence');
var description=document.querySelector("#Description");
var level=document.querySelector('#level');
var confirmer2=document.querySelector("#confirmer2");
function champs_obligatoire2(){
    if(competence.value=="" ||description.value=="" ||level.value=="")
        return 0;
    return 1;
}
confirmer2.addEventListener("click",function(event){
    if(champs_obligatoire2()==0)
        event.preventDefault();
})