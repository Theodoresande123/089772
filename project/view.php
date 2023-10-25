<?php
session_start();
include_once("../connection.php");
// if (!isset($_SESSION['username'])) {
// 	$_SESSION['msg'] = "You must log in first";
// 	header('location: login.php');
// }
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: ../login.php");
}

if(!isset($_SESSION['loggin']))
  die(header("location: ../login.php?msg='You must log in first!'"));

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

    .cash-font {
      color: green;
      font-weight: bolder;
    }
  </style>

  <title>HOSTEL WORLD</title>
</head>

<body>
  <!-- navigation bar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark n">
    <div class="container-fluid">
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
            <a class="nav-link active" aria-current="page" href="/project/hostels.php">Hostel</a>
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
          if ($login) : ?>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href="../index.php?logout='1'">LOGOUT</a>
            </li>
          <?php endif; ?>
        </ul>
        <div class="d-flex">
          <?php
          if (!$login) : ?>
            <a class="navbar-brand" href="login.php">
              <img src="https://img.icons8.com/color/48/000000/user.png" alt="" width="30" height="24" class="d-inline-block align-text-top">User Login

            </a>
            
            <a class="navbar-brand" href="admin_login.php">
              <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-admin-network-technology-itim2101-lineal-color-itim2101-1.png" alt="" width="30" height="24" class="d-inline-block align-text-top">Admin
              Login
            </a>

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
  </nav>
  <br><br><br>
  <div class="container">
    <ul class="nav nav-pills mb-3 col-md-offset-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Hostel Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Charges structure</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Owner details</a>
      </li>
      <li class="nav-item">
        <?php
        $id = $_GET['id'];
        echo "<a class='nav-link' href='reserve.php?id=$id'>Reservation Form</a>";
        ?>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <h2>Hostel Profile</h2>
        <hr>
        <div class="container">
          <table class="table table-hover">
            <tbody>
              <?php
              $id = $_GET['id'];
              $query = "select * from hostels where hostel_id = $id";

              $data = mysqli_query($conn, $query);
              $result = mysqli_fetch_assoc($data);

              echo "
              <tr><td><label><strong>HOSTEL ID</strong></label></td><td>" . $result['hostel_id'] . "</td></tr>
              <tr><td><label><strong>HOSTEL NAME<strong></label></td><td>" . $result['hostel_name'] . "</td></tr>
              <tr><td><label><strong>HOSTEL CONTACT NUMBER<strong></label></td><td>" . $result['contact_no'] . "</td></tr>
              <tr><td><label><strong>CITY<strong></label></td><td>" . $result['city'] . "</td></tr>
              <tr><td><label><strong>COUNTY<strong></label></td><td>" . $result['county'] . "</td></tr>
              <tr><td><label><strong>PINCODE<strong></label></td><td>" . $result['pincode'] . "</td></tr>
              <tr><td><label><strong>SEAT AVAILABILITY<strong></label></td><td>" . $result['seat_availability'] . "</td></tr>";

              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <h2>Charges structure</h2>
        <div class="container">
          <table class="table table-hover">
            <tbody>
              <?php
              $id = $_GET['id'];
              $query = "select * from hostels where hostel_id = $id";
              $data = mysqli_query($conn, $query);
              $result = mysqli_fetch_assoc($data);

              echo "
              <tr><td><label><strong>HOSTEL ID</strong></label></td><td>" . $result['hostel_id'] . "</td></tr>
              <tr><td><label><strong>HOSTEL NAME</strong></label></td><td>" . $result['hostel_name'] . "</td></tr>
              <tr><td><label><strong>SINGLE BED<strong></label></td><td>KES 
              <span class='cash-font'>" . number_format($result['charge_single'], 2, ".", ",") .
                "</span> /= MONTH ONLY</td></tr>
              <tr><td><label><strong>DOUBLE SHARE<strong></label></td><td>KES  
              <span class='cash-font'>" . number_format($result['charge_double'], 2, ".", ",") .
                "</span> /= MONTH ONLY</td></tr>
              <tr><td><label><strong>TRIPLE SHARE<strong></label></td><td>KES  
              <span class='cash-font'>" . number_format($result['charge_triple'], 2, ".", ",") .
                "</span> /= MONTH ONLY</td></tr>";

              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <h2>Owners Details</h2>
        <hr>
        <div class="container">
          <table class="table table-hover">
            <tbody>
              <?php
              $id = $_GET['id'];
              $query = "select * from owners where owner_id =(SELECT owner_id from hostels where hostel_id =$id)";

              $data = mysqli_query($conn, $query);
              $result = mysqli_fetch_assoc($data);

              echo "
              <tr><td><label><strong>Owner Name</strong></label></td><td>" . $result['name'] . "</td></tr>
              <tr><td><label><strong>Phone Number<strong></label></td><td>" . $result['phoneno'] . "</td></tr>
              <tr><td><label><strong>Email<strong></label></td><td>" . $result['email'] . "</td></tr>";

              ?>
            </tbody>
          </table>
        </div>

      </div>
      <div class="tab-pane fade" id="pills-form" role="tabpanel" aria-labelledby="pills-form-tab">
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
  <!-- End of .container -->
  <!-- <footer class="footer">
    <div class="container">
      <span class="text-muted">Copyright © semester 3 Nielsen Norman Group, All Rights Reserved.</span>
    </div>
  </footer> -->
</body>

</html>