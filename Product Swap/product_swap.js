document.addEventListener("DOMContentLoaded", function () {
    fetchExchangeHubData();
    fetchUserInventory();
    handleItemFormSubmission();
});

// Function to fetch exchange hub data
function fetchExchangeHubData() {
    fetch('exchange_hub.php')
        .then(response => response.json())
        .then(data => {
            const productGrid = document.getElementById('productGrid');
            if (!productGrid) return;

            productGrid.innerHTML = ''; // Clear previous content

            // If user is not logged in, display message
            if (data.notLoggedIn) {
                productGrid.innerHTML = '<p class="login-message">Log in to view products!</p>';
                return;
            }

            // Check if there are exchangeable products
            if (!data.exchangeProducts || data.exchangeProducts.length === 0) {
                productGrid.innerHTML = '<p>No items are currently listed for exchange.</p>';
                return;
            }

            // Populate exchangeable products
            data.exchangeProducts.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');

                let inventoryPopup = '<div class="inventory-popup" style="display: none;">';
                
                if (!data.userInventory || data.userInventory.length === 0) {
                    inventoryPopup += '<p>No items available for exchange!</p>';
                } else {
                    data.userInventory.forEach(item => {
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

            // Attach event listeners for exchange buttons
            attachExchangeEvents();
        })
        .catch(error => {
            console.error('Error fetching exchange items:', error);
            document.getElementById('productGrid').innerHTML = '<p>Error loading products. Please try again later.</p>';
        });
}

// Function to attach exchange button events
function attachExchangeEvents() {
    document.querySelectorAll('.exchange-btn').forEach(button => {
        button.addEventListener('click', function() {
            const inventoryPopup = this.previousElementSibling;
            inventoryPopup.style.display = inventoryPopup.style.display === 'block' ? 'none' : 'block';
        });
    });

    document.querySelectorAll('.exchange-item').forEach(item => {
        item.addEventListener('click', function() {
            const userItemId = this.dataset.itemId;
            const exchangeProductId = this.dataset.productId;
            showConfirmationModal(userItemId, exchangeProductId);
        });
    });
}

// Function to show confirmation modal
function showConfirmationModal(userItemId, exchangeProductId) {
    const confirmationModal = document.getElementById("confirmationModal");
    confirmationModal.style.display = "block";

    document.getElementById("confirmSwap").onclick = function() {
        confirmationModal.style.display = "none";
        processExchange(userItemId, exchangeProductId);
    };

    document.getElementById("cancelSwap").onclick = function() {
        confirmationModal.style.display = "none";
    };
}

// Function to process product exchange
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

// Function to fetch user inventory
function fetchUserInventory() {
    fetch('list_item.php')
        .then(response => response.json())
        .then(data => {
            const inventoryContainer = document.getElementById('inventory-container');
            if (!inventoryContainer) return;

            inventoryContainer.innerHTML = '';

            const emptyInventory = document.getElementById('empty-inventory');
            if (!Array.isArray(data) || data.length === 0) {
                emptyInventory.innerHTML = '<p>You have not listed any items yet!</p>';
                return;
            } else {
                emptyInventory.innerHTML = ''; // Clear message when items exist
            }

            data.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');

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
}

// Function to handle item form submission
function handleItemFormSubmission() {
    const form = document.getElementById("listItemForm");

    if (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent form navigation

            let formData = new FormData(form);

            fetch("item_form.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showPopup(data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    showPopup("Error: " + data.error);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }
}

// Function to show a popup message
function showPopup(message) {
    const popup = document.createElement("div");
    popup.classList.add("custom-popup");
    popup.innerHTML = `<p>${message}</p>`;
    document.body.appendChild(popup);

    setTimeout(() => {
        popup.remove();
    }, 2000);
}
