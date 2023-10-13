<?php
session_start();
// error_reporting(0);

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
$login = $_SESSION['loggin'] ?? "";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Merriweather&family=Merriweather+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">
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
    </style>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>HOSTEL PORTAL</title>
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
    <div class="navigation">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark navigations">
            <div class="container-fluid bg-dark">
                <a class="navbar-brand" href="/project/index.php">HOSTEL WORLD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./project/hostels.php">Hostels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./project/myhostels.php">My Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./project/about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./project/contact.php">Contact Us</a>
                        </li>
                        <?php
                        if ($login) : ?>
                            <li class='nav-item'>
                                <a class='nav-link' href="index.php?logout=' 1'">LOGOUT</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="d-flex">
                        <?php
                        if (!$login) : ?>

                            <div class="spacer"></div>

                            <a class="navbar-brand" href="login.php">
                                <img src="https://img.icons8.com/color/48/000000/user.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                                User Login
                            </a>

                            <div class="spacer"></div>

                            <a class="navbar-brand" href="admin_login.php">
                                <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-admin-network-technology-itim2101-lineal-color-itim2101-1.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                                Partner Login
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
                                    <i class="fa fa-user text-white"></i>
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
    <br>
    <br>
    <br>
    <div class="container">
        <img src="images/head.jpeg" alt="">
    </div>

    <div class="recommendation x">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="/images/hostel1.jpg" width="1400" height="600" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block" style="color:#fff;font-weight:900;text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.75);">
                        <h2>Masomo Bora Hostel</h2>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="/images/hostel2.jpg" width="1400" height="600" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block" style="color:#fff;font-weight:900;text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.75);">
                        <h3>Achievers Hostel</h3>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/images/hostel3.jpg" width="1400" height="600" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block" style="color:#fff;font-weight:900;text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.75);">
                        <h3>Nairobi Heights Hostel</h3>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    </div>
    </div>
    <div class="container font-50px">
        <a class="btn btn-primary d-grid gap-2 col-6 mx-auto" href="/project/hostels.php" role="button">BROWSE MORE</a>
    </div>

    <br>
    <div class="container">
        <div class="category ">
            <div class="card-group">
                <div class="card">
                    <img src="/images/category1.jfif" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Category A</h5>
                        <p class="card-text">This category mostly includes hostels with nearly all of the
                            amenities that one would seek, such as 24-hour electricity and water,
                            mess facilities with high-quality food, superb air-conditioned accommodation
                            compartments, and proximity to metro stations and bus stops.</p>
                        <a class="btn btn-primary" href="categorya.php" role="button">Explore More</a>
                    </div>

                </div>
                <div class="card">
                    <img src="/images/category2.jfif" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Category B</h5>
                        <p class="card-text">This category consists of hostels which are near to the metro and bus station.Every room is allotted with cooler facilities.Mess facility provided is also good.</p>
                        <a class="btn btn-primary" href="categoryb.php" role="button">Explore More</a>
                    </div>

                </div>
                <div class="card">
                    <img src="/images/category3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Category C</h5>
                        <p class="card-text">This category mostly include those hostels which are actually far
                            from the metro services but near to the bus services.Even the price of hostels are of affordable range.</p>
                        <a class="btn btn-primary" href="categoryc.php" role="button">Explore More</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Remove the container if you want to extend the Footer to full width. -->
    <div class="footer">
        <!-- Footer -->
        <footer class="text-center text-white" style="background-color:rgb(102 120 80) ;">
            <!-- Grid container -->
            <div class="container">
                <!-- Section: Links -->
                <section class="mt-5">
                    <!-- Grid row-->
                    <div class="row text-center d-flex justify-content-center pt-5">
                        <!-- Grid column -->
                        <div class="col-md-2">
                            <h6 class="text-uppercase font-weight-bold">
                                <a href="/project/about.php" class="text-white">About us</a>
                            </h6>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2">
                            <h6 class="text-uppercase font-weight-bold">
                                <a href="/project/hostels.php" class="text-white">Hostels</a>
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
                                <a href="/project/contact.php" class="text-white">Help</a>
                            </h6>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2">
                            <h6 class="text-uppercase font-weight-bold">
                                <a href="/project/contact.php" class="text-white">Contact</a>
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
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum repellat
                                quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam eum harum
                                corrupti dicta, aliquam sequi voluptate quas.
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
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
    <!-- End of .container -->

</body>

</html>