<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

    

?>
    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Manage Games | gamerLk</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resourses/logo.png">

    </head>

    <body style="background-color: #252526;">

        <div class="container-fluid">
            <div class="row overflow-x-hidden btnn">
                <?php
                include "header_p.php";
                ?>

                <!-- header -->
                <div class="col-12" style="background-color: #252526;">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12 col-lg-4">


                                </div>

                            </div>
                        </div>

                        <div class="col-12 offset-lg-3 a">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2 my-lg-4 text-center">
                                    <h1 class="text-white fw-bold" style="font-family:spartan;">Manage All Games</h1>
                                </div>
                                <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid b">
                                    <button class="btn_p" onclick="window.location='addProduct.php'">Add Game</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- header -->

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control" />
                                </div>
                                <div class="col-3 d-grid">
                                    <button class="btn btn-fuck fw-bold text-light">Search Game</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 d-none d-lg-block col-lg-1 bg-dark1 py-2 text-end">
                            <span class="fs-4 fw-bold text-white">#</span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-dark1 py-2">
                            <span class="fs-4 fw-bold text-light">Game Image</span>
                        </div>
                        <div class="col-4 col-lg-2 bg-dark1 py-2">
                            <span class="fs-4 fw-bold text-white">Title</span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block bg-dark1 py-2">
                            <span class="fs-4 fw-bold text-light">Price</span>
                        </div>
                        <div class="col-2 col-lg-1 bg-dark1 py-2">
                            <span class="fs-4 fw-bold text-white"><i class="fa-solid fa-download fa-lg"></i></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-dark1 py-2">
                            <span class="fs-4 fw-bold text-white">Added Date</span>
                        </div>
                        <div class="col-2 col-lg-1 bg-dark1"></div>
                        <div class="col-2 col-lg-1 bg-dark1"></div>

                    </div>
                </div>

                <?php


                $query = "SELECT * FROM `product`";
                $pageno;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $product_rs = Database::search($query);
                $product_num = $product_rs->num_rows;

                $results_per_page = 15;
                $number_of_pages = ceil($product_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();


                ?>

                    <div class="col-12 mt-3 mb-3">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-dark1 py-2 text-end d-none d-lg-block">
                                <span class="fs-5  text-white"><?php echo $selected_data["id"]; ?></span>
                            </div>
                            <div class="col-2 d-none d-lg-block bg-dark1 py-2 btnn" onclick="viewProductModal('<?php echo $selected_data['id']; ?>');">
                                <?php
                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                $image_num = $image_rs->num_rows;
                                if ($image_num == 0) {
                                ?>
                                    <img src="resource/mobile_images/iphone12.jpg" style="height: 40px;margin-left: 80px;" />
                                <?php
                                } else {
                                    $image_data = $image_rs->fetch_assoc();
                                ?>
                                    <img src="<?php echo $image_data["img_path"]; ?>" style="height: 40px;margin-left: 80px;" />
                                <?php
                                }

                                ?>

                            </div>
                            <div class="col-4 col-lg-2 bg-dark1 py-2">
                                <span class="fs-5  text-white btnn"><?php echo $selected_data["title"]; ?></span>
                            </div>
                            <div class="col-4 col-lg-2 d-lg-block bg-dark1 py-2">
                                <span class="fs-5  text-light btnn">Rs.<?php echo $selected_data["price"]; ?></span>
                            </div>

                            <?php
                            $download_rs = Database::search("SELECT COUNT(*) AS download_count FROM `invoice` WHERE product_id='" . $selected_data["id"] . "'");
                            $download_data = $download_rs->fetch_assoc();
                            $download_count = $download_data['download_count'];
                            
                            
                            
                            ?>




                            <div class="col-2 col-lg-1 bg-dark1 py-2">
                                <span class="fs-5  text-white"> <?php echo $download_count; ?></span>
                            </div>
                            <div class="col-2 d-none d-lg-block bg-dark1 py-2">
                                <span class="fs-6 fw-bold text-light"><?php echo $selected_data["datetime_added"]; ?></span>
                            </div>

                            <div class="col-2 col-lg-1 bg-dark1 py-2 d-grid">
                                <button onclick="sendId(<?php echo $selected_data['id']; ?>);" class="btn btn-primary"><i class="fa-solid fa-upload"></i></button>
                            </div>

                            <div class="col-2 col-lg-1 bg-dark1 py-2 d-grid d-none d-lg-block d-lg-grid">
                                <?php

                                if ($selected_data["status_status_id"] == 1) {
                                ?>
                                    <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');"><i class="fa-solid fa-lock-open"></i></button>
                                <?php
                                } else {
                                ?>
                                    <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-fuck" onclick="blockProduct('<?php echo $selected_data['id']; ?>');"><i class="fa-solid fa-lock"></i></button>
                                <?php

                                }

                                ?>
                            </div>
                            <!--<div class="col-2 col-lg-1 bg-dark1 py-2 d-grid d-none d-lg-block d-lg-grid">
                                <button onclick="removeP(<?php echo $selected_data['id']; ?>);" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </div>-->



                        </div>
                    </div>



                    <!-- modal 01 -->
                    <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data["id"]; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark1">
                                <div class="modal-header border-dark">
                                    <h5 class="modal-title fw-bold text-light"><?php echo $selected_data["title"]; ?></h5>
                                    <button type="button" class="btn-close-whitie" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="offset-4 col-4">

                                        <img src="<?php echo $image_data["img_path"]; ?>" class="img-fluid" style="height: 150px;" />
                                    </div>
                                    <div class="col-12">
                                        <span class="fs-5 fw-bold text-light">Price :</span>&nbsp;
                                        <span class="fs-5 text-light">Rs. <?php echo $selected_data["price"]; ?></span><br />
                                        <span class="fs-5 fw-bold text-light">Description :</span>&nbsp;
                                        <span class="fs-6 text-light"><?php echo $selected_data["description"]; ?></span><br />
                                    </div>
                                </div>
                                <div class="modal-footer border-dark">
                                    <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal 01 -->

                <?php

                }

                ?>

                <!--  -->
                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg justify-content-center">
                            <li class="page-item">
                                <a class="page-link pages" <?php if ($pageno <= 1) {
                                                                echo ("#");
                                                            } else {
                                                                echo "?page=" . ($pageno - 1);

                                                            ?> " <?php
                                                                } ?> aria-label=" Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <?php

                            for ($y = 1; $y <= $number_of_pages; $y++) {
                                if ($y == $pageno) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link pages" href="<?php echo "?page=" . ($y); ?>"> <?php echo $y; ?></a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item ">
                                        <a class="page-link pages" href="<?php echo "?page=" . ($y); ?>"> <?php echo $y; ?></a>
                                    </li>
                            <?php
                                }
                            }

                            ?>

                            <li class="page-item ">
                                <a class="page-link pages" href="<?php if ($pageno >= $number_of_pages) {
                                                                        echo ("#");
                                                                    } else {
                                                                        echo "?page=" . ($pageno + 1);
                                                                    ?>" <?php
                                                                    } ?> aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--  -->

                <div class="col-12 offset-lg-3 a">
                    <div class="row">
                        <div class="col-12 col-lg-6 mt-2 my-lg-4 text-center">
                        </div>
                        <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid b">
                            <button onclick="printInvoice1();" class="btn_p"><i class="fa fa-print"></i> &nbsp;&nbsp;Print</button>
                        </div>

                    </div>
                </div>



                <hr />

                <div class="col-12 text-center">
                    <h1 class="text-light fw-bold">Manage Game Categories</h1>
                </div>

                <div class="col-12 mb-5 mt-4">
                    <div class="row gap-3 justify-content-center ">

                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;
                        for ($x = 0; $x < $category_num; $x++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3 border border-danger rounded p-2" style="height: 50px;">
                                <div class="row">
                                    <div class="col-8 mt-2 mb-2">
                                        <label class="form-label fw-bold fs-5 text-light"><?php echo $category_data["cat_name"]; ?></label>
                                    </div>
                                    <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                        <label onclick="removeC(<?php echo $category_data['cat_id']; ?>);" class="form-label fs-4 text-danger btnn"><i class="fa-solid fa-trash"></i></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-12 col-lg-3 border border-success rounded" style="height: 50px;" onclick="addNewCategory();">
                            <div class="row">
                                <div class="col-8 mt-2 mb-2">
                                    <label class="form-label fw-bold fs-5 text-light">Add new Category</label>
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                    <label class="form-label fs-4 btnn"><i class="bi bi-plus-square-fill text-success"></i></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr />



                <!-- modal cat -->
                <div class="modal" tabindex="-1" id="addCategoryModal">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark1">
                            <div class="modal-header border-dark">
                                <h5 class="modal-title fw-bold text-light">Add New Category</h5>
                                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <label class="form-label text-light">New Category Name : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold border-0 text-light" id="n" />
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="form-label text-light">Enter Your Email : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control text-light border-0 fw-bold" id="e" />
                                </div>
                            </div>
                            <div class="modal-footer border-dark">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary fw-bold" onclick="verifyCategory();">Save New Category</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- modal cat -->
                <!-- modal cat -->
                <div class="modal" tabindex="-1" id="addCategoryVerificationModal">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark1">
                            <div class="modal-header border-dark">
                                <h5 class="modal-title fw-bold text-light">Verification</h5>
                                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label text-light">Enter Your Verification Code : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold text-light border-0" id="txt" />
                                </div>
                            </div>
                            <div class="modal-footer border-dark">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary fw-bold" onclick="saveCategory();">Verify & Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal cat -->


                <div class="col-12 text-center">
                    <h1 class="text-light fw-bold">Manage Game Type</h1>
                </div>

                <div class="col-12 mb-5 mt-4">
                    <div class="row gap-3 justify-content-center ">

                        <?php
                        $type_rs = Database::search("SELECT * FROM `game_type`");
                        $type_num = $type_rs->num_rows;
                        for ($x = 0; $x < $type_num; $x++) {
                            $type_data = $type_rs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3 border border-danger rounded p-2" style="height: 50px;">
                                <div class="row">
                                    <div class="col-8 mt-2 mb-2">
                                        <label class="form-label fw-bold fs-5 text-light"><?php echo $type_data["type_name"]; ?></label>
                                    </div>
                                    <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                        <label onclick="removeT(<?php echo $type_data['id']; ?>);" class="form-label fs-4 text-danger btnn"><i class="fa-solid fa-trash"></i></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-12 col-lg-3 border border-success rounded" style="height: 50px;" onclick="addNewType();">
                            <div class="row">
                                <div class="col-8 mt-2 mb-2">
                                    <label class="form-label fw-bold fs-5 text-light">Add new Type</label>
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                    <label class="form-label fs-4 btnn"><i class="bi bi-plus-square-fill text-success"></i></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- modal type -->
                <div class="modal" tabindex="-1" id="addTypeModal">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark1">
                            <div class="modal-header border-dark">
                                <h5 class="modal-title fw-bold text-light">Add New Game Type</h5>
                                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <label class="form-label text-light">New Game Type Name : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold border-0 text-light" id="type_name" />
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="form-label text-light">Enter Your Email : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control text-light border-0 fw-bold" id="admin_email_t" />
                                </div>
                            </div>
                            <div class="modal-footer border-dark">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary fw-bold" onclick="verifyType();">Save New Game Type</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- modal type -->
                <!-- modal type -->
                <div class="modal" tabindex="-1" id="addTypeVerificationModal">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark1">
                            <div class="modal-header border-dark">
                                <h5 class="modal-title fw-bold text-light">Verification</h5>
                                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label text-light">Enter Your Verification Code : </label>
                                    <input type="text" style="background-color: #252526;" class="form-control fw-bold text-light border-0" id="v_code" />
                                </div>
                            </div>
                            <div class="modal-footer border-dark">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary fw-bold" onclick="saveType();">Verify & Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal type -->


            </div>
        </div>
        <script src="bootstrap.bundle.js"></script>

        <script src="script.js"></script>
    </body>

    </html>
<?php

} else {
    echo ("You are Not a valid user");
}

?>