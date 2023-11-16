// Selecting DOM elements
const searchBar = document.querySelector(".search input"),
    searchIcon = document.querySelector(".search button"),
    usersList = document.querySelector(".users-list");

// Handling click events on the search icon
searchIcon.onclick = ()=>{
    // Toggling the "show" class on the search bar for visibility
    searchBar.classList.toggle("show");
    // Toggling the "active" class on the search icon for visual indication
    searchIcon.classList.toggle("active");
    // Focusing on the search bar
    searchBar.focus();
    // Clearing the search bar value and removing the "active" class if it's already active
    if(searchBar.classList.contains("active")){
        searchBar.value = "";
        searchBar.classList.remove("active");
    }
}

// Handling keyup events on the search bar
searchBar.onkeyup = ()=>{
    // Getting the search term from the search bar
    let searchTerm = searchBar.value;
    // Adding or removing the "active" class on the search bar based on whether there is a search term
    if(searchTerm != ""){
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }
    // Creating a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    // Configuring the request to send a POST request to "php/search.php" with the search term
    xhr.open("POST", "php/search.php", true);
    // Handling the response from the server
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                // Updating the users list with the response data
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    // Setting the request header and sending the request with the search term
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

// Periodically fetching the users list from the server and updating the users list
setInterval(() =>{
    // Creating a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    // Configuring the request to send a GET request to "php/users.php"
    xhr.open("GET", "php/users.php", true);
    // Handling the response from the server
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                // Updating the users list with the response data if the search bar is not active
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                    usersList.innerHTML = data;
                }
            }
        }
    }
    // Sending the request
    xhr.send();
}, 500);
