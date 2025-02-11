<?php

session_start();
require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>

    <title>Home | gamerLk</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resourses/logo.png">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">



</head>

<body style="background-color: #252526;">

    <div class="container-fluid">
        <div class="row btnn">

            <?php include "header.php";

            ?>

            <hr />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">

                    <div class="offset-1 offset-lg-1 col-3 col-lg-1 "></div>

                    <div class="col-12 col-lg-5">

                        <div class="input-group mb-3 mt-3">
                            <input type="text" style="background-color: #1e1e1e;" class="form-control text-light border-0" id="kw" aria-label="Text input with dropdown button" />

                            <select class="form-select fw-bold text-light border-0" style="max-width: 250px;background-color: #1e1e1e;" id="c">
                                <option value="0" class="fw-bold border-0">All Categories</option>

                                <?php

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                                <?php

                                }

                                ?>


                            </select>
                        </div>

                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-primary mt-3 mb-3 fw-bold" onclick="basicSearch(0);">Search</button>
                    </div>

                    <div class="col-12 col-lg-2 mt-2 mt-lg-4 text-center text-lg-start">
                        <a href="advancedSearch.php" class="text-decoration-none link-fuck text-light fw-bold">Advanced</a>
                    </div>

                </div>
            </div>

            <hr />

            <div class="col-12" id="basicSearchResult">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="row">

                            <?php include "banner_c.php" ?>
                        </div>
                    </div>


                    <!-- Carousel 
                    <div class="col-12 d-none d-lg-block mb-2">
                        <div class="row">

                            <div id="carouselExampleCaptions" class="offset-2 col-8 carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="2000">
                                        <img src="resourses/c5.png" class="d-block poster-img-1" />

                                    </div>
                                    <div class="carousel-item" data-bs-interval="1000">
                                        <img src="resourses/c1.jpg" class="d-block poster-img-1" />
                                    </div>
                                    <div class="carousel-item" data-bs-interval="1000">
                                        <img src="resourses/c2.jpg" class="d-block poster-img-1" />

                                    </div>
                                    <div class="carousel-item" data-bs-interval="1000">
                                        <img src="resourses/c4.jpg" class="d-block poster-img-1" />

                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                    </div>
                     Carousel -->

                    <!-- Category -->
                    <?php

                    $c_rs = Database::search("SELECT * FROM `category`");
                    $c_num = $c_rs->num_rows;

                    for ($y = 0; $y < $c_num; $y++) {

                        $c_data = $c_rs->fetch_assoc();

                    ?>

                        <!-- category names -->
                        <div class="col-12 mt-3 mb-3">
                            <a href="#" class="text-decoration-none fs-3 fw-bold" style="color: #ff4d05;">
                                <?php echo $c_data["cat_name"]; ?>
                            </a>&nbsp;&nbsp;
                            <a href="#" class="text-decoration-none text-light fs-6 link-fuck">See All &nbsp;&rarr;</a>
                        </div>
                        <!-- category names -->


                        <!-- products -->
                        <div class="col-12 mb-3 ">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row justify-content-center gap-4 ">

                                        <?php

                                        $product_rs = Database::search("SELECT product.*, game_type.type_name FROM `product` 
                                        JOIN `game_type` ON product.game_type_id = game_type.id 
                                        WHERE `category_cat_id`='" . $c_data["cat_id"] . "' AND 
                                        `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                        $product_num = $product_rs->num_rows;

                                        for ($z = 0; $z < $product_num; $z++) {
                                            $product_data = $product_rs->fetch_assoc();
                                        ?>

                                            <div class="card col-12 col-lg-2 mt-2 mb-2 border-0 x btnn box_s geeks" style="width: 18rem;background-color: #1e1e1e">

                                                <?php

                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE  `product_id`='" . $product_data['id'] . "'");
                                                $img_data = $img_rs->fetch_assoc();

                                                //$gametype_rs = Database::search("SELECT * FROM `game_type` WHERE  `id`='" . $product_data['id'] . "'");
                                                //$gametype_data = $gametype_rs->fetch_assoc(); 




                                                ?>
                                                <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>">
                                                    <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail1 mt-2" style="height: 250px;" />
                                                </a>
                                                <div class="card-body ms-0 m-0 text-start">

                                                    <span style="font-size: 14px; color: #606063;"><?php echo $product_data["type_name"]; ?></span>
                                                    <h5 class="card-title text-light fw-bold" style="font-size: 14px; padding-top: 7px;"><?php echo $product_data["title"]; ?></h5>

                                                    <div class="star">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>

                                                    </div>

                                                    <span class="card-text" style="padding-top: 7px; font-size: 15px; font-weight: 700; color: #81e6d9;">Rs. <?php echo $product_data["price"]; ?> </span><br />
                                                    <div class="col-12">
                                                        <div class="row offset-8">





                                                            <?php
                                                            if (isset($_SESSION['u'])) {




                                                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product_data["id"] . "' AND 
                                                               `users_email`='" . $_SESSION["u"]["email"] . "'");
                                                                $watchlist_num = $watchlist_rs->num_rows;

                                                                if ($watchlist_num == 1) {
                                                            ?>
                                                                    <button class="col-3 btn mt-2 btn_c" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                                                        <i class="fa-solid fa-heart fa-xl text-danger" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                                    </button>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <button class="col-3 btn mt-2 btn_c" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                                                        <i class="fa-solid fa-heart fa-xl" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                                    </button>
                                                                <?php
                                                                }

                                                                ?>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button class="col-3 btn mt-2 btn_c" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                                                    <i class="fa-solid fa-heart fa-xl"></i>
                                                                </button>
                                                            <?php
                                                            }


                                                            ?>
                                                            <div class="col-1"></div>

                                                            <button onclick="addToCart(<?php echo $product_data['id']; ?>);" class="col-1 btn mt-2 btn_c">
                                                                <i class="fa-solid fa-cart-shopping fa-xl"></i>
                                                            </button>


                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php

                                        }

                                        ?>



                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- products -->




                    <?php

                    }

                    ?>


                </div>
            </div>
            <?php include "ads.php"; ?>







        </div>

    </div>



    <?php
    if (isset($_SESSION["u"])) {
        $session_data = $_SESSION["u"];
    ?>

    <?php
    } else {

        include "banner.php";
    }
    ?>







    <?php include "footer.php"; ?>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>