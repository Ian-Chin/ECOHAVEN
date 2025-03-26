//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───
// NAVIGATION TOGGLE BUTTON FOR MOBILE MENU
//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───

document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    navToggle.addEventListener('click', function() {
        // Toggle the open class on nav-links
        navLinks.classList.toggle('open');
        console.log('Nav toggle clicked'); // For debugging
    });
});

//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───
// HEADER 1 & 2 SCROLL ANIMATION
//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───

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

//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───
// INTERSECTION OBSERVER FOR ANIMATIONS
//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───

const observerOptions = {
    threshold: 0.2,
    rootMargin: '0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
            observer.unobserve(entry.target); // Stops observing after animation
        }
    });
}, observerOptions);

document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '50px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animation class when element comes into view
                entry.target.classList.add('animate');
                
                // Apply delay for destination and review cards
                if (entry.target.classList.contains('destination-card') || 
                    entry.target.classList.contains('review-card')) {
                    const delay = Array.from(entry.target.parentElement.children).indexOf(entry.target) * 0.2;
                    entry.target.style.transitionDelay = `${delay}s`;
                }
            }
        });
    }, observerOptions);

    // List of elements to observe for animations
    const elementsToAnimate = [
        '.main-banner h1',
        '.main-banner p',
        '.banner h1',
        '.banner p',
        '.explore',
        '.destination-card',
        '.review-card',
        '.map-container',
        '.about-us'
    ].join(',');

    document.querySelectorAll(elementsToAnimate).forEach(element => {
        element.classList.add('scroll-animate');
        observer.observe(element);
    });
});

//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───
// SCROLL TO SECTION ON EXPLORE BUTTON CLICK
//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ─── 

const exploreBtn = document.querySelector('.explore');
if (exploreBtn) {
    exploreBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const mainContent = document.querySelector('.main-content');
        mainContent.scrollIntoView({ behavior: 'smooth' });
    });
}

const exploreBtn2 = document.querySelector('.explore');
if (exploreBtn2) {
    exploreBtn2.addEventListener('click', function(e) {
        e.preventDefault();
        const popularNow = document.querySelector('.popular-now');
        popularNow.scrollIntoView({ behavior: 'smooth' });
    });
}

//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───   
// IMPACT NUMBER COUNTING FROM 0 TO TARGET
//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───

function animateCounter(element, target, duration) {
    const startTime = performance.now();
    const startValue = 0;
    
    function updateCounter(currentTime) {
        const elapsedTime = currentTime - startTime;
        
        if (elapsedTime > duration) {
            // Ensure the final value is displayed correctly
            element.textContent = target.includes('+') 
                ? Math.floor(parseInt(target)) + '+' 
                : target.includes('%')
                    ? Math.floor(parseInt(target)) + '%'
                    : Math.floor(parseInt(target)).toLocaleString();
            return;
        }
        
        // Calculate current progress using easing
        const progress = elapsedTime / duration;
        const easedProgress = progress * (2 - progress); // Smooth finish
        
        const currentValue = Math.floor(startValue + (parseInt(target) * easedProgress));
        
        // Format and update text content
        element.textContent = target.includes('+') 
            ? currentValue + '+' 
            : target.includes('%')
                ? currentValue + '%'
                : currentValue.toLocaleString();
        
        requestAnimationFrame(updateCounter);
    }
    
    requestAnimationFrame(updateCounter);
}

// Observer for achievement numbers animation
document.addEventListener('DOMContentLoaded', function() {
    const achievementObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const valueElements = entry.target.querySelectorAll('.achievement-card h3');
                
                valueElements.forEach(element => {
                    // Get target value from HTML
                    const targetValue = element.textContent;
                    
                    // Reset to zero
                    element.textContent = '0';
                    
                    // Start counting animation
                    animateCounter(element, targetValue, 1500); // Duration: 1.5 seconds
                });

                // Stop observing after animation starts
                achievementObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.3,
        rootMargin: '0px'
    });

    // Observe the achievements section
    const achievementsSection = document.querySelector('.achievements-section');
    if (achievementsSection) {
        achievementObserver.observe(achievementsSection);
    }
});

//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───
// ADMIN PAGE: TAB SWITCHING & SEARCH FUNCTIONALITY
//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───

// Function to switch between tabs
function showTab(tabId) {
    // Hide all tab containers
    const tabContainers = document.querySelectorAll('.tab-container');
    tabContainers.forEach(container => {
        container.classList.remove('active');
    });

    // Show the selected tab
    document.getElementById(tabId).classList.add('active');

    // Update active menu item styling
    const menuItems = document.querySelectorAll('.admin-menu-items a');
    menuItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('onclick').includes(tabId)) {
            item.classList.add('active');
        }
    });
}

// Search functionality to filter menu items
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.admin-search-container input');
    searchInput.addEventListener('keyup', function () {
        const searchText = this.value.toLowerCase();
        const menuItems = document.querySelectorAll('.admin-menu-items li');

        menuItems.forEach(item => {
            const itemText = item.textContent.toLowerCase();
            if (itemText.includes(searchText)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───
// PRODUCT SWAP JAVASCRIPT
//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───

document.addEventListener("DOMContentLoaded", function() {
    fetch('exchange_hub.php') // Call the PHP file
        .then(response => response.json())
        .then(data => {
            const productGrid = document.getElementById('productGrid');

            if (!productGrid) return;

            // No records found
            if (data.length === 0) {
                productGrid.innerHTML = '<p>No items are currently listed for exchange.</p>';
                return;
            }

            // Clear the old content first
            productGrid.innerHTML = '';

            data.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');

                productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.product_name}">
                    <h3>${product.product_name}</h3>
                    <p>Posted by: ${product.full_name}</p>
                    <p>Category: ${product.category}</p>
                    <p>Condition: ${product.product_condition}</p>
                    <p>Location: ${product.location}</p>
                    <button class="exchange-btn" data-product-id="${product.id}">Exchange</button>
                `;

                productGrid.appendChild(productCard);
            });
        })
        .catch(error => console.error('Error fetching products:', error));
});


//this is for list an item inventory
document.addEventListener("DOMContentLoaded", function () {
    fetch('list_item.php') // Fetch products
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Data:", data); // Debugging

            const inventoryContainer = document.getElementById('inventory-container');
            if (!inventoryContainer) return;

            // Clear old content first
            inventoryContainer.innerHTML = '';

            // No records found
            if (data.length === 0) {
                inventoryContainer.innerHTML = '<p class="no-items">You have not listed any items yet!.</p>';
                return;
            }

            // Filter and display products
            data.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');

                // Debugging log
                console.log("Product Data:", product);

                productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.product_name}" class="product-image">
                    <h3 class="product-title">${product.product_name}</h3>
                    <p><strong>Category:</strong> ${product.category}</p>
                    <p><strong>Condition:</strong> ${product.product_condition}</p>
                    <p><strong>Location:</strong> ${product.location}</p>
                `;

                inventoryContainer.appendChild(productCard);
            });
        })
        .catch(error => console.error('Error fetching products:', error));
});


//minii inventory testing
document.addEventListener("DOMContentLoaded", function() {
    fetch('exchange_hub.php')
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Data:", data); // Debugging log

            const productGrid = document.getElementById('productGrid');
            if (!productGrid) return;

            const exchangeProducts = data.exchangeProducts;
            const userInventory = data.userInventory;

            productGrid.innerHTML = '';

            if (exchangeProducts.length === 0) {
                productGrid.innerHTML = '<p>No available items for exchange!</p>';
                return;
            }

            exchangeProducts.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');

                let inventoryPopup = '<div class="inventory-popup" style="display: none;">';
                
                if (userInventory.length === 0) {
                    inventoryPopup += '<p>No items available for exchange!</p>';
                } else {
                    userInventory.forEach(item => {
                        inventoryPopup += `<p class="exchange-item" data-item-id="${item.id}" data-product-id="${product.id}">${item.product_name}</p>`;
                    });
                }

                inventoryPopup += '</div>';

                productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.product_name}">
                    <h3>${product.product_name}</h3>
                    <p>Posted by: ${product.full_name}</p>
                    <p>Category: ${product.category}</p>
                    <p>Condition: ${product.product_condition}</p>
                    <p>Location: ${product.location}</p>
                    ${inventoryPopup}
                    <button class="exchange-btn">Exchange</button>
                `;

                productGrid.appendChild(productCard);
            });

            // Add click event for "Exchange" buttons
            document.querySelectorAll('.exchange-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const inventoryPopup = this.previousElementSibling;
                    inventoryPopup.style.display = inventoryPopup.style.display === 'block' ? 'none' : 'block';
                });
            });

            // Click event for selecting exchange item
            document.querySelectorAll('.exchange-item').forEach(item => {
                item.addEventListener('click', function() {
                    const userItemId = this.dataset.itemId;
                    const exchangeProductId = this.dataset.productId;

                    // Show Confirmation Modal
                    const confirmationModal = document.getElementById("confirmationModal");
                    confirmationModal.style.display = "block";

                    // Handle Yes/No actions
                    document.getElementById("confirmSwap").onclick = function() {
                        confirmationModal.style.display = "none"; // Hide confirmation modal
                        processExchange(userItemId, exchangeProductId);
                    };

                    document.getElementById("cancelSwap").onclick = function() {
                        confirmationModal.style.display = "none"; // Hide modal
                    };
                });
            });

            function processExchange(userItemId, exchangeProductId) {
                fetch('swap_product.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ userItemId, exchangeProductId })
                })
                .then(response => response.json())
                .then(result => {
                    const successModal = document.getElementById("successModal");
                    const modalContent = successModal.querySelector("p");
                    const closeBtn = document.getElementById("closeSuccess");

                    if (result.success) {
                        modalContent.innerText = "Product swap successful!";
                        successModal.style.display = "block";
                        closeBtn.onclick = () => location.reload();
                    } else {
                        modalContent.innerText = "Exchange failed: " + result.error;
                        successModal.style.display = "block";
                        closeBtn.onclick = () => successModal.style.display = "none";
                    }
                })
                .catch(error => console.error('Error during exchange:', error));
            }
        })
        .catch(error => console.error('Error fetching exchange items:', error));
});


document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("productGrid").addEventListener("click", function (event) {
        if (event.target.classList.contains("swap-button")) {
            const userItemId = event.target.dataset.userItemId;
            const exchangeProductId = event.target.dataset.exchangeProductId;

            showConfirmation(() => {
                fetch("swap_product.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        userItemId: userItemId,
                        exchangeProductId: exchangeProductId
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccess();
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        }
    });
});


//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───
// RECYCLE PROGRAM JAVASCRIPT
//─── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ────── ⋆⋅☆⋅⋆ ───
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