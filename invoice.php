<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | gamerLk</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/logo.png">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

</head>

<body style="background-color: #252526;" class="btnn">
    <?php include "header_i.php";

    include "connection.php";

    if (isset($_SESSION["u"])) {
        $umail = $_SESSION["u"]["email"];
        $oid = $_GET["id"];

    ?>
        <!--Author      : @arboshiki-->
        <div id="invoice">

            <div class="toolbar hidden-print">
                <div class="text-right">
                    <button onclick="printInvoice();" id="printInvoice" style="background-color: #ff4d05;" class="btn fw-bold text-light"><i class="fa fa-print"></i> Print</button>
                    <button onclick="printInvoice();" class="btn btn-warning fw-bold"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                </div>
                <hr>
            </div>
            <div class="invoice overflow-auto" id="page" style="background-color: #1e1e1e;">
                <div style="min-width: 600px" id="page">
                    <header>
                        <div class="row">
                            <div class="col">

                                <h5 class="mb-4 footer-logo text-light">GAMER<span style="color: #ff4d05;" class="footer-logo">L</span>K</h5>

                            </div>
                            <div class="col company-details text-light">
                                <h3 class="name ">

                                    GamerLk

                                </h3>
                                <div>Sri Lanka</div>
                                <div>(+94) 71-265-4117</div>
                                <div>gamerlk@gmail.com</div>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row contacts">

                            <div class="col invoice-to text-light">
                                <div class="text-gray-light">INVOICE TO:</div>
                                <h2 class="to"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                <div class="address"><?php echo $umail; ?></div>
                            </div>

                            <?php

                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                            $invoice_data = $invoice_rs->fetch_assoc();

                            ?>


                            <div class="col invoice-details ">
                                <h1 class="invoice-id fw-bold">INVOICE <?php echo $invoice_data["id"]; ?></h1>
                                <div class="date text-light">Date of Invoice: <?php echo $invoice_data["date"]; ?></div>
                            </div>
                        </div>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="background-color: #252526;color:white;">#</th>
                                    <th style="background-color: #252526;color:white;" class="text-left">NAME OF THE GAMES</th>
                                    <th style="background-color: #252526;color:white;" class="text-right"></th>
                                    <th style="background-color: #252526;color:white;" class="text-right"></th>
                                    <th style="background-color: #252526;color:white;" class="text-right">PRICE</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td style="background-color: #252526;color:white;" class="no"><?php echo $invoice_data["id"]; ?></td>

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    ?>

                                    <td style="background-color: #252526;" class="text-left">
                                        <h3 class="fw-bold text-light "><?php echo $product_data["title"]; ?></h3>
                                    </td>
                                    <td style="background-color: #252526;color:white;" class="unit"></td>
                                    <td style="background-color: #252526;color:white;" class="qty"></td>
                                    <td style="background-color: #252526;color:white;" class="total">Rs. <?php echo $product_data["price"]; ?>.00</td>
                                </tr>


                            </tbody>
                            <tfoot>

                                <tr>
                                    <td style="background-color: #252526;color:white;" colspan="2"></td>
                                    <td style="background-color: #252526;color:white;" colspan="2">GRAND TOTAL</td>
                                    <td style="background-color: #252526;color:#3989C6;" class="fw-bold">Rs. <?php echo $invoice_data["total"]; ?>.00</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="notices">
                            <div class="text-light fs-5">Download Game:</div>
                            <div class="notice text-light" style="font-size: 16px;">
                                <a class="text-decoration-none fw-bold text-light badge bg-success" href="<?php echo $product_data["game_link"]; ?>" target="_blank"><?php echo $product_data["title"]; ?></a>
                            </div>
                        </div>
                    </main>
                    <footer class="text-light">
                        Invoice was created on a computer and is valid without the signature and seal.
                    </footer>
                </div>
                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                <div></div>
            </div>
        </div>
    <?php
    }

    ?>

    <?php include "footer.php" ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>