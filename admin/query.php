<?php

include("config.php");
include("function.php");


if (isset($_POST['adminUsername'])) {
    $adminUsername = $_POST['adminUsername'];
    $adminPassword = md5($_POST['adminPassword']);

    $sql = "SELECT adminPassword FROM admin WHERE adminUsername = ?";
    $result = select($sql, [$adminUsername], 's');

    if ($result && $row = mysqli_fetch_assoc($result)) {
        if ($adminPassword == $row['adminPassword']) {
            session_start();
            $_SESSION['adminUsername'] = $adminUsername;
            echo 1;
        } else {
            echo "Invalid Username or Password";
        }
    } else {
        echo "Invalid Username or Password";
    }
}


// Handle logo update request
if (isset($_FILES['logo'])) {
    $sqlSelect = "SELECT logo FROM settings WHERE id = 1;";
    $currentImage = selectSingleParams($sqlSelect);

    $image_name = rand() . rand() . time() . basename($_FILES["logo"]["name"]);

    if (move_uploaded_file($_FILES["logo"]["tmp_name"], "uploads/" . $image_name)) {
        if ($currentImage && file_exists("uploads/" . $currentImage)) {
            unlink("uploads/" . $currentImage);
        }

        $sqlUpdate = "UPDATE settings SET logo = ? WHERE id = 1;";
        $values = [$image_name];
        $param_types = 's';

        $result = updateIdAvaliable($sqlUpdate, $values, $param_types);
        echo $result ? 1 : 0;
    } else {
        echo 0;
    }
}

// Handle favicon update request
if (isset($_FILES['favicon'])) {
    $sqlSelect = "SELECT favicon FROM settings WHERE id = 1;";
    $currentImage = selectSingleParams($sqlSelect);

    $image_name = rand() . rand() . time() . basename($_FILES["favicon"]["name"]);

    if (move_uploaded_file($_FILES["favicon"]["tmp_name"], "uploads/" . $image_name)) {
        if ($currentImage && file_exists("uploads/" . $currentImage)) {
            unlink("uploads/" . $currentImage);
        }

        $sqlUpdate = "UPDATE settings SET favicon = ? WHERE id = 1;";
        $values = [$image_name];
        $param_types = 's';

        $result = updateIdAvaliable($sqlUpdate, $values, $param_types);
        echo $result ? 1 : 0;
    } else {
        echo 0;
    }
}

// Handle logo data load request
if (isset($_POST['loadLogoData'])) {
    $sql = "SELECT logo FROM settings WHERE id = 1;";
    $result = select($sql, [], '');
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row['logo']);
    } else {
        echo "Error loading logo.";
    }
}

if (isset($_POST['loadFaviconData'])) {
    $sql = "SELECT favicon FROM settings WHERE id = 1;";
    $result = select($sql, [], '');
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row['favicon']);
    } else {
        echo "Error loading logo.";
    }
}

if (isset($_POST['footer_about'])) {
    $sqlUpdate = "UPDATE settings 
                  SET footer_about = ?, 
                      footer_copyright = ?, 
                      contact_address = ?, 
                      contact_phone = ?, 
                      contact_email = ? ,
                      footer_heading = ?
                  WHERE id = 1;";
    $values = [$_POST['footer_about'], $_POST['footer_copyright'], $_POST['footer_contact_address'], $_POST['footer_contact_phone_number'], $_POST['footer_contact_email'], $_POST['footer_heading']];
    $param_types = 'ssssss';

    $result = updateIdAvaliable($sqlUpdate, $values, $param_types);
    echo $result ? 1 : 0;
}

if (isset($_POST['loadFooterData'])) {
    // echo "this is server";
    $sql = "SELECT footer_about , footer_copyright , contact_address , contact_phone ,  contact_email , footer_heading  FROM settings WHERE id = 1;";
    $result = select($sql, [], '');
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo "Error loading logo.";
    }
}


// Handle message settings update request
if (isset($_POST['forget_password_message'], $_POST['thank_you_message'])) {
    $sqlUpdate = "UPDATE settings SET forget_password_message = ?, thank_you_message = ? WHERE id = 1;";
    $values = [$_POST['forget_password_message'], $_POST['thank_you_message']];
    $param_types = 'ss';

    $result = updateIdAvaliable($sqlUpdate, $values, $param_types);
    echo $result ? 1 : 0;
}


if (isset($_FILES['settingLogo'])) {

    $sqlSelect = "SELECT setting_value FROM settings WHERE setting_key = 'logo';";
    $currentImage = selectSingleParams($sqlSelect);

    $image_name = rand() . rand() . time() . basename($_FILES["settingLogo"]["name"]);
    if (move_uploaded_file($_FILES["settingLogo"]["tmp_name"], "uploads/" . $image_name)) {

        if ($currentImage && file_exists("uploads/" . $currentImage)) {
            unlink("uploads/" . $currentImage);
        }
        $sqlUpdate = "UPDATE settings SET setting_value = ? WHERE setting_key = 'logo';";
        $values = [$image_name];
        $param_types = 's';

        $result = updateIdAvaliable($sqlUpdate, $values, $param_types);
        if ($result) {
            echo 1; // Success
        } else {
            echo 0; // Failure
        }
    }
}

if (isset($_POST['updatecontactdata'])) {

    // Sanitize the input to prevent SQL injection
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $contactaddress = mysqli_real_escape_string($conn, $_POST['contactaddress']);
    $contactemail = mysqli_real_escape_string($conn, $_POST['contactemail']);

    // SQL query to update contact details
    $sqlUpdate = "UPDATE `contactus` SET `number` = ?, `address` = ?, `email` = ? WHERE `id` = 1";

    // Prepare the statement
    if ($stmt = $conn->prepare($sqlUpdate)) {
        // Bind parameters
        $stmt->bind_param("sss", $contactNumber, $contactaddress, $contactemail);

        // Execute the query
        if ($stmt->execute()) {
            echo 1; // Success
        } else {
            echo 0; // Failure
        }

        // Close the statement
        $stmt->close();
    } else {
        echo 0; // Failure
    }
}

// ---------------------------------------------new code------------------------------------------------------


if (isset($_POST['category_name'])) {

    // echo( "data is sending ");

    $sqlInsert = "INSERT INTO category ( category , navbar , status ) VALUES (? , ? , ?)";
    $values = [$_POST['category_name'], $_POST['navbar_id'],  1];
    $result = insert($sqlInsert,  $values, 'sss');
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['loadCategoryData'])) {
    // Join category table with navbar table to fetch navbar_name
    $query = "
        SELECT c.*, n.navbar_name
        FROM category c
        LEFT JOIN navbar n ON c.navbar = n.id
    ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the status is 1 and set the checkbox as checked
            $isChecked = $row['status'] == 1 ? 'checked' : '';
            echo "
            <tr>
                <td>$sr</td>
                <td>" . htmlspecialchars($row['navbar_name']) . "</td>
                <td>" . htmlspecialchars($row['category']) . "</td>
                <td> 
                    <div class='form-check form-switch py-2'>
                        <input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' data-id='$row[id]' $isChecked>
                    </div>
                </td>
                <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-danger waves-effect waves-light categoryDeleteById' 
                        data-bs-toggle='modal' data-bs-target='#new_samedata_modal' data-bs-whatever='@mdo' data-id='$row[id]'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
            ";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>No Categories found.</td></tr>";
    }
}


if (isset($_POST['deletecategoryById'])) {

    // echo "server is working";
    $sql = "DELETE FROM `category` WHERE id = ?";
    $val = [$_POST['deletecategoryById']];
    $result =  delete($sql, $val, 'i');
    if ($result) {
        // unlink('uploads/' . $_POST['deleteCarouselImg']);
        echo 1;
    }
}

if (isset($_POST['updateCategoryStatus'])) {
    $id = $_POST['id']; // Category ID
    $status = $_POST['status']; // New status for the category

    // Update the category status
    $sqlUpdate = "UPDATE category SET status = ? WHERE id = ?";
    $values = [$status, $id];
    $result = update($sqlUpdate, $values, 'ii'); // Assuming 'update' is your helper function

    if ($result) {
        if ($status == 0) {
            // If the category is turned off, turn off all related subcategories
            $sqlUpdateSubcategories = "UPDATE subcategory SET status = 0 WHERE category_id = ?";
            $subcategoryValues = [$id];
            update($sqlUpdateSubcategories, $subcategoryValues, 'i');
        }
        echo 1; // Success response
    } else {
        echo 0; // Failure response
    }
}






if (isset($_POST['subcategory_name'])) {

    // echo( "data is sending ");

    $sqlInsert = "INSERT INTO subcategory (category_id , subcategory_name , status ) VALUES (? , ? , ?)";
    $values = [$_POST['category_id'], $_POST['subcategory_name'],  1];
    $result = insert($sqlInsert, $values, 'sss');
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['loadsubcategoryData'])) {
    // Join the subcategory table with the category table
    $query = "SELECT subcategory.*, category.category AS category_name 
              FROM subcategory 
              LEFT JOIN category ON subcategory.category_id = category.id";

    $result = mysqli_query($conn, $query); // Use your database connection variable.

    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the status is 1 and set the checkbox as checked
            $isChecked = $row['status'] == 1 ? 'checked' : '';
            echo "
            <tr>
                <td>$sr</td>
                <td>" . htmlspecialchars($row['category_name']) . "</td>
                <td>" . htmlspecialchars($row['subcategory_name']) . "</td>
                <td> 
                    <div class='form-check form-switch py-2'>
                        <input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' data-id='{$row['id']}' $isChecked>
                    </div>
                </td>
                <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-danger waves-effect waves-light subcategoryDeleteById' 
                        data-bs-toggle='modal' data-bs-target='#new_samedata_modal' data-bs-whatever='@mdo' data-id='{$row['id']}'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
            ";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>No Subcategories found.</td></tr>";
    }
}



if (isset($_POST['deletesubcategoryById'])) {

    // echo "server is working";
    $sql = "DELETE FROM `subcategory` WHERE id = ?";
    $val = [$_POST['deletesubcategoryById']];
    $result =  delete($sql, $val, 'i');
    if ($result) {
        // unlink('uploads/' . $_POST['deleteCarouselImg']);
        echo 1;
    }
}
if (isset($_POST['updatesubcategoryStatus'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sqlCategory = "SELECT status FROM category WHERE id = (SELECT category_id FROM subcategory WHERE id = ?)";
    $categoryResult = fetch($sqlCategory, [$id], 'i');

    if ($categoryResult && $categoryResult['status'] == 1) {
        $sqlUpdate = "UPDATE subcategory SET status = ? WHERE id = ?";
        $values = [$status, $id];
        $result = update($sqlUpdate, $values, 'ii');

        echo $result ? 1 : 0;
    } else {
        echo 0;
    }
}

if (isset($_POST['updateProductStatus'])) {
    $id = intval($_POST['id']); // Ensure the ID is an integer
    $status = intval($_POST['status']); // Ensure the status is an integer (0 or 1)

    // Query to fetch current status of the product
    $sqlCategory = "SELECT p_is_active FROM addproduct WHERE id = ?";
    $categoryResult = fetch($sqlCategory, [$id], 'i');

    // Check if the category exists and process the update
    if ($categoryResult) {
        $sqlUpdate = "UPDATE addproduct SET p_is_active = ? WHERE id = ?";
        $values = [$status, $id];
        $result = update($sqlUpdate, $values, 'ii');

        echo $result ? "1" : "0";
    } else {
        echo "0";
    }
}




if (isset($_POST['loadCategories'])) {

    $query = "SELECT id, category FROM category WHERE status = 1"; // Only load active categories
    $result = $conn->query($query); // Execute the query

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['category']) . "</option>";
        }
    } else {
        echo "<option value=''>No categories found</option>";
    }
}


if (isset($_POST['City_name'])) {

    // echo( "data is sending ");

    $sqlInsert = "INSERT INTO addcity (cityname , status ) VALUES (? , ?)";
    $values = [$_POST['City_name'],  1];
    $result = insert($sqlInsert, $values, 'ss');
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['loadCityData'])) {
    $result = selectalldata('addcity');
    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the status is 1 and set the checkbox as checked
            $isChecked = $row['status'] == 1 ? 'checked' : '';
            echo "
            <tr>
                <td>$sr</td>
                <td>" . htmlspecialchars($row['cityname']) . "</td>
                <td> 
                    <div class='form-check form-switch py-2'>
                        <input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' data-id='$row[id]' $isChecked>
                    </div>
                </td>
                <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-danger waves-effect waves-light CityDeleteById' 
                        data-bs-toggle='modal' data-bs-target='#new_samedata_modal' data-bs-whatever='@mdo' data-id='$row[id]'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
            ";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>No city found.</td></tr>";
    }
}


if (isset($_POST['deleteCityById'])) {

    // echo "server is working";
    $sql = "DELETE FROM `addcity` WHERE id = ?";
    $val = [$_POST['deleteCityById']];
    $result =  delete($sql, $val, 'i');
    if ($result) {
        // unlink('uploads/' . $_POST['deleteCarouselImg']);
        echo 1;
    }
}

if (isset($_POST['updateCityStatus'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sqlUpdate = "UPDATE addcity SET status = ? WHERE id = ?";
    $values = [$status, $id];
    $result = update($sqlUpdate, $values, 'ii'); // Assuming 'update' is your helper function

    echo $result ? 1 : 0;
}

if (isset($_POST['updateOurProductStatus'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sqlUpdate = "UPDATE active_product SET status = ? WHERE id = ?";
    $values = [$status, $id];
    $result = update($sqlUpdate, $values, 'ii'); // Assuming 'update' is your helper function

    echo $result ? 1 : 0;
}

if (isset($_POST['deleteOur_productById'])) {

    // echo "server is working";
    $sql = "DELETE FROM `active_product` WHERE id = ?";
    $val = [$_POST['deleteOur_productById']];
    $result =  delete($sql, $val, 'i');
    if ($result) {
        // unlink('uploads/' . $_POST['deleteCarouselImg']);
        echo 1;
    }
}



if (isset($_POST['shippingcost'])) {

    // echo( "data is sending ");

    $sqlInsert = "INSERT INTO shippingcost ( city_id , amount  ) VALUES (? , ? )";
    $values = [$_POST['city_id'], $_POST['shippingcost']];
    $result = insert($sqlInsert, $values, 'ss');
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}


if (isset($_POST['loadCity'])) {

    $query = "SELECT id, cityname FROM addcity WHERE status = 1"; // Only load active categories
    $result = $conn->query($query); // Execute the query

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['cityname']) . "</option>";
        }
    } else {
        echo "<option value=''>No City found</option>";
    }
}
if (isset($_POST['loadshippingcostData'])) {

    $sql = "SELECT sc.id AS shipping_id, sc.amount, ac.cityname 
            FROM shippingcost sc 
            INNER JOIN addcity ac ON sc.city_id = ac.id 
            WHERE ac.status = 1";

    $result = $conn->query($sql); // Assuming $conn is your MySQLi connection

    if ($result && mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>$sr</td>
                <td>" . htmlspecialchars($row['cityname']) . "</td>
                <td>" . htmlspecialchars($row['amount']) . "</td>
                <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-danger waves-effect waves-light shippingcostDeleteById' 
                        data-bs-toggle='modal' data-bs-target='#new_samedata_modal' data-bs-whatever='@mdo' data-id='" . htmlspecialchars($row['shipping_id']) . "'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
            ";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='4' class='text-center' >No Shipping Cost available</td></tr>"; // Message for no data
    }
}



if (isset($_POST['deleteshippingcostById'])) {

    // echo "server is working";
    $sql = "DELETE FROM `shippingcost` WHERE id = ?";
    $val = [$_POST['deleteshippingcostById']];
    $result =  delete($sql, $val, 'i');
    if ($result) {
        // unlink('uploads/' . $_POST['deleteCarouselImg']);
        echo 1;
    }
}
if (isset($_FILES['p_image'])) {
    $image_name = rand() . rand() . basename($_FILES["p_image"]["name"]);
    $subcategory_id = $_POST['subcategory_id'];
    $product_name = $_POST['product_name'];
    $old_price = $_POST['p_old_price'];
    $new_price = $_POST['p_new_price'];
    $description = $_POST['p_description'];
    $quantity = $_POST['p_qty'];
    $overview = $_POST['p_overview'];
    $offer = $_POST['p_offer'];
    $is_active = 1;

    // Handle primary product image upload
    $upload_dir = "uploads/";
    $primary_image_path = $upload_dir . $image_name;
    move_uploaded_file($_FILES["p_image"]["tmp_name"], $primary_image_path);

    // Handle other product images
    $other_images = [];
    if (isset($_FILES['product_other_images'])) {
        foreach ($_FILES['product_other_images']['tmp_name'] as $key => $tmp_name) {
            if (!empty($tmp_name)) {
                $other_image_name = rand() . rand() . basename($_FILES['product_other_images']['name'][$key]);
                $other_image_path = $upload_dir . $other_image_name;
                if (move_uploaded_file($tmp_name, $other_image_path)) {
                    $other_images[] = $other_image_name;
                }
            }
        }
    }

    // Convert $other_images array to a comma-separated string
    $other_images_string = implode(',', $other_images);

    // Insert into database
    $sqlInsert = "INSERT INTO addproduct (
                    subcategory_id, 
                    product_name, 
                    p_old_price, 
                    P_new_price, 
                    p_description, 
                    p_is_active, 
                    p_qty, 
                    p_image, 
                    p_other_image, 
                    p_overview, 
                    p_offer
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $values = [
        $subcategory_id,
        $product_name,
        $old_price,
        $new_price,
        $description,
        $is_active,
        $quantity,
        $image_name,
        $other_images_string, // Comma-separated string
        $overview,
        $offer
    ];

    $result = insert($sqlInsert, $values, 'sssssiissss'); // Bind types

    if ($result) {
        echo  1;
    } else {
        echo  0;
    }
}

if (isset($_POST['loadProductData'])) {
    $query = "SELECT p.*, s.subcategory_name 
              FROM addproduct p 
              LEFT JOIN subcategory s ON p.subcategory_id = s.id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Process the primary image
            $primaryImagePath = !empty($row['p_image']) ? htmlspecialchars($row['p_image'], ENT_QUOTES, 'UTF-8') : '';

            // Process other images (comma-separated format assumed)
            $otherImagesHtml = '';
            if (!empty($row['p_other_image'])) {
                $otherImages = explode(',', $row['p_other_image']); // Convert comma-separated string to array
                foreach ($otherImages as $image) {
                    $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
                    $otherImagesHtml .= "<img src='uploads/$image' alt='Image not found' height='100' width='100' class='me-2 mb-2'><br>";
                }
            }

            // Generate rows
            echo "
            <tr>
                <td>{$sr}</td>
                <td>{$row['subcategory_name']}</td>
                <td>{$row['product_name']}</td>
                <td>₹{$row['p_old_price']}</td>
                <td>₹{$row['P_new_price']}</td>
                <td>{$row['p_description']}</td>
                <td>{$row['p_overview']}</td>
                <td>{$row['p_offer']}</td>
                <td>{$row['p_qty']}</td>
                <td>
                    <div class='form-check form-switch py-2'>
                        <input class='form-check-input toggle-status' type='checkbox' data-id='{$row['id']}' " . ($row['p_is_active'] == 1 ? 'checked' : '') . ">
                    </div>
                </td>
                <td>
                    <img src='uploads/{$primaryImagePath}' alt='No primary image' height='100' width='100'>
                </td>
                <td>
                    $otherImagesHtml
                </td>
                <td>
                    <div class='btn-group'>
                        <button type='button' class='btn btn-success dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Action
                        </button>
                        <ul class='dropdown-menu animated flipInX'>
                            <li><a class='dropdown-item loadEditForm' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#product-modal-edit' href='javascript:void(0)'>Edit</a></li>
                            <li><a class='dropdown-item deleteProduct' data-id='{$row['id']}' data-deleteimg='{$row['p_image']}' href='javascript:void(0)'>Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            ";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='13' class='text-center'>No products found.</td></tr>";
    }
}





if (isset($_POST['loadSubcategories'])) {

    $query = "SELECT id, subcategory_name FROM subcategory WHERE status = 1"; // Only load active categories
    $result = $conn->query($query); // Execute the query

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['subcategory_name']) . "</option>";
        }
    } else {
        echo "<option value=''>No Sub-categories found</option>";
    }
}

// Delete Product
if (isset($_POST['deleteProductById'])) {
    $sql = "DELETE FROM `addproduct` WHERE id = ?";
    $val = [$_POST['deleteProductById']];
    $result = delete($sql, $val, 'i');

    if ($result) {
        unlink('uploads/' . $_POST['deleteProductByImg']);
        echo 1;
    } else {
        echo 0;
    }
}


if (isset($_POST['loadProductEditForm'])) {
    // echo "sever is hit but data not foud";
    $sql = "SELECT * FROM `addproduct` WHERE id = ?";
    $val = [$_POST['loadProductEditForm']];
    $result =  select($sql, $val, 'i');
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $row = json_encode($row);
        echo $row;
    }
}


if (isset($_POST['new_product_name'])) {

    // Get the product ID from the hidden field
    // var_dump($_FILES);
    $id = $_POST['productDataId'];

    // Query to get the current product images
    $sqlSelect = "SELECT p_image, p_other_image FROM addproduct WHERE id = ?";
    $currentProduct = selectSingleRow($sqlSelect, [$id], 's');

    // var_dump($currentProduct);
    $currentImage = $currentProduct['p_image'];
    $currentOtherImages = explode(',', $currentProduct['p_other_image']);

    // Handle the new main product image
    if (isset($_FILES['new_p_image']) && $_FILES['new_p_image']['error'] == UPLOAD_ERR_OK) {
        // Generate a random name for the new image
        $image_name = rand() . rand() . basename($_FILES["new_p_image"]["name"]);

        // Move the uploaded image to the "uploads" folder
        if (move_uploaded_file($_FILES["new_p_image"]["tmp_name"], "uploads/" . $image_name)) {

            // Delete the old image file if it exists
            if (!empty($currentImage) && file_exists("uploads/" . $currentImage)) {
                unlink("uploads/" . $currentImage);
            }
        }
    } else {
        // No new main image uploaded, keep the current one
        $image_name = $currentImage;
    }

    // Handle additional images
    $other_images = [];
    if (isset($_FILES['new_product_other_images'])) {
        foreach ($_FILES['new_product_other_images']['tmp_name'] as $key => $tmp_name) {
            if (!empty($tmp_name)) {
                $other_image_name = rand() . rand() . basename($_FILES['new_product_other_images']['name'][$key]);
                $other_image_path = "uploads/" . $other_image_name;
                if (move_uploaded_file($tmp_name, $other_image_path)) {
                    $other_images[] = $other_image_name;
                }
            }
        }
    }

    // Merge new and existing additional images
    $all_other_images = array_merge($currentOtherImages, $other_images);
    $other_images_string = implode(',', $all_other_images);

    // var_dump($image_name);
    // var_dump($other_images_string);




    // Update the database with the new product details
    $sqlUpdate = "UPDATE `addproduct` 
                  SET 
                    `subcategory_id` = ?, 
                    `product_name` = ?, 
                    `p_old_price` = ?, 
                    `P_new_price` = ?, 
                    `p_description` = ?, 
                    `p_qty` = ?, 
                    `p_image` = ?, 
                    `p_other_image` = ?, 
                    `p_overview` = ?, 
                    `p_offer` = ? 
                  WHERE `id` = ?";
    $values = [
        $_POST['new_subcategory_id'],
        $_POST['new_product_name'],
        $_POST['new_p_old_price'],
        $_POST['new_p_new_price'],
        $_POST['new_p_description'],
        $_POST['new_p_qty'],
        $image_name,
        $other_images_string,
        $_POST['new_p_overview'],
        $_POST['new_p_offer'],
        $id
    ];
    $param_types = 'ssssssssssi'; // Correct number of placeholders for all fields

    // Execute the update query
    $result = update($sqlUpdate, $values, $param_types);

    // Return the result of the update
    if ($result) {
        echo 1; // Success
    } else {
        echo 0; // Failure
    }
}




if (isset($_POST['navbar_name'])) {

    $sqlInsert = "INSERT INTO navbar (   navbar_name  ) VALUES ( ?)";
    $values = [$_POST['navbar_name']];
    $result = insert($sqlInsert, $values, 's');
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['loadnavbarData'])) {
    $result = selectalldata('navbar');
    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>$sr</td>
                <td>{$row['navbar_name']}</td>
                <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-danger waves-effect waves-light navbarDeleteById' 
                        data-bs-toggle='modal' data-bs-target='#new_samedata_modal' data-bs-whatever='@mdo' data-id='$row[id]'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
            ";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>No Navbar found.</td></tr>";
    }
}



if (isset($_POST['deletenavbarById'])) {

    // echo "server is working";
    $sql = "DELETE FROM `navbar` WHERE id = ?";
    $val = [$_POST['deletenavbarById']];
    $result =  delete($sql, $val, 'i');
    if ($result) {
        // unlink('uploads/' . $_POST['deleteCarouselImg']);
        echo 1;
    }
}

if (isset($_POST['loadNavbar'])) {

    $query = "SELECT id, navbar_name FROM navbar "; // Only load active categories
    $result = $conn->query($query); // Execute the query

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['navbar_name']) . "</option>";
        }
    } else {
        echo "<option value=''>No Sub-categories found</option>";
    }
}

if (isset($_POST['loadCustomerData'])) {
    $result = selectalldata('customer');
    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the status is 1 (active) or 0 (inactive)
            $isChecked = $row['cust_status'] == 1 ? 'checked' : '';
            $rowClass = $row['cust_status'] == 0 ? 'table-danger' : ''; // Add red background for inactive users
            echo "
            <tr class='$rowClass'>
                <td>$sr</td>
                <td>" . htmlspecialchars($row['cust_name']) . "</td>
                <td>" . htmlspecialchars($row['cust_email']) . "</td>
                <td>" . htmlspecialchars($row['cust_phone']) . "</td>
                <td>" . htmlspecialchars($row['cust_city']) . "</td>
                <td>" . htmlspecialchars($row['cust_state']) . "</td>
                <td>" . htmlspecialchars($row['cust_zip']) . "</td>
                <td> 
                    <div class='form-check form-switch py-2'>
                        <input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' data-id='$row[id]' $isChecked>
                    </div>
                </td>
            </tr>
            ";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>No customer found.</td></tr>";
    }
}


if (isset($_POST['updateCustomerStatus'])) {
    $id = $_POST['id']; // Category ID
    $status = $_POST['status']; // New status for the category

    // Update the category status
    $sqlUpdate = "UPDATE customer SET cust_status = ? WHERE id = ?";
    $values = [$status, $id];
    $result = update($sqlUpdate, $values, 'ii'); // Assuming 'update' is your helper function

    if ($result) {
        if ($status == 0) {
            // If the category is turned off, turn off all related subcategories
            $updateCustomerStatus = "UPDATE customer SET cust_status = 0 WHERE id = ?";
            $customerValues = [$id];
            update($updateCustomerStatus, $customerValues, 'i');
        }
        echo 1; // Success response
    } else {
        echo 0; // Failure response
    }
}
if (isset($_POST['about_title'])) {
    $id = 1;

    // Fetch the current images from the database
    $sqlSelect = "SELECT about_image FROM about_section WHERE id = ?";
    $currentImage = selectSingleValue($sqlSelect, [$id], 'i');

    $uploadedImages = []; // Array to store uploaded image names

    if (isset($_FILES['about_images'])) {
        $fileNames = $_FILES['about_images']['name'];
        $fileTmpNames = $_FILES['about_images']['tmp_name'];

        foreach ($fileNames as $key => $fileName) {
            if ($_FILES['about_images']['error'][$key] == UPLOAD_ERR_OK) {
                // Generate a random filename for each image
                $newFileName = rand() . rand() . basename($fileName);

                // Move the uploaded file to the 'uploads' directory
                if (move_uploaded_file($fileTmpNames[$key], "uploads/" . $newFileName)) {
                    $uploadedImages[] = $newFileName;
                }
            }
        }
    }

    // Combine old and new images
    $allImages = [];
    if (!empty($currentImage)) {
        $allImages = explode(',', $currentImage); // Existing images
    }
    if (!empty($uploadedImages)) {
        $allImages = array_merge($allImages, $uploadedImages); // Add new images
    }
    $imageNamesString = implode(',', $allImages); // Combine into a single string

    // Update the database
    $sqlUpdate = "UPDATE about_section 
                  SET about_title = ?, 
                      about_content = ?, 
                      about_image = ?, 
                      updated_at = NOW() 
                  WHERE id = ?";
    $values = [
        $_POST['about_title'],
        $_POST['about_content'],
        $imageNamesString,
        $id
    ];
    $param_types = 'sssi';

    // Execute the database update query
    $result = update($sqlUpdate, $values, $param_types);

    // Return the result
    if ($result) {
        echo 1; // Success
    } else {
        echo 0; // Failure
    }
}




if (isset($_POST['loadAboutData'])) {
    $query = "SELECT about_title, about_content, about_image FROM about_section WHERE id = 1"; // Change as needed
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    echo json_encode($row);
}

if (isset($_POST['deleteImage']) && isset($_POST['imageName'])) {
    $imageName = $_POST['imageName'];
    $imagePath = "uploads/" . $imageName;

    // Check if the file exists and delete it
    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            // Update database to remove only the specified image from the field
            $query = "SELECT about_image FROM about_section WHERE FIND_IN_SET(?, about_image)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $imageName);
            $stmt->execute();
            $stmt->bind_result($existingImages);
            $stmt->fetch();
            $stmt->close();

            // Remove the deleted image from the list and update the database
            if ($existingImages) {
                $updatedImages = implode(',', array_diff(explode(',', $existingImages), [$imageName]));
                $updateStmt = $conn->prepare("UPDATE about_section SET about_image = ? WHERE FIND_IN_SET(?, about_image)");
                $updateStmt->bind_param("ss", $updatedImages, $imageName);
                $updateStmt->execute();
                $updateStmt->close();
            }

            echo 1; // Success
        } else {
            echo 0; // Failed to delete file
        }
    } else {
        echo 0; // File not found
    }
    exit;
}


if (isset($_POST['new_deleteImage']) && isset($_POST['new_imageName'])) {
    $imageName = $_POST['new_imageName'];
    $imagePath = "uploads/" . $imageName;

    // Check if the file exists and delete it
    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            // Update database to remove only the specified image from the field
            $query = "SELECT p_other_image FROM addproduct WHERE FIND_IN_SET(?, p_other_image)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $imageName);
            $stmt->execute();
            $stmt->bind_result($existingImages);
            $stmt->fetch();
            $stmt->close();

            // Remove the deleted image from the list and update the database
            if ($existingImages) {
                $updatedImages = implode(',', array_diff(explode(',', $existingImages), [$imageName]));
                $updateStmt = $conn->prepare("UPDATE addproduct SET p_other_image = ? WHERE FIND_IN_SET(?, p_other_image)");
                $updateStmt->bind_param("ss", $updatedImages, $imageName);
                $updateStmt->execute();
                $updateStmt->close();
            }

            echo 1; // Success
        } else {
            echo 0; // Failed to delete file
        }
    } else {
        echo 0; // File not found
    }
    exit;
}


if (isset($_POST['contact_name'])) {

    // echo( "data is sending ");

    $sqlInsert = "INSERT INTO contactus_web ( name , email , message   ) VALUES (? , ? , ? )";
    $values = [$_POST['contact_name'], $_POST['contact_email'], $_POST['contact_message']];
    $result = insert($sqlInsert, $values, 'sss');
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['loadContactAllData'])) {
    $result = selectalldata('contactus_web');
    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>$sr</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[message]</td>
                <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-danger waves-effect waves-light ContacDeleteById' 
                        data-bs-toggle='modal' data-bs-target='#new_samedata_modal' data-bs-whatever='@mdo' data-id='$row[id]'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
           ";
            $sr++;
        }
    }
}


if (isset($_POST['ContacDeleteById'])) {

    $sql = "DELETE FROM `contactus_web` WHERE id = ?";
    $val = [$_POST['ContacDeleteById']];
    $result =  delete($sql, $val, 'i');

    if ($result) {
        echo 1;
    }
}

// INSERT operation
if (isset($_FILES['home_image'])) {
    $image_name = rand() . rand() . basename($_FILES["home_image"]["name"]);
    $title = $_POST['home_title'];
    $subcategory_id = $_POST['subcategory_id'];

    if (move_uploaded_file($_FILES["home_image"]["tmp_name"], "uploads/" . $image_name)) {
        $sqlInsert = "INSERT INTO media (Image, Title , subcategory) VALUES (?, ? , ?)";
        $values = [$image_name, $title , $subcategory_id];
        $result = insert($sqlInsert, $values, 'sss');
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}


if (isset($_POST['loadHomeData'])) {
    $result = mysqli_query($conn, "
        SELECT media.*, subcategory.subcategory_name 
        FROM media 
        LEFT JOIN subcategory ON media.subcategory = subcategory.id
    ");
    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $imagePath = "uploads/" . $row['Image']; // Correct path for the image
            echo "
            <tr>
                <td>$sr</td>
                <td>{$row['subcategory_name']}</td> <!-- Display subcategory name -->
                <td><img src='$imagePath' alt='Image' style='width: 100px; height: auto;'></td>
                <td>{$row['Title']}</td>
                <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-primary waves-effect waves-light HomeBlogEditById' 
                        data-bs-toggle='modal' data-bs-target='#product-modal-edit' data-bs-whatever='@mdo' data-id='{$row['id']}'>
                        <i class='fas fa-edit'></i>
                    </button>
                </td>
                <td>
                    <button 
                        type='button' 
                        class='btn mb-1 d-block btn-outline-danger waves-effect waves-light HomeDeleteById' 
                        data-bs-toggle='modal' 
                        data-bs-target='#new_samedata_modal' 
                        data-bs-whatever='@mdo' 
                        data-id='{$row['id']}' 
                       data-deleteimg='{$row['Image']}'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
           ";
            $sr++;
        }
    }
}

// DELETE operation
if (isset($_POST['deleteHomeImageById'])) {

    // var_export($_POST);
    $sql = "DELETE FROM `bestoffer` WHERE id = ?";
    $val = [$_POST['deleteHomeImageById']];
    $result =  delete($sql, $val, 'i');
    if ($result) {
        unlink('uploads/' . $_POST['imageItem']);
        echo 1;
    }
}

if (isset($_POST['loadBlogOfferEditForm'])) {
    $sql = "SELECT * FROM `media` WHERE id = ?";
    $val = [$_POST['loadBlogOfferEditForm']];
    $result =  select($sql, $val, 'i');
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $row = json_encode($row);
        echo $row;
    }
}
if (isset($_POST['newBestOfferTitle'])) {

    // var_dump($_POST);

    $id = $_POST['blogOfferEditFormId'];

    // Select the current image from the database
    $sqlSelect = "SELECT Image FROM media WHERE id = ?";
    $currentImage = selectSingleValue($sqlSelect, [$id], 's');

    if (!empty($_FILES['newHomeImage']['name'])) { // Check if a file is uploaded
        // Generate a unique file name for the new image
        $image_name = rand() . rand() . basename($_FILES["newHomeImage"]["name"]);

        if (move_uploaded_file($_FILES["newHomeImage"]["tmp_name"], "uploads/" . $image_name)) {

            // Delete the old image file if it exists
            if (!empty($currentImage) && file_exists("uploads/" . $currentImage)) {
                unlink("uploads/" . $currentImage);
            }

            // Define SQL and parameters for updating with a new image
            $sqlUpdate = "UPDATE media SET Image = ?, Title = ? , subcategory = ? WHERE id = ?";
            $values = [$image_name, $_POST['newBestOfferTitle'], $_POST['new_subcategory_id'] , $id];
            $param_types = 'ssss'; // Parameters for Image, Title, and ID
        } else {
            echo "Failed to upload the image.";
            exit;
        }
    } else {
        // Define SQL and parameters for updating only the title
        $sqlUpdate = "UPDATE media SET Title = ? , subcategory = ? WHERE id = ?";
        $values = [$_POST['newBestOfferTitle'],  $_POST['new_subcategory_id'] ,  $id];
        $param_types = 'sss'; // Parameters for Title and ID
    }

    // Execute the update query
    $result = update($sqlUpdate, $values, $param_types);
    echo $result ? 1 : 0;
}


if (isset($_FILES['home_bestoffer_image'])) {

    $image_name = rand() . rand() . basename($_FILES["home_bestoffer_image"]["name"]);
    $title = $_POST['home_bestoffer_offer'];

    if (move_uploaded_file($_FILES["home_bestoffer_image"]["tmp_name"], "uploads/" . $image_name)) {
        $sqlInsert = "INSERT INTO bestoffer (image, offer) VALUES (?, ?)";
        $values = [$image_name, $title];
        $result = insert($sqlInsert, $values, 'ss');
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}


if (isset($_POST['loadBestOfferData'])) {
    $result = selectalldata('bestoffer');
    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>$sr</td>
                <td><img src='uploads/$row[image]' alt='Image' style='width: 100px; height: auto;'></td>
                <td>$row[offer]</td>
                 <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-primary waves-effect waves-light HomeBestOfferEditById' 
                        data-bs-toggle='modal' data-bs-target='#offer-modal-edit' data-bs-whatever='@mdo' data-id='{$row['id']}'>
                        <i class='fas fa-edit'></i>
                    </button>
                </td>
                <td>
                    <button 
                        type='button' 
                        class='btn mb-1 d-block btn-outline-danger waves-effect waves-light HomeOfferDeleteById' 
                        data-bs-toggle='modal' 
                        data-bs-target='#new_samedata_modal' 
                        data-bs-whatever='@mdo' 
                        data-id='{$row['id']}' 
                       data-deleteimg='$row[image]'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
           ";
            $sr++;
        }
    }
}

if (isset($_POST['deleteHomeOfferImageById'])) {
    $sql = "DELETE FROM `bestoffer` WHERE id = ?";
    $val = [$_POST['deleteHomeOfferImageById']];
    $result =  delete($sql, $val, 'i');
    if ($result) {
        unlink('uploads/' . $_POST['imageOfferItem']);
        echo 1;
    }
}



if (isset($_POST['loadBestOfferEditForm'])) {
    // echo "sever is hit but data not foud";
    $sql = "SELECT * FROM `bestoffer` WHERE id = ?";
    $val = [$_POST['loadBestOfferEditForm']];
    $result =  select($sql, $val, 'i');
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $row = json_encode($row);
        echo $row;
    }
}


if (isset($_POST['new_home_bestoffer_offer'])) {
    // Get data from POST
    $id = $_POST['bestOfferEditFormId'];

    // Select the current image from the database
    $sqlSelect = "SELECT image FROM bestoffer WHERE id = ?";
    $currentImage = selectSingleValue($sqlSelect, [$id], 'i'); // 'i' for integer ID

    // Check if a new file is uploaded
    if (!empty($_FILES['new_home_bestoffer_image']['name'])) {
        // Generate a unique file name
        $imageName = uniqid() . "_" . basename($_FILES["new_home_bestoffer_image"]["name"]);

        // Upload new image
        if (move_uploaded_file($_FILES["new_home_bestoffer_image"]["tmp_name"], "uploads/" . $imageName)) {
            // Delete the old image file if it exists
            if (!empty($currentImage) && file_exists("uploads/" . $currentImage)) {
                unlink("uploads/" . $currentImage);
            }

            // Prepare SQL to update both image and offer
            $sqlUpdate = "UPDATE bestoffer SET image = ?, offer = ? WHERE id = ?";
            $values = [$imageName, $_POST['new_home_bestoffer_offer'], $id];
            $paramTypes = 'ssi'; // string, string, integer
        } else {
            echo "Failed to upload the image.";
            exit;
        }
    } else {
        // Prepare SQL to update only the offer
        $sqlUpdate = "UPDATE bestoffer SET offer = ? WHERE id = ?";
        $values = [$_POST['new_home_bestoffer_offer'], $id];
        $paramTypes = 'si'; // string, integer
    }

    // Execute the update query
    $result = update($sqlUpdate, $values, $paramTypes);
    echo $result ? 1 : 0; // Output 1 for success, 0 for failure
}

// Add Testimonial
if (isset($_FILES['client_image'])) {
    $image_name = rand() . rand() . basename($_FILES["client_image"]["name"]);
    $client_name = $_POST['client_name'];
    $client_title = $_POST['client_title'];

    if (move_uploaded_file($_FILES["client_image"]["tmp_name"], "uploads/" . $image_name)) {
        $sqlInsert = "INSERT INTO testimonials (client_image, client_name, client_title) VALUES (?, ?, ?)";
        $values = [$image_name, $client_name, $client_title];
        $result = insert($sqlInsert, $values, 'sss');
        echo $result ? 1 : 0;
    }
}

// Load Testimonials
if (isset($_POST['loadTestimonialData'])) {
    $result = selectalldata('testimonials');
    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>{$sr}</td>
                <td><img src='uploads/{$row['client_image']}' alt='Image' style='width: 100px; height: auto;'></td>
                <td>{$row['client_name']}</td>
                <td>{$row['client_title']}</td>
                <td>
                    <button class='btn btn-outline-danger DeleteTestimonial' data-id='{$row['id']}'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>";
            $sr++;
        }
    }
}

// Delete Testimonial
if (isset($_POST['deleteTestimonialById'])) {
    $id = $_POST['deleteTestimonialById'];
    $sqlSelect = "SELECT client_image FROM testimonials WHERE id = ?";
    $imageName = selectSingleValue($sqlSelect, [$id], 'i');
    
    $sqlDelete = "DELETE FROM testimonials WHERE id = ?";
    $result = delete($sqlDelete, [$id], 'i');
    if ($result) {
        unlink('uploads/' . $imageName);
        echo 1;
    } else {
        echo 0;
    }
}

// Load Testimonial Edit Form
if (isset($_POST['loadTestimonialEditForm'])) {
    $id = $_POST['loadTestimonialEditForm'];
    $sql = "SELECT * FROM testimonials WHERE id = ?";
    $result = select($sql, [$id], 'i');
    echo $result ? json_encode(mysqli_fetch_assoc($result)) : 0;
}

// Update Testimonial
if (isset($_POST['new_client_name'])) {

    // var_dump($_POST);
    $id = $_POST['TestimonialData'];
    $client_name = $_POST['new_client_name'];
    $client_title = $_POST['new_client_title'];

    $sqlSelect = "SELECT client_image FROM testimonials WHERE id = ?";
    $currentImage = selectSingleValue($sqlSelect, [$id], 'i');

    if (!empty($_FILES['new_client_image']['name'])) {
        $new_image_name = rand() . rand() . basename($_FILES["new_client_image"]["name"]);
        if (move_uploaded_file($_FILES["new_client_image"]["tmp_name"], "uploads/" . $new_image_name)) {
            unlink("uploads/" . $currentImage);
            $currentImage = $new_image_name;
        }
    }

    $sqlUpdate = "UPDATE testimonials SET client_image = ?, client_name = ?, client_title = ? WHERE id = ?";
    $values = [$currentImage, $client_name, $client_title, $id];
    $result = update($sqlUpdate, $values, 'sssi');
    echo $result ? 1 : 0;
}

 
if (isset($_POST['twitter_link'])) {
    $twitter_link = $_POST['twitter_link'];
    $facebook_link = $_POST['facebook_link'];
    $youtube_link = $_POST['youtube_link'];
    $linkedin_link = $_POST['linkedin_link'];

    // Update the existing row
    $sql = "UPDATE social_links 
            SET twitter_link = ?, facebook_link = ?, youtube_link = ?, linkedin_link = ? 
            WHERE id = 1"; // Assuming we only have one row

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $twitter_link, $facebook_link, $youtube_link, $linkedin_link);

    if ($stmt->execute()) {
        echo  1;
    } else {
        echo  0;
    }
}


if (isset($_POST['our_product_id'])) {

    // echo( "data is sending ");

    $sqlInsert = "INSERT INTO active_product (subcategory_id , status ) VALUES (? , ?)";
    $values = [$_POST['our_product_id'],  1];
    $result = insert($sqlInsert, $values, 'ss');
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}
if (isset($_POST['loadOurPorductData'])) {
    // Fetch data with JOIN to get subcategory_name
    $query = "SELECT ap.id, ap.status, ap.subcategory_id, s.subcategory_name 
              FROM active_product ap
              JOIN subcategory s ON ap.subcategory_id = s.id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $sr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the status is 1 and set the checkbox as checked
            $isChecked = $row['status'] == 1 ? 'checked' : '';
            echo "
            <tr>
                <td>$sr</td>
                <td>" . htmlspecialchars($row['subcategory_name']) . "</td>
                <td> 
                    <div class='form-check form-switch py-2'>
                        <input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' data-id='$row[id]' $isChecked>
                    </div>
                </td>
                <td>
                    <button type='button' class='btn mb-1 d-block btn-outline-danger waves-effect waves-light Our_productDeleteById' 
                        data-bs-toggle='modal' data-bs-target='#new_samedata_modal' data-bs-whatever='@mdo' data-id='$row[id]'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>
            ";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>No product found.</td></tr>";
    }
}

if (isset($_POST['subcategory_id'])) {
    $subcategoryId = $_POST['subcategory_id'];

    // Query to fetch products
    if ($subcategoryId === "all") {
        $query = "SELECT * FROM addproduct WHERE p_is_active = 1";
    } else {
        $query = "SELECT * FROM addproduct WHERE p_is_active = 1 AND subcategory_id = '$subcategoryId'";
    }

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($product = $result->fetch_assoc()) {
            echo '<div class="col-md-6 col-lg-4 col-xl-3">';
            echo '<a href="product-details.php?id=' . $product['id'] . '">';
            echo '<div class="service-item bg-primary rounded border border-primary">';
            echo '<img style="height: 350px;" src="admin/uploads/' . $product['p_image'] . '" class="img-fluid rounded-top w-100 hover1" alt="">';
            echo '<div class="px-4 rounded-bottom">';
            echo '<div class="service-content bg-secondary text-center rounded">';
            echo '<h5 class="text-white"> </h5>';
            echo '<h3 class="mb-0">Save Up To 30% off</h3>';
            echo '</div>';
            echo '<h6>' . $product['product_name'] . ' - ' . $product['p_qty'] . '<br>';
            echo '<b>' . $product['P_new_price'] . '</b> <Del>' . $product['p_old_price'] . '</Del></h6>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo '<p>No products found.</p>';
    }
} 
