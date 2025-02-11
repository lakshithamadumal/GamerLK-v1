<?php
session_start();
require "connection.php";
if (isset($_SESSION["au"])) {


    if (isset($_SESSION["p"])) {
        $product = $_SESSION["p"];
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Update Product | gamerLk</title>
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resourses/logo.png" />

        </head>

        <body>

            <div class="container-fluid">
                <div class="row btnn">

                    <?php include "header_p.php"; ?>

                    <div class="col-12" style="background-color: #252526;">
                        <div class="row">

                            <div class="col-12 text-center mt-4 mb-4">
                                <h1 class=" text-light fw-bold">Update Game</h1>
                            </div>

                            <div class="col-12 mt-2" style="background-color: #2d2d30;">
                                <div class="row">

                                    <div class="col-12 col-lg-6 border-end border-fuck mt-3 mb-3">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">Select Game Category</label>
                                            </div>

                                            <div class="col-12">
                                                <select style="background-color: #252526;" class="form-select text-center fw-bold border-0 text-light rounded-3" disabled>
                                                    <?php

                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $product["category_cat_id"] . "'");
                                                    $category_data = $category_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo $category_data["cat_name"]; ?></option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 border-end border-fuck mt-3 mb-3">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">Select Game Type</label>
                                            </div>

                                            <div class="col-12">
                                                <select style="background-color: #252526;" class="form-select text-center fw-bold border-0 text-light rounded-3" disabled>
                                                    <?php
                                                    $brand_rs = Database::search("SELECT * FROM `game_type` WHERE `id` IN 
                                                                                (SELECT `game_type_id` FROM `product` WHERE 
                                                                                `id`='" . $product["game_type_id"] . "')");
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo $brand_data["type_name"]; ?></option>
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
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                           
                                                            <input style="background-color: #252526;" type="text" class="form-control fw-bold border-0 text-light rounded-3"  value="<?php echo $product["title"]; ?>" id="t"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6 ">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold text-light" style="font-size: 20px;">Game Price
                                                        </label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text border-0 text-light bg-dark1">LKR</span>
                                                            <input style="background-color: #252526;" type="text" class="form-control fw-bold border-0 text-light rounded-3"  value="<?php echo $product["price"]; ?>" id="pr"/>
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
                                                <input style="background-color: #252526;" type="text" class="form-control fw-bold border-0 text-light rounded-3" value="<?php echo $product["game_link"]; ?>" id="gl" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-fuck" />
                                    </div>



                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">Game Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="10" rows="5" class="form-control fw-bold border-0 text-light rounded-3" style="background-color: #252526;" id="d"><?php echo $product["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-fuck" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold text-light" style="font-size: 20px;">Add Game Images</label>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6">

                                                <?php
                                                $img = array();
                                                $img[0] = "resourses/addproductimg.svg";
                                                $img[1] = "resourses/addproductimg.svg";
                                                $img[2] = "resourses/addproductimg.svg";
                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                                                $img_num = $img_rs->num_rows;
                                                for ($x = 0; $x < $img_num; $x++) {
                                                    $img_data = $img_rs->fetch_assoc();
                                                    $img[$x] = $img_data["img_path"];
                                                }
                                                ?>

                                                <div class="row">
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[0]; ?>" class="img-fluid" style="width: 250px;" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[1]; ?>" class="img-fluid" style="width: 250px;" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[2]; ?>" class="img-fluid" style="width: 250px;" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3 text-center d-flex justify-content-center">
                                                <input type="file" class="d-none" id="imageuploader" multiple />
                                                <label for="imageuploader" class="col-6 btn btn-primary fw-bold">Upload Images</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-fuck" />
                                    </div>

                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-5">
                                        <button class="btn btn_add" onclick="updateProduct();">Update Game</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                    <?php
                    include "footer.php";
                    ?>
                </div>
            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
        </body>

        </html>
    <?php
    } else {
    ?>
        <script>
            alert("Please select a product.");
            window.location = "myProducts.php";
        </script>
    <?php
    }


    ?>

<?php

} else {
    echo ("You are Not a valid user");
}

?>