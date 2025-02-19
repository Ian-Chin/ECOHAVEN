function show_content(id) {
    let content = document.getElementById(id);
    let currentDisplay = window.getComputedStyle(content).display;

    content.style.display = (currentDisplay === "none") ? "block" : "none";
}

// function create_form(id){
//     let form = document.getElementById(id);
//     let formShow = window.getComputedStyle(form).display;

//     form.style.display = (formShow === "none") ? "block" : "none";
// }

// function delete_form(id){
//     let dlt = document.getElementById(id);
//     let dltShow = window.getComputedStyle(dlt).display;

//     dlt.style.display = (dltShow === "none") ? "block" : "none";
// }

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

// recycle_admin_main create & delete button
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

// recycle_admin_main delete reset button
document.getElementById("delete_reset").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("delete_event_form").reset();
});

// join.html reset button
document.getElementById("join_reset").onlick = function(){
    document.getElementById("join_event_form").reset();
};