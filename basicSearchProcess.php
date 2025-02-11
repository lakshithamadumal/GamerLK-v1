<?php

require "connection.php";

$text = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product`";

if (!empty($text) && $select == 0) {

    $query .= " WHERE `title` LIKE '%" . $text . "%'";
} else if (empty($text) && $select != 0) {

    $query .= " WHERE `category_cat_id`='" . $select . "'";
} else if (!empty($text) && $select != 0) {

    $query .= " WHERE `title` LIKE '%" . $text . "%' AND `category_cat_id`='" . $select . "'";
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row justify-content-center gap-4">

            <?php

            if ("0" != $_POST["page"]) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 2;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " 
                                            OFFSET " . $page_results . " ");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                                    `product_id`='" . $selected_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();

            ?>

                <!-- card -->

                <div class="card col-12 col-lg-2 mt-2 mb-2 border-0 x btnn" style="width: 18rem;background-color: #1e1e1e">


                <a href="<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>">
                    <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top img-thumbnail1 mt-2" style="height: 250px;" />
                </a>    
                    <div class="card-body ms-0 m-0 text-start">
                        <span style="font-size: 14px; color: #606063;"></span>

                        <h5 class="card-title fw-bold  text-light"style="font-size: 14px; padding-top: 7px;"><?php echo $selected_data["title"]; ?></h5>
                        <div class="star">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>

                                                    </div>

                        <span class="card-text" style="padding-top: 7px; font-size: 15px; font-weight: 700; color: #81e6d9;">Rs. <?php echo $selected_data["price"]; ?> </span><br />

                        <div class="col-12">
                            <div class="row offset-8">
                                
                                <button onclick="addToWatchlist(<?php echo $selected_data['id']; ?>);" class="col-3 btn mt-2 btn_c">
                                    <i class="fa-solid fa-heart fa-xl"></i>
                                </button>
                                <div class="col-1"></div>
                                <button onclick="addToCart(<?php echo $selected_data['id']; ?>);" class="col-1 btn mt-2 btn_c">
                                    <i class="fa-solid fa-cart-shopping fa-xl"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- card -->

            <?php
            }

            ?>

        </div>
    </div>

    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link pages" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php

                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link pages" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item ">
                            <a class="page-link pages" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item ">
                    <a class="page-link pages" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>