// Selecting DOM elements
const form = document.querySelector(".login form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-text");

// Preventing the form from submitting and refreshing the page
form.onsubmit = (e)=>{
    e.preventDefault();
}

// Handling click events on the continue button
continueBtn.onclick = ()=>{
    // Creating a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    // Configuring the request to send a POST request to "php/login.php"
    xhr.open("POST", "php/login.php", true);
    // Handling the response from the server
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                // Getting the response data from the server
                let data = xhr.response;
                // Checking if the login was successful
                if(data === "success"){
                    // Redirecting to the "users.php" page on success
                    location.href = "users.php";
                } else {
                    // Displaying an error message if the login was not successful
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
