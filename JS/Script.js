let addbutton = 
document.querySelector("#addFile");
addbutton.addEventListener("click", function() {
    document.querySelector("#files").style.display = "block";
})



let submitButton = document.querySelector("#submitComment");

submitButton.addEventListener("click", function (e) {
//postId
//userName
//comment text

let text = document.querySelector("#textComment").value;
//Post naar database via AJAX;
let formData = new FormData();
//Vraagt specifiek element waarop geklikt werd uit de HTML
let userName = submitButton.dataset.username;
let postId = submitButton.dataset.postid;
//console.log(postId);

formData.append("text", text);
formData.append("username", userName);
formData.append("postId", postId);

fetch("ajax/saveComment.php", {

    method: "POST",
    body: formData
})
.then(response=>response.json()

)
.then(result => {
        let newComment = document.createElement("li");
        newComment.innerHTML = result.user + " " + result.body;
        document.querySelector(".commentList").appendChild(newComment);
        commentAmount.innerHTML ++ ;
        document.querySelector("#textComment").value = "";

})
.catch (error=> {

    console.error("Error:", error);
});

e.preventDefault();
})




