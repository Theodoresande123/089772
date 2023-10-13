<?php
include 'connection.php';
if (isset($_POST['bycategory'])) {
    //   $name=$_POST['name'];
    //   $phone=$_POST['phone'];
    //   $email=$_POST['email'];
    //   $subject=$_POST['subject'];
    //   $message=$_POST['message'];

    $query = " SELECT * FROM `hostel`  WHERE hostel_id=1";

    $result = mysqli_query($conn, $query);

    // Find the number of records returned
    $num = mysqli_num_rows($result);
    echo $num . " records found in the DataBase<br>";
    if ($num > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['sno'] .  ". Hello " . $row['name'] . " Welcome to " . $row['dest']. "<br>";
        }
    }
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if ($run)
        echo " Message sent successfully!!!!";
    else
        echo " Message not sent!!!!!";
}
