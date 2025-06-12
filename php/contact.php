<?php
session_start();

// Inclui functions.php com base na localização do arquivo atual
include_once('../functions/functions.php');

// Conexão com o banco de dados
$dbConnect = dbLink();



// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Section - Fitness Club</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Start Header -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="../index.php">
                  <img src="../images/logo.webp" alt="panabianco" style="max-height: 50px;">
                </a>
            </div> 
            <a href="javascript:void(0)" class="ham-burger">
                <span></span>
                <span></span>
            </a>
            <nav class="nav">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="classes.php">Classes</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="equipment.php" class="active">Equipment</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php navigation(); ?>
                </ul>
            </nav>
        </div>
    </header>

    <section class="contact" id="contact">
        <div class="container">
           <div class="content">
               <div class="box form wow slideInLeft">
                  <form>
                     <input type="text" placeholder="Enter Name">
                     <input type="text" placeholder="Enter Email">
                     <input type="text" placeholder="Enter Mobile">
                     <textarea placeholder="Enter Message"></textarea>
                     <button type="submit">Send Message</button>
                  </form>
               </div>
               <div class="box text wow slideInRight">
                    <h2>Get Connected with Gym</h2>
                     <p class="title-p">
                        Our gym is dedicated to providing you with exceptional service and support. Whether you have questions about membership, classes, or equipment, we're here to help you achieve your fitness goals.
                     </p>
                     <div class="info">
                         <ul>
                             <li><span class="fa fa-map-marker"></span> Gali no 11, House no 11, Lahore</li>
                             <li><span class="fa fa-phone"></span> 92 9999999999</li>
                             <li><span class="fa fa-envelope"></span> info@gym.com</li>
                         </ul>
                     </div>
                     <div class="social">
                          <a href=""><span class="fa fa-facebook"></span></a>
                          <a href=""><span class="fa fa-linkedin"></span></a>
                          <a href=""><span class="fa fa-skype"></span></a>
                          <a href=""><span class="fa fa-youtube-play"></span></a>
                     </div>
   
                     <div class="copy">
                         PowerBy &copy; Ali Ahmad
                     </div>
               </div>
           </div>
        </div>
     </section>

    <footer>
        <div class="container">
            <p>Fitness Club © 2024. All rights reserved.</p>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".ham-burger, .nav ul li a").click(function(){
                $(".nav").toggleClass("open");
                $(".ham-burger").toggleClass("active");
            });
        });
    </script>
</body>
</html>
