var reg_exp_mail = /^[a-zA-Z0-9._]+@[a-zA-Z0-9]+\.[a-z]{2,6}$/;
var Cinreg=/^[A-Za-z]{2,2}[0-9]{6,6}$/;
var nom=document.querySelector('#nom');
var prenom=document.querySelector('#prenom');
var bdate=document.querySelector('#bdate');
var cin=document.querySelector('#cin');
var mail=document.querySelector('#mail');
var adresse=document.querySelector('#adresse');
var spec=document.querySelector("#specialite");
var error=document.querySelectorAll('.error');
var error_form=document.querySelectorAll('.error-form');
var confirmer=document.querySelector('#confirmer0')
function champs_obligatoire0(){
  if(nom.value=="")
    {
      error[0].innerHTML="<span style=\"color:red\">Champs obligatoire</span>";
      return 0;
    }
  else if(prenom.value=="")
      {
        error[3].innerHTML="<span style=\"color:red\">Champs obligatoire</span>";
        return 0;
      }
    else if(bdate.value=="")
        {
          error[1].innerHTML="<span style=\"color:red\">Champs obligatoire</span>";
          return 0;
        }
    else if(cin.value=="")
          {
            error[4].innerHTML="<span style=\"color:red\">Champs obligatoire</span>";
            return 0;
          }
    else if(mail.value=="")
            {
              error[2].innerHTML="<span style=\"color:red\">Champs obligatoire</span>";
              return 0;
            }
    else if(adresse.value=="")
              {
                error[5].innerHTML="<span style=\"color:red\">Champs obligatoire</span>";
                return 0;
              }
else {
  return 1;
}
        
      
}
function verifier_mail(){
  if(!reg_exp_mail.test(mail.value))
    {
      error_form[0].innerHTML="<span style=\"color:red\">Forme incompatible</span>";
      return 0;
    }
  else {
    error_form[0].innerHTML="<span style=\"color:green\">Forme compatible</span>";
    return 1;
  }

}
function verifier_cin(){
  if(!Cinreg.test(cin.value))
    {
      error_form[1].innerHTML="<span style=\"color:red\">Forme incompatible</span>";
      return 0;
    }
    else {
      error_form[1].innerHTML="<span style=\"color:green\">Forme compatible</span>";
      return 1;
    }

}
cin.addEventListener("input",verifier_cin);
mail.addEventListener("input",verifier_mail);
confirmer.addEventListener("click",function(event){
  if(champs_obligatoire0()==0 || verifier_cin()==0 || verifier_mail()==0)
    event.preventDefault();

});
