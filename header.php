<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="offset-lg-1 col-12 col-lg-3 align-self-start mt-2">

            <?php
            session_start();

            if(isset($_SESSION["u"])){
                $data = $_SESSION["u"];
                ?>
                <span class="text-lg-start text-success"><b>Hi </b><?php echo $data["fname"]; ?></span> | 
                <span class="text-lg-start fw-bold signout" onclick="signout();">Signout</span> |
                <?php

            }else{
                ?>
                <a href="index.php" class="text-decoration-none fw-bold">Sign In</a> |
                <?php
            }
            
            ?>

                <span class="text-lg-start fw-bold">Help and Contact</span>

            </div>

            <div class="col-12 col-lg-3 offset-lg-5 align-self-end" style="text-align: center;">
                <div class="row">

                    <div class="col-1 col-lg-3 mt-2">
                        <span class="text-start fw-bold"></span>
                    </div>

                    <div class="col-12 col-lg-6 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            PFMS
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="accounts.php">Accounts</a></li>
                            <li><a class="dropdown-item" href="categories.php">Categories</a></li>
                            <li><a class="dropdown-item" href="transactions.php">Transactions</a></li>
                            <li><a class="dropdown-item" href="reports.php">Reports</a></li>
                            <li><a class="dropdown-item" href="sync.php">Sync</a></li>
                        </ul>
                    </div>

                    <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon" onclick="window.location='cart.php';"></div>

                    
                </div>
            </div>

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>