document.addEventListener('DOMContentLoaded', () => {
    var mains = document.querySelectorAll(".main");
    mains.forEach(main => {
        var footer = main.querySelector(".footer");
        var comment = main.querySelector(".comment");

        // Check if footer and comment elements are found
        if (footer && comment) {

            footer.addEventListener("click", function() {
                if (comment.style.display === "none" || comment.style.display === "") {
                    comment.style.display = "block";
                } else {
                    comment.style.display = "none";
                }
            });
        }
    });
});
