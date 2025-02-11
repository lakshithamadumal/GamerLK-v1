<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resourses/logo.png">
    <title>Profile | gamerlk</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body style="background-color: #252526;">

    <div class="container-fluid">
        <div class="row btnn overflow-x-hidden">


            <?php
            session_start();
            include "header_u.php";
            require "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `users_email`='" . $email . "'");
                $invoice_num = $invoice_rs->num_rows;


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

                        <div class="col-12 offset-lg-3 a mt-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2 my-lg-4 text-center">
                                    <h1 class="text-white fw-bold" style="font-family:spartan;">Purchasing History</h1>
                                </div>
                                <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid b">
                                    <button class="btn_p" onclick="window.location='userProfile.php'"><i class="fa-solid fa-user"></i>&nbsp; &nbsp;Profile </button>
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
                        <div class="col-2 d-none d-lg-block bg-dark1 py-2">
                            <span class="fs-4 fw-bold text-white">Purchase Date</span>
                        </div>
                        <div class="col-2 col-lg-1 bg-dark1"></div>
                        <div class="col-2 col-lg-1 bg-dark1 d-none d-lg-block"></div>

                        <div class="col-2 col-lg-1 bg-dark1 d-none d-lg-block"></div>
                    </div>
                </div>

                <?php
                if ($invoice_num == 0) {

                ?>
                    <div class="col-12 text-center" style="height: 450px;background-color: #252526;">
                        <span class="fs-1 fw-bold text-light d-block" style="margin-top: 200px;">
                            You have not purchased any Game yet...
                        </span>
                    </div>
                <?php
                } else {
                ?>


                    <?php

                    for ($x = 0; $x < $invoice_num; $x++) {
                        $invoice_data = $invoice_rs->fetch_assoc();
                    ?>
                        <div class="col-12 mt-3 mb-3">
                            <div class="row">

                                <div class="col-2 col-lg-1 bg-dark1 py-2 text-end d-none d-lg-block">
                                    <label class="fs-4 text-white"><?php echo $invoice_data["id"]; ?></label>
                                </div>

                                <?php

                                $details_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                                    product.id=product_img.product_id  
                                                    WHERE `id`='" . $invoice_data["product_id"] . "'");

                                $product_data = $details_rs->fetch_assoc();

                                ?>

                                <div class="col-2 d-none d-lg-block bg-dark1 py-2 btnn">
                                    <img src="<?php echo $product_data["img_path"]; ?>" style="height: 40px;margin-left: 80px;" />
                                </div>


                                <div class="col-4 col-lg-2 bg-dark1 py-2">
                                    <label class="fs-5  text-white btnn"><?php echo $product_data["title"]; ?></label>
                                </div>

                                <div class="col-4 col-lg-2 bg-dark1 py-2">
                                    <label class="fs-5 text-white btnn">Rs. <?php echo $invoice_data["total"]; ?></label>
                                </div>
                                <div class="col-4 col-lg-2 bg-dark1 py-2 d-none d-lg-block">
                                    <label class="fs-6  text-white btnn"><?php echo $invoice_data["date"]; ?></label>
                                </div>

                                <div class="col-2 col-lg-1 bg-dark1 py-2 d-grid d-grid">
                                    <a href="<?php echo $product_data['game_link']; ?>" target="_blank" class="btn btn-success fw-bold">
                                        <i class="fa-solid fa-download fa-lg"></i>
                                    </a>
                                </div>


                                <div class="col-2 col-lg-1 bg-dark1 py-2 d-grid ">
                                    <button onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);" class="btn btn-primary fw-bold"><i class="fa-solid fa-message"></i></button>
                                </div>

                                <div class="col-4 col-lg-2 bg-dark1 py-2 d-none d-lg-block">
                                </div>
                                


                                <!-- <div class="col-12 col-lg-3">
                                    <div class="row">
                                        <div class="col-6 d-grid bg-dark1">
                                            <button class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5 fw-bold" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                            <i class="fa-solid fa-comments"></i> Feedback
                                            </button>
                                        </div>
                                        <div class="col-6 d-grid bg-dark1">
                                            <button class="btn btn-danger rounded mt-5 fs-5 fw-bold">
                                                <i class="bi bi-trash3-fill"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div> -->




                            </div>
                        </div>


                    <?php
                    }

                    ?>

                    <div class="col-12 offset-lg-3 a">
                        <div class="row">
                            <div class="col-12 col-lg-6 mt-2 my-lg-4 text-center">
                            </div>
                            <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid b">
                                <button onclick="printInvoice1();" class="btn_p"><i class="fa fa-print"></i> &nbsp;&nbsp;Print</button>
                            </div>

                        </div>
                    </div>


                    <div class="col-12">
                        <hr />
                    </div>

                    <!-- model -->
                    <div class="modal" tabindex="-1" id="feedbackModal<?php echo $invoice_data['product_id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark1">
                                <div class="modal-header border-dark">
                                    <h5 class="modal-title fw-bold text-light">Add New Feedback</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold text-light">Type</label>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type1" />
                                                            <label class="form-check-label text-success fw-bold" for="type1">
                                                                Positive
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type2" checked />
                                                            <label class="form-check-label text-warning fw-bold" for="type2">
                                                                Neutral
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type3" />
                                                            <label class="form-check-label text-danger fw-bold" for="type3">
                                                                Negative
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold text-light">User's Email</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input style="background-color: #252526;" type="text" class="form-control text-light border-dark" id="mail" value="<?php echo $email; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold text-light">Feedback</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <textarea style="background-color: #252526;" class="form-control text-light border-dark" cols="50" rows="8" id="feed"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-dark">
                                    <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary fw-bold" onclick="saveFeedback(<?php echo $invoice_data['product_id']; ?>);">Save Feedback</button>
                                </div>
                            </div>
                        </div>
                    </div>




                <?php
                }
                ?>














            <?php

            } else {
                require "banner.php";
            }

            ?>




            <?php

            require "footer.php";

            ?>



        </div>
    </div>









    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>


</body>

</html>