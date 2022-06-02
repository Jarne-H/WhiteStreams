Ajax 

document.querySelector("#btn").addEventListener("click", e=> {
    //We moeten op de button klikken
    //Text uitlezen
    let message = document.querySelector("#comment").ariaValueMax;
    //let postid = 1;
    
    //Data moet naar de databank via AJAX naar de server posten;
    let data = new FormData();
    data.append("comment",message);
    data.append("userId",userId);
    
    
    
    fetch('./ajax/save_comment.php', {
      method: 'POST', // or 'PUT'
      
      body:data,
    })
    .then(response => response.json())
    .then(data => {
    if (data.status ==="success") {
        let li = `<li>${data.data.userId}: ${data.data.comment}</li>`;
        document.querySelector("#listupdates").innerHTML += li;
        document.querySelector("#comment").value ="";
    }})
    .catch((error) => {
      console.error('Error:', error);
    
    });
    
    e.preventDefault(); 
    
    
    });


    