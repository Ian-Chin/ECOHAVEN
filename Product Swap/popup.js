document.querySelector('.nav-toggle').addEventListener('click', function () {
    const nav = document.querySelector('.nav');
    nav.classList.toggle('open'); // Toggle the "open" class
});


window.addEventListener("scroll", function () {
    const headerBar = document.querySelector(".header-bar");
    if (window.scrollY > 50) {
        headerBar.classList.add("scrolled");
    } else {
        headerBar.classList.remove("scrolled");
    }
});

window.addEventListener("scroll", function () {
    const headerBar2 = document.querySelector(".header-bar2");
    if (window.scrollY > 50) {
        headerBar2.classList.add("scrolled");
    } else {
        headerBar2.classList.remove("scrolled");
    }
});

// // // Product Swap javascript - Bowie
// // //prevent page reload and goes into new blank web page
// document.addEventListener("DOMContentLoaded", function () {
//     document.getElementById("listItemForm").addEventListener("submit", function (event) {
//         event.preventDefault(); //prevent reload code

//         let formData = new FormData(this);

//         fetch("list_item.php", {
//             method: "POST",
//             body: formData,
//         })
//         .then(response => response.text()) //give back response as text form
//         .then(data  => {
//             alert(data); //display success message in alert box
//             console.log("Server Response: ",data);
//             document.getElementById("listItemForm").reset(); //clear form
//         })
//         .catch(error => console.error("Error occur:", error));
//     });
// });

