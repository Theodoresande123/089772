<?php
session_start();
// error_reporting(0);

include_once("../connection.php");

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    die(header("location: index.php"));
}

if (!isset($_SESSION['loggin']))
    die(header("Location: ../index.php?msg='You must log in first'"));

$login = $_SESSION['loggin'];
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

    <link rel="stylesheet" href="../style.css">
    <style>
        .lbl {
            color: chartreuse;
        }

        #mailModal {
            position: fixed;
            top: 0;
            padding: 20px;
            margin-left: 25%;
            margin-top: 5%;
            width: 30%;
            border-radius: 5px;
        }

        .font-50px a {
            font-size: 25px;
        }

        .x {
            position: relative;
            margin-left: 20px;
            margin-right: 20px;
        }
    </style>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>Supervisor Panel</title>
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
                <a class="navbar-brand" href="/project/index.php">
                    HOSTEL WORLD
                    <span style="color:red;">(ADMIN)</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="hostels.php">Hostels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="partners.php">Partners</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="queries.php">Queries</a>
                        </li>
                        <?php if ($login) : ?>
                            <li class='nav-item'>
                                <a class='nav-link' href="../logout.php">LOGOUT</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="d-flex">
                        <?php
                        if (!$login) : ?><a class="navbar-brand" href="login.php">
                                <img src="https://img.icons8.com/color/48/000000/user.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                                User Login
                            </a>
                            <a class="navbar-brand" href="admin_login.php">
                                <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-admin-network-technology-itim2101-lineal-color-itim2101-1.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                                Partner Login
                            </a>
                            <a class="navbar-brand" href="supervisor/supervisor_login.php" style="background-color:chartreuse;color:brown;font-weight:900;border-radius:2px;padding-right:3px;">
                                <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-admin-network-technology-itim2101-lineal-color-itim2101-1.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                                Admin Login
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
            </div>
        </nav>

    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="container bg-dark text-white">
        <h3>Queries</h3>
    </div>
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Query ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "select * from queries;";

                $data = mysqli_query($conn, $query);

                $total = mysqli_num_rows($data);


                if ($total != 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                        $id = $result['query_id'];
                        echo "
                            <tr>
                            <td>" . $result['query_id'] . "</td>
                            <td>" . $result['full_name'] . "</td>
                            <td>" . $result['email'] . "</td>
                            <td class='omit' style='color:blue;font-weight:bold;'>" .
                            str_split($result['phone'], 6)[0] . "XXX" .
                            "</td>
                            <td>" . $result['subject'] . "</td>
                            <td>" . $result['message'] . "</td>
                            <td>
                            <button type='button' id='$id' class='btn btn-primary replyBtn'>Reply</button>
                            </td>
                            </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="bg-dark text-white" id="mailModal" hidden>
            <form action="" method="post">
                <div class="d-flex justify-content-between">
                    <h4 style="color:#783;">Reply to query</h4>
                    <button type="button" class="btn btn-danger" id="closemodal">
                        X
                    </button>
                </div>
                <div class="form-group">
                    <label class="lbl">Name:</label>
                    <label id="uname"></label>
                </div>
                <div class="form-group">
                    <label class="lbl">Email:</label>
                    <label id="email"></label>
                </div>
                <div class="form-group">
                    <label class="lbl">Subject:</label>
                    <label id="subject"></label>
                    <div id="hidden" hidden></div>
                </div>
                <div class="form-group">
                    <div>
                        <label class="lbl" style="color:cyan;float:right;">
                            QUERY
                        </label>
                        <br>
                    </div>
                    <label id="query"></label>
                </div><br>
                <div class="form-group">
                    <label class="lbl" for="message">
                        Compose message
                    </label>
                    <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                </div><br>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" id="send">Send</button>
                </div>
            </form>
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
                                <a href="about.php" class="text-white">About us</a>
                            </h6>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2">
                            <h6 class="text-uppercase font-weight-bold">
                                <a href="hostels.php" class="text-white">Hostels</a>
                            </h6>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2">
                            <h6 class="text-uppercase font-weight-bold">
                                <a href="queries.php" class="text-white">Review</a>
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
    <!-- Javascripts -->
    <script>
        const name = document.querySelector("#uname")
        const email = document.getElementById("email")
        const subject = document.getElementById("subject")
        const query = document.getElementById("query")
        const hidden = document.getElementById("hidden")

        const reply = document.getElementById("message")
        const mailReplyBtn = document.getElementById("send")

        const inputs = [name, email, hidden, subject, query]

        var replyBtns = document.querySelectorAll(".replyBtn");

        const mailModal = document.getElementById("mailModal")
        const modalBtn = document.getElementById("closemodal")

        modalBtn.addEventListener('click', () => {
            closeModal()
        })
        replyBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                mailModal.hidden = false
                let temp = Array.from(btn.parentNode.parentNode.children)
                temp.shift()
                temp.pop()
                for (let x = 0; x < inputs.length; x++) {
                    inputs[x].innerHTML = temp[x].innerHTML
                }
            })
        })
        mailReplyBtn.addEventListener('click', () => {
            var data = new FormData
            data.append('sender', name.innerHTML)
            data.append('email', email.innerHTML)
            data.append('subject', subject.innerHTML)
            data.append('query', query.innerHTML)
            data.append('message', reply.value)

            //send form to mail service
            fetch("./message.php", {
                    method: "POST",
                    body: data
                }).then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error(error);
                });
            reply.value = ''
            closeModal()
        })

        function closeModal() {
            mailModal.hidden = true
        }
    </script>
    <!-- End of Javascripts -->
</body>

</html>