let evenements = document.querySelectorAll(".evenement");
evenements.forEach(evenement => {
    let button = evenement.querySelector("#participer");
    let eventId = evenement.querySelector("#B");
    button.addEventListener("click", function () {
        if (button.textContent.trim() === "Participer") {
            button.style.backgroundColor = "white";
            button.style.color = "black";
            button.style.border = "1px solid black";
            button.innerHTML = "<i class='fa-regular fa-bell-slash'></i>Participé(e)";
            console.log(eventId.value);
            $.ajax({
                method: 'POST',
                url: 'assets/phpScripts/participateEvent.php',
                data: { event_id: eventId.value },
            });
        } else {
            button.style.backgroundColor = "#4A68D3";
            button.style.color = "white";
            button.style.border = "none";
            button.innerHTML = "<i class='fa-regular fa-bell'></i>Participer";
            $.ajax({
                method: 'POST',
                url: 'assets/phpScripts/departicipateEvent.php',
                data: { event_id: eventId.value },
            });
        }
    });
});
