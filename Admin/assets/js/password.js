var regMaj=/[A-Z]/;
var regMin=/[a-z]/;
var regNum=/[0-9]/;
var oldpassword=document.querySelector('#oldPass');
var newpass=document.querySelector('#newPass');
var confpass=document.querySelector('#confirmPass');
var error=document.querySelectorAll('.error-pass');
var confirmer1=document.querySelector("#confirmerpass");
var samePass=document.querySelector(".samePass");
function champs_obligatoire1(){
    error.forEach(err => err.innerHTML = "");

    if(oldpassword.value==""){
        error[0].innerHTML="<span style='color:red'>Champs obligatoire</span>"
        return 0;
    }
    if(newpass.value==""){
        error[1].innerHTML="<span style='color:red'>Champs obligatoire</span>"
        return 0;
    }
    if(confpass.value==""){
        error[2].innerHTML="<span style='color:red'>Champs obligatoire</span>"
        return 0;
    }
    return 1;

}
function verifier_pass(){
    error[1].innerHTML = "";
    if(newpass.value.length<9)
        {
            error[1].innerHTML="<span style='color:red'>le mot de passe doit contenir au moins 9 caracteres</span>"
            return 0;
        }
    else if(!regMaj.test(newpass.value))
            {
                error[1].innerHTML="<span style='color:red'>le mot de passe doit avoir au moins 1 alphabet Majiscules</span>";
                return 0;
            }
    else if(!regMin.test(newpass.value))
            {
                error[1].innerHTML="<span style='color:red'>le mot de passe doit avoir au moins 1 alphabet miniscule</span>";
                return 0;
            }
    else if(!regNum.test(newpass.value))
            {
                error[1].innerHTML="<span style='color:red'>le mot de passe doit avoir au moins 3 chiffres</span>";
                return 0;
            }
    else
            {
                error[1].innerHTML="<span style='color:green'>form correct</span>";
                return 1;
            }
}
function verifier_old_pass(){
    samePass.innerHTML = "";
    if(oldpassword.value===newpass.value)
        {
            samePass.innerHTML="<span style='color:#ffa500'>Eviter d'utiliser votre ancien mot de passe</span>";
            return 0;
        }
}
function verifier_conf_pass(){
    error[2].innerHTML = "";

    if(newpass.value!=confpass.value)
        {
            error[2].innerHTML="<span style='color:red'>Password incorrecte</span>";
            return 0;
        }
    else{
        error[2].innerHTML="<span style='color:green'>Password correcte</span>";
            return 1;
    }
}

newpass.addEventListener("input", verifier_pass);
confpass.addEventListener("input",verifier_conf_pass);
confirmer1.addEventListener("click",function(event){
    if(champs_obligatoire1()==0 ||verifier_pass()==0 || verifier_conf_pass()==0)
        event.preventDefault();
})

