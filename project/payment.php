<?php
session_start();
error_reporting(E_ALL);


include_once("../connection.php");
require_once("../vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "\\..");
$dotenv->load();

// Check for error messages
if (isset($_GET['msg']))
    echo "<script>alert(" . $_GET['msg'] . ")</script>";

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
$login = $_SESSION['loggin'];

$x = $_SESSION['username'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// If error happens, redirect to hostel page
// try {
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $query1 = "SELECT * FROM students WHERE username='$x'";
    $data1 = mysqli_query($conn, $query1);
    $result1 = mysqli_fetch_assoc($data1);
    $student_id = ($result1['student_id']) ?? $result1['owner_id'];

    $hostel_id = $_POST['id'];
    $query = "SELECT * FROM hostels WHERE hostel_id='$hostel_id'";
    $data = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($data);
    $hostel_name = $result['hostel_name'];
    $owner = $result['owner_id'];

    if (isset($_POST['submit'])) {
        $sname = $_POST['name'];
        $gender = $_POST['gender'];
        $birthday = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['phoneno'];
        $category = $_POST['category_id'];
        $room = $_POST['room'];

        $query = "INSERT INTO reserve 
        (name, gender, birthday, hostel_id, hostel_name, category_id, room_type, email, phoneno, student_id, owner_id, amount_due)
        VALUES('$sname','$gender','$birthday','$hostel_id','$hostel_name','$category','$room','$email','$phone','$student_id','$owner',         
        (CASE
            WHEN '$room'='3' THEN (SELECT charge_triple FROM hostels WHERE hostels.hostel_id = '$hostel_id') ELSE 0,
            WHEN '$room'='2' THEN (SELECT charge_double FROM hostels WHERE hostels.hostel_id = '$hostel_id') ELSE 0,
            WHEN '$room'='1' THEN (SELECT charge_single FROM hostels WHERE hostels.hostel_id = '$hostel_id') ELSE 0
        END));";
        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if ($run)
            echo "Message sent successfully!!!!";
        else
            echo "Message not sent!!!!!";
    }
    $roomtypes = [
        '1' => 'Single Bed',
        '2' => 'Double Share',
        '3' => 'Triple Share'
    ];

    $id = $_POST['id'];
    $room = $_POST['room'];

    $queryH = "SELECT hostels.hostel_name,
          category.category_name AS category, 
          hostels.city, hostels.contact_no, hostels.pincode, hostels.county, 
          owners.name AS owner_name,
          CASE
              WHEN $room = '1' THEN hostels.charge_single
              WHEN $room = '2' THEN hostels.charge_double
              WHEN $room = '3' THEN hostels.charge_triple
          END AS charge
    FROM hostels
    JOIN category ON hostels.category_id = category.category_id
    JOIN owners ON hostels.owner_id = owners.owner_id
    WHERE hostels.hostel_id = '$id' LIMIT 1;";

    $obj = mysqli_query($conn, $queryH);
    if ($obj) {
        $result = mysqli_fetch_assoc($obj);
    }
}else{
    header("Location: hostels.php?msg=".urlencode($_GET['msg']));
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Merriweather&family=Merriweather+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .font-50px a {
            font-size: 25px;
        }

        .x {
            position: relative;
            margin-left: 20px;
            margin-right: 20px;
        }

        .spacer {
            border-left: 1px solid #fa0;
            height: 35px;
            margin: 0 20px;
        }

        @media print {
            #printBtns {
                display: none;
            }

            .hidden-on-print {
                display: none;
            }
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }

        tr>td:nth-child(odd) {
            font-weight: 700;
        }

        tr:nth-child(odd) {
            background-color: #ccc;
        }

        tr:hover {
            background-color: #999;
        }

        .print-dialog {
            position: fixed;
            border: 50pt solid yellowgreen;
            border-radius: 10px 10px;
            background-color: #999;
            width: 40%;
            margin-left: 30%;
        }

        .popup-header {
            border-radius: 0px 0px 10px 10px;
        }

        #payBTN:hover {
            font-size: 12pt;
            font-weight: 600;
            background-color: rgba(100, 254, 185, 0.2);
            color: blue
        }
    </style>
    <title>BILLING</title>
</head>

<body>
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- navigation bar -->
    <div class="navigation hidden-on-print">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark navigations">
            <div class="container-fluid bg-dark">
                <a class="navbar-brand" href="/project/index.php">HOSTEL WORLD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href=<?php echo $_SERVER['HTTP_REFERER'] ?? '' ?>>
                                <i class="fa fa-arrow-left"></i>
                                <span>Back</span>
                            </a>
                        </li>
                        <?php
                        if ($login) : ?>
                            <li class='nav-item'>
                                <a class='nav-link' href="index.php?logout=1">
                                    LOGOUT
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="d-flex">
                        <?php
                        if (!$login) : ?>

                            <div class="spacer"></div>

                            <a class="navbar-brand" href="login.php">
                                <img src="https://img.icons8.com/color/48/000000/user.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                                Student Login
                            </a>

                            <div class="spacer"></div>

                            <a class="navbar-brand" href="admin_login.php">
                                <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-admin-network-technology-itim2101-lineal-color-itim2101-1.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                                Owner Login
                            </a>

                            <div class="spacer"></div>

                            <a class="navbar-brand d-inline-block align-text-top" href="supervisor/supervisor_login.php" style="padding-right:3px;color:#fff;">
                                <div class="d-flex">
                                    <img src="/images/supervisor.png" alt="" width="30" height="24">
                                    &nbsp;
                                    Admin Login
                                </div>
                            </a>

                            <div class="spacer"></div>

                        <?php endif; ?>
                        <?php if (isset($_SESSION['username'])) : ?>
                            <p>
                            <div class="d-flex">
                                <h5 class="mt-1 mr-2 text-white" type="submit">
                                    <i class="fa fa-user text-neutral-700"></i>
                                    <?php echo $_SESSION['username']; ?>
                                </h5>
                            </div>
                            </p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <br>

    <!-- Payment dialog box -->
    <div class="container mt-5 ml-5 mb-5 mr-4 pt-1 pb-2 pl-5 pr-5 print-dialog hidden-on-print" hidden id="paywall">
        <div class="container-fluid d-flex justify-content-between bg-dark text-success pt-2 pl-2 pr-2 pb-1 popup-header">
            <h3>Check Out</h3>
            <span>
                <button type="button" class="btn btn-danger" id="closePaymentDialog">
                    <i class="fa fa-close"></i>
                </button>
            </span>
        </div>
        <hr>
        <form action="mpesa.php" method="post">
            <div class="form-group">
                <div class="input-group">
                    <label for="ref" class="bg-warning rounded-top col-3 p-2 font-weight-bold text-dark">Reference No</label>
                    <input type="text" class="form-control text-dark" name="ref" id="ref" value="<?php echo strtoupper(substr(uniqid("REF"), 0, 11)); ?>" autocomplete="off" disabled>
                </div>
                <div class="input-group">
                    <label for="payer" class="bg-dark col-3 p-2 font-weight-bold text-warning">Payer</label>
                    <input type="text" class="form-control text-dark" name="payer" id="payer" value="<?php echo $_POST['name'] ?>" autocomplete="off" disabled>
                </div>
                <div class="input-group">
                    <label for="phone" class="bg-warning rounded-top col-3 p-2 font-weight-bold text-dark">Phone Number</label>
                    <input type="tel" class="form-control text-dark" name="phone" id="phone" value="<?php echo $_POST['phoneno']; ?>" autocomplete="off" title="Edit the number to receive the payment popup">
                    <button class="btn btn-dark" disabled>
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="input-group">
                    <label for="charge" class="bg-dark col-3 p-2 font-weight-bold text-warning">Amount Due</label>
                    <input type="number" class="form-control text-dark" name="charge" id="charge" value="<?php echo $result['charge'] ?? '00.00'; ?>" disabled autocomplete="off">
                </div>
                <div class="input-group">
                    <label for="desc" class="bg-warning rounded-bottom col-3 p-2 font-weight-bold text-dark">Description</label>
                    <?php
                    $desc = "Payment for " . $result['hostel_name'] . " Hostel Reservation Fee";
                    ?>
                    <input type="text" class="form-control text-dark" name="desc" id="desc" value="Rent Payment" disabled autocomplete="off" style="font-style: italic;">
                </div>
                <p>
                <div class="input-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" id="payBTN" name="submitBtn" onclick="document.querySelectorAll('.form-control').forEach(input=>{ input.disabled = false})">
                        <i class="fa fa-money"></i>
                        <span>Pay with Mpesa</span>
                    </button>
                </div>
                </p>
            </div>
        </form>
    </div>
    <!-- Payment dialog box -->

    <br><br>
    <div class="container text-dark pt-2 pr-2 pl-2 pb-2" style="border:2px solid grey;border-radius:10px 10px;" id="printInvoice">
        <div class="container-fluid">
            <h2 class="h2 text-center">Invoice</h2>
        </div>
        <div class="container-fluid" style="background-color:chartreuse;">
            <strong>
                <?php
                echo "DATE: " . date("m-d-Y  h:i A", time());
                ?>
            </strong>
        </div>
        <div class="d-flex justify-content-between" style="display:flex;">
            <div class="container text-start" style="border-bottom:1px solid red;border-left:1px solid green;">
                <h6 class="text-underline">Payee Details</h6>
                <p class="pr-3">
                    Hostel world payments
                    <br>
                    hostelworld@email.com
                    <br>
                    1212 Strathmore University NBO, Kenya
                    <br>
                    <?php echo "Mpesa Till: <strong>" . $_ENV['SHORT_CODE'] . "</strong>"; ?>
                </p>
            </div>
            <div class="container text-end" style="border-bottom:1px solid red;border-right:1px solid green;">
                <h6 class="text-underline text-strong">Payer Details</h6>
                <p class="pl-3">
                    <?php
                    echo $_POST['name'] . "<br>" . $_POST['email'] . "<br>" . $_POST['phoneno'] . "<br>" . ucfirst($_POST['gender']);
                    ?>
                </p>
            </div>
        </div>
        <table style="font-size:16pt;width:100%;">
            <tr>
                <td>Payment ID:</td>
                <td>
                    <?php echo 1012; ?>
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>
                    <?php echo $_POST['name']; ?>
                </td>
            </tr>

            <tr>
                <td>Gender: </td>
                <td>
                    <?php echo $_POST['gender']; ?>
                </td>
            </tr>
            <hr>
            <tr>
                <td>Hostel Name:</td>
                <td>
                    <?php
                    echo $result['hostel_name'] ?? '';
                    ?>
                </td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <?php echo  $result['category']; ?>
                </td>
            </tr>
            <tr>
                <td>Room Type:</td>
                <td>
                    <?php echo $roomtypes[$_POST['room']]; ?>
                </td>
            </tr>
            <tr>
                <td>City:</td>
                <td>
                    <?php echo  $result['city']; ?>
                </td>
            </tr>
            <tr>
                <td>Pin Code:</td>
                <td>
                    <?php echo  $result['pincode']; ?>
                </td>
            </tr>
            <tr>
                <td>County:</td>
                <td>
                    <?php echo  $result['county']; ?>
                </td>
            </tr>
            <tr>
                <td>Contact Information:</td>
                <td>
                    <?php echo  $result['contact_no']; ?>
                </td>
            </tr>
            <tr>
                <td>Owner/ Realtor:</td>
                <td>
                    <?php echo  $result['owner_name']; ?>
                </td>
            </tr>

        </table>
        <hr>
        <div class="d-flex justify-content-end" style="background-color:#ebe">
            <h4 class="h4"><strong>Total:</strong>
                <strong class="text-success ml-5">
                    KES&nbsp;
                    <?php
                    echo $result['charge'] ?? '0.00';
                    ?>
                </strong>
            </h4>
        </div>
        <hr>
        <div class="container-fluid">
            Thank you for being a part of our business. We're working to improve your user experience. In case of any problem, please Contact
            us <a href="contact.php" target="_blank">here</a>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam expedita cumque molestiae laborum animi deserunt vitae at vero
                provident sunt optio, error odit soluta aut numquam minus non. Aliquam, sit?
            </p>
        </div>
    </div>

    <br>

    <div class="container" id="printBtns">
        <div class="container-fluid text-center">
            <button type="button" class="btn btn-primary" id="print">
                <i class="fa fa-print"></i>
                <span>
                    Print Invoice
                </span>
            </button>
            <button type="button" class="btn btn-primary" id="payprint">
                <i class="fa fa-money"></i>
                <span>
                    Pay and Print
                </span>
            </button>
            <br>
        </div>
    </div>

</body>

<script>
    document.getElementById("print").addEventListener('click', event => {
        window.print()
    })

    // Pay via Mpesa stkpush
    document.getElementById("payprint").addEventListener('click', event => {
        document.getElementById("paywall").hidden = false
    })
    document.getElementById("closePaymentDialog").addEventListener('click', event => {
        document.getElementById("paywall").hidden = true
    })
</script>

</html>