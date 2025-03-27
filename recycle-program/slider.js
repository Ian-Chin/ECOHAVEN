let bins = document.querySelectorAll(".recycle_bin_item");
let dotsContainer = document.querySelector(".dots ul");
let backButton = document.getElementById("back_button");
let forwardButton = document.getElementById("forward_button");
let index = 0; // Start at the first item

// Create dots based on the number of bins
function createDots() {
    dotsContainer.innerHTML = ""; // Clear existing dots
    bins.forEach((_, i) => {
        let dot = document.createElement("li");
        dot.classList.add("dot");
        if (i === 0) dot.classList.add("dot_active"); // First dot is active
        dotsContainer.appendChild(dot);
    });
}

// Show only the active bin
function showBin(n) {
    bins.forEach((bin, i) => {
        bin.style.display = i === n ? "block" : "none";
    });

    let dots = document.querySelectorAll(".dot");
    dots.forEach((dot, i) => {
        dot.classList.toggle("dot_active", i === n);
    });
}

// Initialize dots and show the first bin
createDots();
showBin(index);

// Button event listeners
forwardButton.onclick = function () {
    index = (index + 1) % bins.length; // Move to next, loop back if at end
    showBin(index);
};

backButton.onclick = function () {
    index = (index - 1 + bins.length) % bins.length; // Move to previous, loop back if at start
    showBin(index);
};
