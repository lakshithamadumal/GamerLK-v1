<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    

    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;


?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cart | gamerLk</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="cartstyle.css">
        <link rel="icon" href="resourses/logo.png">

    </head>

    <body style="background-color: #252526;">

        <div class="container-fluid">
            <div class="row btnn overflow-x-hidden">

                <?php
                include "header_c.php";
                include "c_banner.php";

                ?>



                <div class="col-12 border border-1 border-fuck rounded mb-4">
                    <div class="row">

                        <div class="col-12 d-lg-none text-center">
                            <label class="form-label fs-1 fw-bold text-light">Cart <i class="bi bi-cart4 fs-1 text-success"></i></label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <hr />
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" style="background-color: #1e1e1e;" class="form-control fw-bold text-light border-0" value="Search in Cart..." />
                                </div>
                                <div class="col-12 col-lg-2 mb-3 d-grid">
                                    <button class="btn fw-bold  text-light" style="background-color:#ff4d05 ;">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <?php
                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {
                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold text-light">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-8 offset-2 col-lg-4 d-grid mb-3">
                                        <button class="btn_p fs-3 fw-bold" onclick="window.location='home.php'">Start Shopping <i class="fa-solid fa-cart-shopping fa-lg"></i></button>

                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    </div>
                                </div>

                            </div>


                    </div>
                </div>
                <!-- Empty View -->
            <?php
                        } else {
            ?>
                <!-- products -->

                <div class="col-12 col-lg-8">
                    <div class="row">

                        <?php
                            for ($x = 0; $x < $cart_num; $x++) {
                                $cart_data = $cart_rs->fetch_assoc();

                                $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                                    `id`='" . $cart_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();
                                $subtotal += $product_data["price"];

                                $images_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $cart_data["product_id"] . "'");
                                $images_data = $images_rs->fetch_assoc();

                                // Fetch the download count
                                $download_rs = Database::search("SELECT COUNT(*) AS download_count FROM `invoice` WHERE product_id='" . $cart_data["product_id"] . "'");
                                $download_data = $download_rs->fetch_assoc();
                                $download_count = $download_data['download_count'];


                        ?>
                            <div class="card mb-3 mx-0 col-12" style="background-color: #1e1e1e;">
                                <div class="row g-0">
                                    <div class="col-md-12 mt-3 mb-3">
                                        <div class="row">

                                        </div>
                                    </div>


                                    <!-- popup -->
                                    <div class="col-md-4 offset-1">
                                        <img src="<?php echo $images_data["img_path"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                    </div>
                                    <!-- popup -->
                                    <div class="col-md-4">
                                        <div class="card-body">

                                            <h3 class="card-title fw-bold text-light"><?php echo $product_data["title"]; ?></h3>

                                            <br />

                                            <span class="fw-bold  fs-5 fw-bold text-light">Price :</span>&nbsp;
                                            <span class="fs-6  text-light">Rs. <?php echo $product_data["price"]; ?></span>
                                            <br />
                                            <span class="fs-5 fw-bold text-light">Rating :</span>&nbsp;&nbsp;
                                            <span class="star">
                                                <i class="fas fa-star text-warning fs-6"></i>
                                                <i class="fas fa-star text-warning fs-6"></i>
                                                <i class="fas fa-star text-warning fs-6"></i>
                                                <i class="fas fa-star text-warning fs-6"></i>
                                                <i class="bi bi-star text-warning fs-6"></i>

                                            </span>
                                            
                                            <span class="fw-bold  fs-5 fw-bold text-light">Downloads :</span>&nbsp;
                                            <span class="fs-6  text-light"> <?php echo $download_count; ?>
                                            </span>
                                            <br />


                                            <span class="fw-bold  fs-5 fw-bold text-light">Description :</span>&nbsp;
                                            <br />
                                            <h5 style="font-size: 12px; color: #e0e0e3;" class="mt-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php echo $product_data["description"]; ?></h5>
                                            <br />

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body d-grid">
                                            <a href="#" class="btn btn-outline-success mb-2 fw-bold" onclick="paynow(<?php echo $product_data['id'] ?>);">Buy Now&nbsp; <i class="fa-solid fa-money-check-dollar"></i></a>
                                            <a class="btn btn-outline-danger mb-2 fw-bold mt-2" onclick="removeFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove&nbsp;<i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        <?php
                            }
                        ?>



                    </div>
                </div>

                <!-- products -->

                <!-- summary -->
                <div class="col-12 col-lg-3">
                    <div class="row">
                        <div class="master-container">
                            <div class="card cart1" style="background-color: #1e1e1e;">
                                <div class="products">
                                    <?php
                                    $cart_rs->data_seek(0); // reset result pointer
                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                                        `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $images_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $cart_data["product_id"] . "'");
                                        $images_data = $images_rs->fetch_assoc();
                                    ?>
                                        <div class="product mt-3">
                                            <img src="<?php echo $images_data["img_path"]; ?>" class="img-fluid rounded-1" style="max-width: 60px;">
                                            <div>
                                                <span><?php echo $product_data["title"]; ?></span>
                                            </div>
                                            <label class="price small">Rs. <?php echo $product_data["price"]; ?></label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            
                            <div class="card checkout" style="background-color: #1e1e1e;">
                                
                                <div class="checkout--footer">
                                    <label class="price"><sup>Rs.</sup> <?php echo $subtotal; ?></label>
                                    <button onclick="checkOut();" class="checkout-btn">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- summary -->
            <?php
                        }
            ?>





            </div>
        </div>

        <?php include "footer.php"; ?>

        </div>
        </div>

        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>

        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

    </html>
<?php
} else {
?>
    <?php header("Location: index.php");
    exit();

    ?>



<?php


}

?>