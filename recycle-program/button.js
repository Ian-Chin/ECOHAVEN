// Recycle.html global section buttons's content
function show_content(id) {
    var content = document.getElementById(id);
    content.style.display = content.style.display === "none" || content.style.display === "" ? "block" : "none";
}

// Do & Don'ts
function toggleContent(type){
    // Get the corresponding content and image
    let content, image;

    if(type === 'do'){
        content = document.getElementById("do_list");
        image = document.getElementById("do_image");
    }
    else if(type === "donts"){
        content = document.getElementById("donts_list");
        image = document.getElementById("donts_image");
    }

    // Toggle visibility of the content
    if(content.style.display === "none" || content.style.display === ""){
        content.style.display = "block"; // Show content
    }
    else{
        content.style.display = "none"; // Hide content
    }
}

// recycle_admin_main create button
function toggleForm(classname){
    let formDiv = document.querySelector("." + classname); // Find the form div using class name
    if(formDiv.style.display === "none" || formDiv.style.display === ""){
        formDiv.style.display = "flex"; // Show the form
    }
    else{
        formDiv.style.display = "none"; // Hide the form
    }
}

// recycle_admin_main create reset button
document.getElementById("create_reset").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default reset behavior
    document.getElementById("create_event_form").reset(); // Clear form
});

// join.html reset button
document.getElementById("join_reset").onlick = function(){
    document.getElementById("join_event_form").reset();
};

// recycle_admin_main create form validate date before submitting
function validateDate() {
    const eventDateInput = document.getElementById("event_date");
    const selectedDate = new Date(eventDateInput.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);  // Clear time to only compare dates

    if (selectedDate < today) {
        alert("The date has passed. Please select a valid date.");
        return false;  // prevent form submission
    }
    return true;  // allow form submission
}
