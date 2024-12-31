// Initialize cart from localStorage
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Update Cart UI
function updateCartUI() {
  const cartItemsContainer = document.getElementById("cart-items");
  const cartTotalElement = document.getElementById("cart-total");
  let total = 0;

  cartItemsContainer.innerHTML = ""; // Clear existing items

  // Populate cart items
  cart.forEach((item, index) => {
    total += parseFloat(item.price.replace("Rs.", "").trim());

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

// Add to Cart
function addToCart(name, price, image) {
  const product = { name, price, image };
  cart.push(product);
  localStorage.setItem("cart", JSON.stringify(cart));

  // Update cart count
  updateCartCount();

  alert(`${name} added to cart.`);
  window.location.href = ""; // Redirect to the cart page
}

// Function to update cart count
function updateCartCount() {
  const cartCountElement = document.getElementById("cart-count");
  cartCountElement.textContent = cart.length; // Update the count based on cart length
}

// Load cart count on page load
document.addEventListener("DOMContentLoaded", updateCartCount);

// Remove from Cart
function removeFromCart(index) {
  cart.splice(index, 1); // Remove item
  localStorage.setItem("cart", JSON.stringify(cart));
  console.log(cart)
  updateCartCount();
  updateCartUI();
}

// Load cart data on page load
document.addEventListener("DOMContentLoaded", updateCartUI);
