<?php
session_start();
include_once('connection.php');

$insert = false;
if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: admin_login.php');
}
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
  <link rel="stylesheet" href="styleabout.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Merriweather&family=Merriweather+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    #top_recom {
      font-family: 'Times New Roman', Times, serif;

    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
    }

    .card-registration .select-arrow {
      top: 13px;
    }

    .n {
      background-color: #D11450;
    }
  </style>

  <title>HOSTEL WORLD</title>
</head>

<body>
  <!-- navigation bar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark n">
    <div class="container-fluid bg-dark">
      <a class="navbar-brand" href="admin_index.php">HOSTEL WORLD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="admin_index.php">Home</a>
          </li>
          <li class="nav-item">
          <li><a class="nav-link" href="addhostels.php">ADD hostels</a></li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="delhostel.php">Delete hostel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin_request.php">Requests</a>
          </li>
          <?php if ($login) : ?>
              <li class='nav-item'>
                <a class='nav-link' href="logout.php">LOGOUT</a>
              </li>
            <?php endif; ?>
        </ul>
        <div class="d-flex">
          <?php
          if (!$login) { ?>
            <a class="navbar-brand" href="login.php">
              <img src="https://img.icons8.com/color/48/000000/user.png" alt="" width="30" height="24" class="d-inline-block align-text-top">User Login
            </a>
            <a class="navbar-brand" href="admin_login.php">
              <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-admin-network-technology-itim2101-lineal-color-itim2101-1.png" alt="" width="30" height="24" class="d-inline-block align-text-top">Admin
              Login
            </a>';
          <?php } ?>
          <?php if (isset($_SESSION['username'])) : ?>
            <div class="d-flex">
              <i class="fa fa-user text-white"></i>
              <button class="btn btn-success" type="submit">
                <?php echo $_SESSION['username']; ?>
              </button>
            </div>
          <?php endif ?>

        </div>
      </div>
  </nav>
  <br><br><br>
  <br><br>
  <?php
  if ($insert) {
    echo "<div class='alert alert-success' role='alert'>
        Hostel added successfully!!!!!
      </div>";
  }
  ?>
  <div class="container">
    <section class="vh-450 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
              <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Hostel Registration Form</h3>
                <form method="POST">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label">Hostel Name</label>
                        <input type="text" name="Name" id="Name" class="form-control form-control-lg" />
                      </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4">

                      <h6 class="mb-2 pb-1">SEAT AVAILABILITY: </h6>

                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="seat" id="femaleGender" value="YES" checked />
                        <label class="form-check-label" for="YES">YES</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="seat" id="maleGender" value="NO" />
                        <label class="form-check-label" for="male">NO</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label for="room_type"><strong>CAPACITY</strong></label>
                    <div class="col-md-4 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="single">Single BED</label>
                        <input type="text" id="single" name="single" class="form-control form-control-lg" />
                      </div>

                    </div>
                    <div class="col-md-4 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="double_share">Double Share</label>
                        <input type="text" id="double_share" name="double_share" class="form-control form-control-lg" />

                      </div>


                    </div>
                    <div class="col-md-4 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="triple">Triple Share</label>
                        <input type="text" id="triple" name="triple" class="form-control form-control-lg" />

                      </div>


                    </div>
                  </div>
                  <div class="row">
                    <label for="room_type"><strong>FEES</strong></label>
                    <div class="col-md-4 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="fsingle">Single BED</label>
                        <input type="text" id="fsingle" name="fsingle" class="form-control form-control-lg" />
                      </div>

                    </div>
                    <div class="col-md-4 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="fdouble_share">Double Share</label>
                        <input type="text" id="fdouble_share" name="fdouble_share" class="form-control form-control-lg" />

                      </div>


                    </div>
                    <div class="col-md-4 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="ftriple">Triple Share</label>
                        <input type="text" id="ftriple" name="ftriple" class="form-control form-control-lg" />
                      </div>
                    </div>
                  </div>



                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                        <input type="text" id="phoneno" name="phoneno" class="form-control form-control-lg" />
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control form-control-lg" />

                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="county">County</label>
                        <input type="text" id="county" name="county" class="form-control form-control-lg" />
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <label class="form-label" for="pincode">PINCODE</label>
                        <input type="text" id="pincode" name="pincode" class="form-control form-control-lg" />
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <label class="form-label select-label"> Category</label>
                      <select class="select form-control-lg" name="category_id">
                        <option value="1" disabled>--Choose One--</option>
                        <option value="1">Category A</option>
                        <option value="2">Category B</option>
                        <option value="3">Category C</option>
                      </select>
                    </div>
                  </div>

                  <div class="mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg" name="submit">SEND</button>
                    <button type="reset" class="btn btn-primary btn-lg" name="submit">RESET</button>
                  </div>
                  <?php

                  $x = $_SESSION['username'];
                  $query1 = "SELECT * FROM owners WHERE username='$x'";
                  if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                  }
                  $data = mysqli_query($conn, $query1);
                  $result = mysqli_fetch_assoc($data);
                  $owner_id = $result['owner_id'];
                  if (isset($_POST['submit'])) {
                    $name = $_POST['Name'];
                    $category = $_POST['category_id'];
                    $phone = $_POST['phoneno'];
                    $seat = $_POST['seat'];
                    $city = $_POST['city'];
                    $county = $_POST['county'];
                    $pincode = $_POST['pincode'];
                    $c_single = $_POST['single'];
                    $c_double = $_POST['double_share'];
                    $c_triple = $_POST['triple'];
                    $f_single = $_POST['fsingle'];
                    $f_double = $_POST['fdouble_share'];
                    $f_triple = $_POST['ftriple'];

                    $query = "insert into hostels
    (owner_id,hostel_name,category_id,contact_no,seat_availability,city,county, pincode,cap_single,cap_double,cap_triple,charge_single,charge_double,charge_triple) 
    values ('$owner_id','$name','$category','$phone','$seat','$city','$county','$pincode','$c_single','$c_double','$c_triple','$f_single','$f_double','$f_triple')";

                    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    if ($run) {
                      $insert = true;
                    } else
                      $insert = false;
                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- footer -->
  <div class="container-fluid">
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
        <!-- Copyright -->
      </footer>
      <!-- Footer -->
    </div>
  </div>
  <!-- End of .container -->
  <!-- <footer class="footer">
    <div class="container">
      <span class="text-muted">Copyright © semester 3 Nielsen Norman Group, All Rights Reserved.</span>
    </div>
  </footer> -->
</body>

</html>