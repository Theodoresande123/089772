<?php
session_start();
include_once("../connection.php");

//   if (!isset($_SESSION['username'])) {
//   	$_SESSION['msg'] = "You must log in first";
//   	header('location: login.php');
//   }
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
$login = $_SESSION['loggin'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        #top_recom {
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Merriweather&family=Merriweather+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="styleabout.css">
    <link rel="stylesheet" href="style.css">

    <title>HOSTEL WORLD</title>
</head>

<body>
    <!-- navigation bar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark navigations">
        <div class="container-fluid bg-dark">
            <a class="navbar-brand" href="/project/index.php">HOSTEL WORLD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/project/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Hostel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project/myhostels.php">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project/about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project/contact.php">Contact Us</a>
                    </li>
                    <?php
                    if ($login) {
                        echo "</li>
                            <li class='nav-item'>
                       <a class='nav-link'href='index.php?logout='1''>LOGOUT</a>
                        </li>";
                    }
                    ?>
                </ul>
                <div class="d-flex">
                    <?php
                    if (!$login) {
                        echo '<a class="navbar-brand" href="login.php">
                           <img src="https://img.icons8.com/color/48/000000/user.png" alt="" width="30" height="24" class="d-inline-block align-text-top">User Login

                       </a>
                       <a class="navbar-brand" href="admin_login.php">
                           <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-admin-network-technology-itim2101-lineal-color-itim2101-1.png" alt="" width="30" height="24" class="d-inline-block align-text-top">Admin
                           Login

                       </a>';
                    }
                    ?>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <p>
                        <div class="d-flex">
                            <h5 class="mt-1 mr-2 text-white" type="submit">
                                <i class="fa fa-user text-white"></i>
                                <?php echo $_SESSION['username']; ?>
                            </h5>
                        </div>
                        </p>
                    <?php endif ?>

                </div>
            </div>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="btn-group btn-group-justified btn-lg">
            <button type="button" class="btn btn-default disabled">
                <strong>
                    SEARCH BY HOSTEL NAME, LOCATION(City/County)
                </strong>
            </button>
        </div>

        <form action="" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" value="<?php echo $_GET['search'] ?? ""; ?>" class="form-control" placeholder="search data">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <?php
        if (isset($_GET['search'])) {
            $filtervalue = htmlspecialchars($_GET['search']);

            $query = "SELECT * FROM hostels WHERE CONCAT(hostel_name,hostel_id,city,county) LIKE '%$filtervalue%';";
            $data = mysqli_query($conn, $query);

            $total = mysqli_num_rows($data);
            if ($total > 0) { ?>
                <div class='container'>
                    <h1 id='top_recom'><i>LIST OF HOSTELS</i></h1><br>
                </div>
                <div class='container'>
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th scope='col'>Hostel ID</th>
                                <th scope='col'>Hostel Name</th>
                                <th scope='col'>City</th>
                                <th scope='col'>Availability</th>
                                <th scope='col'>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($total != 0) {
                                while ($result = mysqli_fetch_assoc($data)) {
                                    $id = $result['hostel_id'];
                                    echo "<tr>" .
                                        "<td>" . $result['hostel_id'] . "</td>
                                        <td>" . $result['hostel_name'] . "</td>
                                        <td>" . $result['city'] . "</td>
                                        <td>" . $result['seat_availability'] . "</td>" .
                                        "<td><a href='view.php?id=$id'class='btn btn-primary'>View Details</a></td>" .
                                        "</tr>";
                                }
                            }
                        } else { ?>
                            <div class="container">
                                <h1 id='top_recom'>
                                    <i>LIST OF HOSTELS</i>
                                </h1><br>
                                <div>
                                    <p style="color:red;">
                                        No results found!!
                                    </p>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
                <br><br><br><br><br>

                <div class="container">
                    <div class="category">
                        <div class="card-group">
                            <div class="card">
                                <img src="../images/category1.jfif" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Category A</h5>
                                    <p class="card-text">This category mostly includes hostels with nearly all of the amenities that one would seek, such as 24-hour electricity and water, mess facilities with high-quality food, superb air-conditioned accommodation compartments, and proximity to metro stations and bus stops.</p>
                                    <a class="btn btn-primary" href="../categorya.php" role="button">Explore More</a>
                                </div>

                            </div>
                            <div class="card">
                                <img src="../images/category2.jfif" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Category B</h5>
                                    <p class="card-text">This category consists of hostels which are near to the metro and bus station.Every room is alotted with cooler facilities.Mess facilities are of average zone.</p>
                                    <a class="btn btn-primary" href="../categoryb.php" role="button">Explore More</a>
                                </div>

                            </div>
                            <div class="card">
                                <img src="../images/category3.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Category C</h5>
                                    <p class="card-text">This category mostly include those hostels which are actually far from the metro services but near to the bus services.Even the price of hostels are of affordable range.</p>
                                    <a class="btn btn-primary" href="../categoryc.php" role="button">Explore More</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->

                <div class="footer">
                    <!-- Footer -->
                    <footer class="text-center text-white" style="background-color: rgb(209 20 80);">
                        <!-- Grid container -->
                        <div class="container">
                            <!-- Section: Links -->
                            <section class="mt-5">
                                <!-- Grid row-->
                                <div class="row text-center d-flex justify-content-center pt-5">
                                    <!-- Grid column -->
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="/about.php" class="text-white">About us</a>
                                        </h6>
                                    </div>
                                    <!-- Grid column -->

                                    <!-- Grid column -->
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="/hostels.php" class="text-white">Hostels</a>
                                        </h6>
                                    </div>
                                    <!-- Grid column -->

                                    <!-- Grid column -->
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="#!" class="text-white">Review</a>
                                        </h6>
                                    </div>
                                    <!-- Grid column -->

                                    <!-- Grid column -->
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="/contact.php" class="text-white">Help</a>
                                        </h6>
                                    </div>
                                    <!-- Grid column -->

                                    <!-- Grid column -->
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="/contact.php" class="text-white">Contact</a>
                                        </h6>
                                    </div>
                                    <!-- Grid column -->
                                </div>
                                <!-- Grid row-->
                            </section>
                            <!-- Section: Links -->

                            <hr class="my-5" />

                            <!-- Section: Text -->
                            <section class="mb-5">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-8">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum repellat quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam eum harum corrupti dicta, aliquam sequi voluptate quas.
                                        </p>
                                    </div>
                                </div>
                            </section>
                            <!-- Section: Text -->

                            <!-- Section: Social -->
                            <section class="text-center mb-5">

                                <a href="#" class="fa fa-facebook"></a>

                                <a href="#" class="fa fa-twitter"></a>
                                <a href="#" class="fa fa-instagram"></a>

                            </section>
                            <!-- Section: Social -->
                        </div>
                        <!-- Grid container -->

                        <!-- Copyright -->
                        <div class="d-flex justify-content-center">
                            Copyright&copy; Theo 2023 All rights reserved&trade;
                        </div>
                        <!-- Copyright -->
                    </footer>
                    <!-- Footer -->
                </div>
                <!-- End of .container -->
</body>

</html>