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
    


    <div class="product-section">
        <div class="image-gallery">
            <img src="wood-img/bed1.jpg" alt="Product Image" class="main-image" id="mainImage">
            <div class="thumbnail-container">
                <img src="wood-img/bed2.jpg" alt="" class="thumbnail" onclick="changeImage(this)">
                <img src="wood-img/bed3.jpg" alt="" class="thumbnail" onclick="changeImage(this)">
                <img src="wood-img/bed4.jpg" alt="" class="thumbnail" onclick="changeImage(this)">
            </div>
        </div>
        <div class="product-details">
            <h1 class="product-title">Marriott 1 Seater Wooden Sofa</h1>
            <p class="product-price">Rs 17,499 <span style="text-decoration: line-through; color: #999;">Rs 27,299</span></p>
            <p class="product-description">This one-seater wooden sofa is designed with comfort and elegance in mind. Featuring a walnut finish and premium fabric, it fits seamlessly into any living space.</p>
            <div class="product-overview">
                <h3>Product Overview:</h3>
                <ul>
                    <li>Material: High-quality wood with a walnut finish</li>
                    <li>Fabric: Premium, durable, and easy to clean</li>
                    <li>Dimensions: 32" L x 30" W x 34" H</li>
                    <li>Weight Capacity: Up to 120 kg</li>
                    <li>Assembly: Minimal assembly required</li>
                    <li>Warranty: 1-year warranty on manufacturing defects</li>
                </ul>
            </div>
            <div class="button-container">
                <button
                                            onclick="addToCart('Double Bed', 'Rs. 9999', 'wood-img/bed1.jpg')"
                                            class="btn border border-secondary rounded-pill px-3 text-primary"
                                          >
                                            <i
                                              class="fa fa-shopping-bag me-2 text-primary"
                                            ></i>
                                            Add to cart
                                          </button>
                <button class="button buy-now">Buy Now</button>
            </div>
        </div>
    </div>

    <?php

include("inc/footer.php");

?>




