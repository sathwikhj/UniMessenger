// Selecting DOM elements
const form = document.querySelector(".typing-area"),
    incoming_id = form.querySelector(".incoming_id").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");

// Preventing the form from submitting and refreshing the page
form.onsubmit = (e)=>{
    e.preventDefault();
}

// Focusing on the input field when the page loads
inputField.focus();

// Adding/removing the "active" class to the send button based on input field value
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}

// Handling click events on the send button
sendBtn.onclick = ()=>{
    // Creating a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    // Configuring the request to send a POST request to "php/insert-chat.php"
    xhr.open("POST", "php/insert-chat.php", true);
    // Handling the response from the server
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                // Clearing the input field and scrolling to the bottom of the chat box
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    // Creating a FormData object from the form and sending the request
    let formData = new FormData(form);
    xhr.send(formData);
}

// Handling mouse enter event on the chat box
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

// Handling mouse leave event on the chat box
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

// Periodically fetching chat data from the server and updating the chat box
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                // Updating the chat box with the response data
                let data = xhr.response;
                chatBox.innerHTML = data;
                // If the chat box is not active, scroll to the bottom
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }
    }
    // Setting the request header and sending the request with the incoming_id parameter
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

// Function to scroll the chat box to the bottom
function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}
