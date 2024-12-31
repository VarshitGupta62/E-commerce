<?php

include("inc/header.php");

?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    .product-section {
        display: flex;
        flex-direction: column;
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .image-gallery {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .main-image {
        width: 100%;
        max-width: 600px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .thumbnail-container {
        display: flex;
        gap: 10px;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        border-radius: 5px;
        cursor: pointer;
        transition: border 0.3s;
    }

    .thumbnail:hover {
        border: 2px solid #333;
    }

    .product-details {
        padding: 20px;
    }

    .product-title {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 28px;
        color: #e63946;
        margin-bottom: 15px;
    }

    .product-description {
        font-size: 16px;
        color: #555;
        margin-bottom: 20px;
    }

    .product-overview {
        margin-bottom: 20px;
        font-size: 14px;
        color: #333;
    }

    .button-container {
        display: flex;
        gap: 10px;
    }

    .button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .add-to-cart {
        background-color: #28a745;
        color: #fff;
    }

    .add-to-cart:hover {
        background-color: #218838;
    }

    .buy-now {
        background-color: #007bff;
        color: #fff;
    }

    .buy-now:hover {
        background-color: #0056b3;
    }

    @media (min-width: 768px) {
        .product-section {
            flex-direction: row;
            gap: 20px;
        }

        .product-details {
            flex: 1;
        }

        .image-gallery {
            flex: 1;
        }
    }
</style>



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

<?php

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch product details from the database
$sql = "SELECT * FROM addproduct WHERE id = $product_id AND p_is_active = 1";
$result = $conn->query($sql);

// Check if product exists
if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die("Product not found or inactive.");
}
?>




<div class="product-section">
<div class="image-gallery">
        <!-- Main Image -->
        <img src="admin/uploads/<?= $product['p_image']; ?>" alt="Product Image" class="main-image" id="mainImage">
        <div class="thumbnail-container">
        <img src="admin/uploads/<?= $product['p_image']; ?>" alt="Thumbnail" class="thumbnail" onclick="changeImage(this)">
            <?php
            // Split the comma-separated list of images in 'p_other_image'
            $otherImages = explode(',', $product['p_other_image']);
            foreach ($otherImages as $otherImage) {
                // Trim any whitespace and generate a thumbnail for each image
                $otherImage = trim($otherImage);
                if (!empty($otherImage)) {
                    echo '<img src="admin/uploads/' . htmlspecialchars($otherImage) . '" alt="Thumbnail" class="thumbnail" onclick="changeImage(this)">';
                }
            }
            ?>
        </div>
    </div>
    <script>
        // JavaScript function to change the main image
        function changeImage(thumbnail) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = thumbnail.src; // Update the main image's source
        }
    </script>
    <div class="product-details">
        <!-- Dynamic Product Title -->
        <h1 class="product-title"><?= htmlspecialchars($product['product_name']); ?></h1>

        <!-- Dynamic Pricing -->
        <p class="product-price">
            <?= htmlspecialchars($product['P_new_price']); ?>
            <span style="text-decoration: line-through; color: #999;">
                <?= htmlspecialchars($product['p_old_price']); ?>
            </span>
        </p>

        <!-- Dynamic Description -->
        <p class="product-description">
            <?= htmlspecialchars($product['p_description']); ?>
        </p>

        <div class="product-overview">
            <h3>Product Overview:</h3>
            <!-- Dynamic Overview -->
            <p><?= nl2br(htmlspecialchars($product['p_overview'])); ?></p>
        </div>

        <div class="button-container">
            <!-- Dynamic Add to Cart Button -->
            <button
                onclick="addToCart('<?= htmlspecialchars($product['product_name']); ?>', '<?= htmlspecialchars($product['P_new_price']); ?>', 'admin/uploads/<?= htmlspecialchars($product['p_image']); ?>')"
                class="btn border border-secondary rounded-pill px-3 text-primary">
                <i class="fa fa-shopping-bag me-2 text-primary"></i>
                Add to cart
            </button>
            <button class="button buy-now">Buy Now</button>
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






    function changeImage(thumbnail) {
        const mainImage = document.getElementById('mainImage');
        mainImage.src = thumbnail.src;
    }
</script>

</script>
<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>