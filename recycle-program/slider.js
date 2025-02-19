let bins = document.querySelectorAll(".recycle_bin_item");
let dotsContainer = document.querySelector(".dots ul"); // Where the dots are shown
let buttons = document.querySelectorAll(".slider_buttons button"); // Get both buttons (previous and next)
let index = 0; // Start at the first item

// This function will create the dots based on how many bins there are
function createDots() {
    dotsContainer.innerHTML = ""; // First, remove all the old dots
    for (let i = 0; i < bins.length; i++) { // Go through each bin
        const dot = document.createElement("li"); // Create a new dot
        dot.classList.add("dot"); // Give it the class "dot"
        dotsContainer.appendChild(dot); // Add the dot to the dots container
    }

    // After creating the dots, update the dots collection
    dots = document.querySelectorAll(".dot");
    dots[index].classList.add("dot_active"); // Make the first dot active (black)
}

// This function will show only one bin at a time, based on the current index
function showBin(n) { // n at here is a parameter (is the placeholder for the value that will be used inside the function.)
    bins.forEach((bin, i) => {
        // If the bin is the current one (n), show it, otherwise hide it
        bin.style.display = i === n ? "block" : "none";
        // If it's the current bin, make its dot active (black), otherwise keep it gray
        dots[i].classList.toggle("dot_active", i === n);
    });
}

// Initially, create the dots and show the first bin
createDots();
showBin(index); // index at here is a variable (is the actual value being used when we call the function.)

// When the "next" button is clicked, move to the next bin
buttons[1].onclick = function () {
    index = (index + 1) % bins.length; // Go to the next bin, loop back to the start if at the end
    showBin(index); // Show the new bin
};

// When the "previous" button is clicked, move to the previous bin
buttons[0].onclick = function () {
    index = (index - 1 + bins.length) % bins.length; // Go to the previous bin, loop back to the end if at the start
    showBin(index); // Show the new bin
};
