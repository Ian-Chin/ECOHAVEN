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


