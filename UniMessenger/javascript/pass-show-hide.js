// Selecting DOM elements
const pswrdField = document.querySelector(".form input[type='password']"),
    toggleIcon = document.querySelector(".form .field i");

// Handling click events on the toggle icon
toggleIcon.onclick = () =>{
    // Checking the type of the password field
    if(pswrdField.type === "password"){
        // If the password field is of type "password", change it to "text"
        pswrdField.type = "text";
        // Adding the "active" class to the toggle icon for visual indication
        toggleIcon.classList.add("active");
    } else {
        // If the password field is of type "text", change it back to "password"
        pswrdField.type = "password";
        // Removing the "active" class from the toggle icon
        toggleIcon.classList.remove("active");
    }
}
