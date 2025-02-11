<?php
session_start();

require "connection.php";

if (isset($_SESSION["au"])) {
?>

    <?php

    $today = date("Y-m-d");
    $thismonth = date("m");
    $thisyear = date("Y");

    $a = 0; // Daily earnings
    $b = 0; // Monthly earnings
    $c = 0; // Today selling count
    $e = 0; // Monthly selling count
    $f = 0; // Total selling count

    $invoice_rs = Database::search("SELECT * FROM `invoice`");
    $invoice_num = $invoice_rs->num_rows;

    for ($x = 0; $x < $invoice_num; $x++) {
        $invoice_data = $invoice_rs->fetch_assoc();

        $d = $invoice_data["date"];
        $pdate = date("Y-m-d", strtotime($d)); // Convert to Y-m-d format

        if ($pdate == $today) {
            $a += $invoice_data["total"]; // Update daily earnings
            $c++; // Increment today selling count
        }

        $pyear = date("Y", strtotime($d)); // Extract year
        $pmonth = date("m", strtotime($d)); // Extract month

        if ($pyear == $thisyear && $pmonth == $thismonth) {
            $b += $invoice_data["total"]; // Update monthly earnings
            $e++; // Increment monthly selling count
        }

        $f++; // Increment total selling count
    }
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel | gamerLk</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" href="resourses/logo.png">
    </head>

    <body style="background-color:#252526">
        <div class="container-fluid">
            <div class="row btnn overflow-x-hidden">
                <?php include "header_a.php"; ?>

                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="col-12 align-items-start vh-100 mt-0" style="background-color: #2d2d30;">
                            <div class="row g-1 text-center">
                                <div class="col-12 mt-5">
                                    <h4 class="text-white fw-bold">Selling History</h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="col-12 mt-3 d-grid">
                                    <label class="form-label fs-6 fw-bold text-white">From Date</label>
                                    <input type="date" class="form-control" />
                                    <label class="form-label fs-6 fw-bold text-white mt-2">To Date</label>
                                    <input type="date" class="form-control" />
                                    <a href="#" class="btn btn-primary mt-2 fw-bold">Search</a>
                                    <label class=" d-none d-block form-label fs-6 fw-bold text-white mt-5">Daily Sellings</label>
                                    <hr class="border border-1 border-white" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="col-12 offset-lg-3 a">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2 my-lg-4 text-center">
                                    <h1 class="text-white fw-bold" style="font-family:spartan;">Dashboard</h1>
                                </div>
                                <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid b">
                                    <button onclick="printInvoice();" class="btn_p"><i class="fa fa-print"></i> &nbsp;&nbsp;Print</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="border border-fuck" />
                        </div>
                        <div class="col-12">
                            <div class="row g-2" id="page">

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark1 text-white text-center rounded btnn" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Earnings</span>
                                            <br />
                                            <span class="fs-6 badge bg-success text-light">Rs. <?php echo $b; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark1 text-black text-center rounded btnn" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold text-light">Monthly Earnings</span>
                                            <br />
                                            <span class="fs-6 badge bg-success text-light">Rs. <?php echo $b; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark1 text-white text-center rounded btnn" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-6 badge bg-success text-light"><?php echo $e; ?> Games</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark1 text-white text-center rounded btnn" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-6 badge bg-success text-light"><?php echo $e; ?> Games</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark1 text-white text-center rounded btnn" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-6 badge bg-success text-light"><?php echo $f; ?> Games</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark1 text-white text-center rounded btnn" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold text-light">Total Engagements</span>
                                            <br />
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `users`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-6 badge bg-success text-light"><?php echo $user_num; ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12 bg-dark1">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center my-3">
                                    <label class="form-label fs-4 fw-bold text-white">Active Time</label>
                                </div>
                                <div class="col-12 col-lg-10 text-center my-3">
                                    <?php

                                    $start_date = new DateTime("2022-09-27 00:00:00");

                                    $tdate = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $tdate->setTimezone($tz);

                                    $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                    $difference = $end_date->diff($start_date);

                                    ?>
                                    <label class="form-label fs-4 fw-bold text-primary">
                                        <?php

                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-dark1">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-5 fw-bold text-white">Recently Sold Items</label>
                                </div>

                                <?php

                                $recent_selling_rs = Database::search("SELECT * FROM `invoice` WHERE `date` ORDER BY `date` DESC LIMIT 5");
                                $recent_selling_num = $recent_selling_rs->num_rows;

                                for ($x = 0; $x < $recent_selling_num; $x++) {
                                    $recent_selling_data = $recent_selling_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $recent_selling_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $recent_selling_data["product_id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 col-lg-4 mb-2">
                                        <img src="<?php echo $image_data["img_path"]; ?>" style="height: 80px;margin-left: 10px;">
                                    </div>
                                    <div class="col-12 col-lg-8 mb-2">
                                        <h6 class="text-white mt-2"><?php echo $product_data["title"]; ?></h6>
                                        <span class="badge bg-primary">Rs. <?php echo $recent_selling_data["total"]; ?></span>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-12 col-lg-7 my-3 rounded bg-dark1">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-5 fw-bold text-white">Monthly Sellings</label>
                                </div>

                                <div class="col-12" style="height: 260px;">
                                    <canvas class="bg-light" id="chart1"></canvas>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            <?php } ?>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            var label = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            var data1 = [10, 30, 40, 50, 60, 70, 80];

            var ctx = document.getElementById("chart1").getContext("2d");

            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Monthly Sellings',
                        data: data1,
                        backgroundColor: 'rgb(15, 11, 245)',
                        borderColor: 'rgb(15, 11, 245)',
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>

    </html>