var bcs = document.querySelectorAll(".bc");
bcs.forEach(bc => {
    var img = bc.querySelector("img");
    var iframe = bc.querySelector("iframe");
    var button = bc.querySelector("button");

   

    button.addEventListener("click", function() {
      

        if (button.textContent === "Voir details") {
            button.innerHTML="<i class='fa-solid fa-minus' style='color: #ffffff;'></i>Reduire";
            img.style.display = "block";
            iframe.style.display = "block";
        }
         else {
            button.innerHTML="<i class='fa-solid fa-plus' style='color: #ffffff;'></i>Voir details";
             img.style.display = "none";
             iframe.style.display = "none";
        }
    });
});
