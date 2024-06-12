var mains = document.querySelectorAll(".main");
mains.forEach(main => {
  var commentaires = main.querySelectorAll(".commentaire");
  commentaires.forEach(comment => {
    var idcomment=comment.querySelector(".idcomment");
    var reactions = comment.querySelector(".reaction");
    var like = reactions.querySelector("#like");
    var dislike = reactions.querySelector("#dislike");
    var likeState = 0;
    var dislikeState = 0;
  
    

    like.addEventListener("click", function() {
      if (likeState == 0 && dislikeState == 0) {
        like.className = "fa-solid fa-thumbs-up";
        likeState = 1;
        console.log(1);
        console.log(idcomment.value);
        like.parentNode.querySelector("span").textContent++;
        $.ajax({
            method: 'POST',
            url: 'assets/phpScripts/like.php',
            data: { idcommentaire :idcomment.value }
        });
      } else if (likeState == 1 && dislikeState == 0) {
        like.className = "fa-regular fa-thumbs-up";
        likeState = 0;
        console.log(2);
        console.log(idcomment.value);
        like.parentNode.querySelector("span").textContent--;

        $.ajax({
            method: 'POST',
            url: 'assets/phpScripts/unlike.php',
            data: { idcommentaire: idcomment.value }
        });
      } else {
        return;
      }
    });
    dislike.addEventListener("click", function() {
      if (dislikeState == 0 && likeState == 0) {
        dislike.className = "fa-solid fa-thumbs-down";
        dislikeState = 1;
        dislike.parentNode.querySelector("span").textContent++;

        console.log(3);
        console.log(idcomment.value);
        $.ajax({
            method: 'POST',
            url: 'assets/phpScripts/dislike.php',
            data: { idcommentaire: idcomment.value }
        });
      } else if (dislikeState == 1 && likeState == 0) {
        dislike.parentNode.querySelector("span").textContent--;

        dislike.className = "fa-regular fa-thumbs-down";
        dislikeState = 0;
        $.ajax({
            method: 'POST',
            url: 'assets/phpScripts/undislike.php',
            data: { idcommentaire: idcomment.value }
        });
      } else {
        return;
      }
    });
  });
});

  