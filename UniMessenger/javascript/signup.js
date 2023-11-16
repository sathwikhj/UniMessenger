const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");


// Preventing the form from submitting and refreshing the page
form.onsubmit = (e)=>{
    e.preventDefault();
}

// Handling click events on the continue button
continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="users.php";
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }

    // Creating a FormData object from the form and sending the request
    let formData = new FormData(form);
    xhr.send(formData);
}