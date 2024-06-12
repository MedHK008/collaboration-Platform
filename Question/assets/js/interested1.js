let formations = document.querySelectorAll(".formation");
formations.forEach(formation => {
    let button = formation.querySelector("#interested");
    let formationId = formation.querySelector("#A");
    button.addEventListener("click", function () {
        if (button.textContent.trim() === "Interesser") {
            button.style.backgroundColor = "white";
            button.style.color = "black";
            button.style.border = "1px solid black";
            button.innerHTML = "<i class='fa-regular fa-bell-slash'></i>Interesté(e)";
            console.log(formationId.value);
            $.ajax({
                method: 'POST',
                url: 'assets/phpScripts/interesteddb.php',
                data: { courseID: formationId.value },
            });
        } else {
            button.style.backgroundColor = "#4A68D3";
            button.style.color = "white";
            button.style.border = "none";
            button.innerHTML = "<i class='fa-solid fa-bell'></i>Interesser";
            $.ajax({
                method: 'POST',
                url: 'assets/phpScripts/notinteresser.php',
                data: { courseID: formationId.value }, 
            });
        }
    });
});
