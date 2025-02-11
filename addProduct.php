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

        <title>Add Product | gamerLk</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resourses/logo.png" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row btnn">
                <?php
                include "header_p.php";

                if (isset($_SESSION["au"])) {

                ?>

                    <div class="col-12" style="background-color: #252526;">
                        <div class="row">

                            <div class="col-12 text-center mt-4 mb-4">
                                <h1 class=" text-white fw-bold" style="font-family:spartan;">Add New Game</h1>
                            </div>

                            <div class="col-12 mt-2" style="background-color: #2d2d30;">
                                <div class="row">

                                    <div class="col-12 col-lg-6 border-end border-fuck mt-3 mb-3">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">Select
                                                    Game Category</label>
                                            </div>

                                            <div class="col-12">
                                                <select style="background-color: #252526;" class="form-select border-0 text-light rounded-3 text-center fw-bold " id="category" onchange="loadBrands();">
                                                    <option value="0">Select Category</option>
                                                    <?php


                                                    $category_rs = Database::search("SELECT * FROM `category`");
                                                    $category_num = $category_rs->num_rows;

                                                    for ($x = 0; $x < $category_num; $x++) {
                                                        $category_data = $category_rs->fetch_assoc();

                                                    ?>

                                                        <option value="<?php echo $category_data["cat_id"]; ?>">
                                                            <?php echo $category_data["cat_name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 border-end border-fuck mt-3">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">Select
                                                    Game Type</label>
                                            </div>

                                            <div class="col-12">
                                                <select style="background-color: #252526;" class="form-select text-center fw-bold border-0 text-light rounded-3" id="game_type">
                                                    <option value="0">Select Type</option>
                                                    <?php

                                                    $brand_rs = Database::search("SELECT * FROM `game_type`");
                                                    $brand_num = $brand_rs->num_rows;

                                                    for ($x = 0; $x < $brand_num; $x++) {
                                                        $brand_data = $brand_rs->fetch_assoc();

                                                    ?>

                                                        <option value="<?php echo $brand_data["id"]; ?>">
                                                            <?php echo $brand_data["type_name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <hr class="border-fuck" />
                                    </div>





                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6 border-end border-fuck">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold text-light" style="font-size: 20px;">Game Name</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8 fw-bold">

                                                        <input style="background-color: #252526;" type="text" class="form-control fw-bold border-0 text-light rounded-3" id="title" />
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-6 border-end border-fuck">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold text-light" style="font-size: 20px;">Game Price</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8 fw-bold">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text fw-bold bg-dark1 text-light border-0">LKR</span>
                                                            <input style="background-color: #252526;" type="text" class="form-control fw-bold border-0 text-light rounded-3" id="cost" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    <div class="col-12">
                                        <hr class="border-fuck" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">
                                                    Game Link
                                                </label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <input style="background-color: #252526;" type="text" class="form-control fw-bold border-0 text-light rounded-3" id="link" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-fuck" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">Game
                                                    Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="10" rows="5" class="form-control fw-bold border-0 text-light rounded-3" style="background-color: #252526;" id="desc"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-fuck" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">Add Game
                                                    Images</label>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="resourses/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="resourses/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="resourses/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3 text-center d-flex justify-content-center">
                                                <input type="file" class="d-none" id="imageuploader" multiple />
                                                <label for="imageuploader" class="col-6 btn btn-primary fw-bold" onclick="changeProductImage();">Upload Images</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-fuck" />
                                    </div>



                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-5">
                                        <button class="btn btn_add" onclick="addProduct();">Save Game</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                } else {
                    header("Location:home.php");
                }
                ?>



                
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