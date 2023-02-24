<?php
@include "conn.php";
@include "userconnect.php";
// include the necessary PHPMailer files
require 'includes/phpmailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// create a new PHPMailer instance
$mail = new PHPMailer();

// configure the SMTP settings
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->Username = "crustandrolls@gmail.com"; // your email address
$mail->Password = "dqriavmkaochvtod"; // your email password

// set the email subject and body
$mail->Subject = "Confirmation of Order from Crust and Rolls";


// retrieve the email from the database
// replace the database credentials with your own
$host = "localhost";
$username = "root";
$password = "";
$database = "try_db";

// create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// retrieve the ID from the GET parameters
$id = $_GET['id'];

if (!isset($id) || empty($id)) {
    echo "Error: Invalid ID.";
} else {
    $sql = "SELECT `email`, `name`, `total_products`, `id`, `number`,  `address`   FROM `orders` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $name = $row['name'];
        $total_products = $row['total_products'];
        $id = $row['id'];
        $address = $row['address'];
        $number = $row['number'];


        // set the recipient email address
        $mail->addAddress($email);

        // set the email subject and body
        $mail->Subject = "Order Confirmation";
        $mail->Body = "Hi! " .$name. ",\n\nWe have received your order in Crust and rolls and is currently being processed. 
                                       \n\n\n\n ORDER ID: ".$id."
                                       \n Reply YES in this E-mail if all the information below is correct and we will proceed with your orders. Please confirm the following:
                                       \n Your address is: ".$address."
                                       \n Your Phone Number is: ".$number."
                                       \n\n Orders: ".$total_products."
                                       \n  To ensure a smooth transaction, make sure that your information you provided is accurate. 
                                       \n\n  Crust and rolls is committed to ensure that you receive the highest quality products and services.
                                       \n\n  If you have any further questions or concerns regarding your order, please do not hesitate to reach out to our customer service team at Crustandrolls@gmail.com
                                        \n\n Thank you for choosing Crust and Rolls. We appreciate your interest to try our product, we are looking forward to serve you again soon!";

        // send the email
        if ($mail->send()) {
            echo "Email Sent..";
        } else {
            echo "Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: Email not found.";
    }

    mysqli_free_result($result);
}

mysqli_close($conn);


