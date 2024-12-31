<?php

include("inc/header.php");

?>



<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6" style="color: aliceblue !important;">My Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- cart body -->

<div class="container my-5">
    <h2 class="text-center">My Cart</h2>
    <div id="cart-container" class="mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Dynamic Cart Items -->
            </tbody>
        </table>
        <div class="text-end">
            <h4 id="cart-total">Total: Rs. 0</h4>
        </div>
        <div class="text-center mt-4">
            <button id="buy-now-btn" class="btn btn-primary buy_now">Buy Now</button>
        </div>
    </div>



</div>

<?php

include("inc/footer.php");

?>
<script>
    // Array to store cart items
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Function to update cart UI
    function updateCartUI() {
        const cartItemsContainer = document.getElementById('cart-items');
        const cartTotalElement = document.getElementById('cart-total');
        let total = 0;

        // Clear existing cart items
        cartItemsContainer.innerHTML = '';

        // Display each item in the cart
        cart.forEach((item, index) => {
            total += parseFloat(item.price.replace('Rs.', '').trim());

            const cartRow = `
                <tr>
                    <td><img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px;"></td>
                    <td>${item.name}</td>
                    <td>${item.price}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">Remove</button>
                    </td>
                </tr>
            `;
            cartItemsContainer.innerHTML += cartRow;
        });

        // Update total price
        cartTotalElement.textContent = `Total: Rs. ${total}`;
    }

    // Function to update cart count
    function updateCartCount() {
        const cartCountElement = document.getElementById('cart-count');
        const cart = JSON.parse(localStorage.getItem("cart")) || []; // Get cart from localStorage
        cartCountElement.textContent = cart.length; // Update count
    }

    // Load cart count on page load
    document.addEventListener('DOMContentLoaded', updateCartCount);


    // Function to remove an item from the cart
    function removeFromCart(index) {
        cart.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartUI();
    }

    // Function to add an item to the cart
    function addToCart(name, price, image) {
        const product = {
            name,
            price,
            image
        };
        cart.push(product);
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartUI();
        alert(`${name} added to cart.`);
    }

    // Load the cart on page load
    document.addEventListener('DOMContentLoaded', updateCartUI);
</script>

</script>
<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>