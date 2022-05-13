var chatopen = false;
var openchatdiv = document.getElementById("openchat");
var openchatarrow = document.getElementById("chevron-arrow");
document.querySelector("#openchat").addEventListener("click", function () {
    if (chatopen === false) {
        document.getElementById("chat").style.width = "30%";
        openchatdiv.style.left = "30%";
        openchatarrow.style.transform = "rotate(180deg)";
        chatopen = true;
        console.log(chatopen);
    }
    else{
        document.getElementById("chat").style.width = "0px";
        openchatdiv.style.left = "0px";
        openchatarrow.style.transform = "rotate(0deg)";
        chatopen = false;
        console.log(chatopen);
    }
});