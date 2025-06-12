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

    <section class="service" id="service">
        <div class="container">
             <div class="content">
                   <div class="text box wow slideInLeft">
                     <h2>Services</h2>
                     <p>Our fitness club offers a wide range of services designed to meet your health and wellness needs. From personalized training sessions to advanced fitness programs, we aim to provide the best experience for our members.</p>
                     <p>We focus on creating a supportive environment where you can achieve your fitness goals. Our expert trainers and state-of-the-art equipment are here to guide you every step of the way.</p>
                     <a href="" class="btn">Start Now</a>
                   </div>
                   <div class="accordian box wow slideInRight">
                           <div class="accordian-container active">
                               <div class="head">
                                   <h4>Cardiovascular Equipment</h4>
                                   <span class="fa fa-angle-down"></span>
                               </div>
                               <div class="body">
                                   <p>Explore our cutting-edge cardiovascular equipment that helps improve heart health and endurance. Our machines are regularly updated and maintained to provide the best workout experience.</p>
                               </div>
                           </div>
                           <div class="accordian-container">
                               <div class="head">
                                   <h4>Strength Training Equipment</h4>
                                   <span class="fa fa-angle-up"></span>
                               </div>
                               <div class="body">
                                   <p>Our strength training equipment is robust and designed for all fitness levels, enabling you to safely build muscle and enhance strength with the latest technology.</p>
                               </div>
                           </div>
                           <div class="accordian-container">
                               <div class="head">
                                   <h4>Group Fitness Class</h4>
                                   <span class="fa fa-angle-up"></span>
                               </div>
                               <div class="body">
                                   <p>Participate in our group fitness classes led by certified instructors. Experience a motivating community atmosphere and diverse workout routines that keep you engaged and challenged.</p>
                               </div>
                           </div>
                           <div class="accordian-container">
                               <div class="head">
                                   <h4>Other Services</h4>
                                   <span class="fa fa-angle-up"></span>
                               </div>
                               <div class="body">
                                   <p>We offer additional services including nutritional counseling, wellness workshops, and personalized fitness plans to complement your training and help you achieve a balanced lifestyle.</p>
                               </div>
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
