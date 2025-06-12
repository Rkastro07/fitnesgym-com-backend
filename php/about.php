<?php
session_start();

// Inclui functions.php com base na localização do arquivo atual
include_once('../functions/functions.php');

// Conexão com o banco de dados
$dbConnect = dbLink();


// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $basePath . "index.php");
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

    <section class="about" id="about">
        <div class="container">
            <div class="content">
                <div class="box wow bounceInUp">
                    <div class="inner">
                        <div class="img">
                            <img src="../images/about1.jpg" alt="about" />
                        </div>
                        <div class="text">
                            <h4>Free Consultation</h4>
                            <p>
                                Our free consultation service ensures that you receive expert guidance tailored to your fitness goals. Our professional trainers assess your needs and design a personalized workout and nutrition plan to kick-start your journey.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box wow bounceInUp" data-wow-delay="0.2s">
                    <div class="inner">
                        <div class="img">
                            <img src="../images/about2.jpg" alt="about" />
                        </div>
                        <div class="text">
                            <h4>Best Training</h4>
                            <p>
                                Experience top-notch training sessions led by certified coaches who are passionate about helping you succeed. Our programs incorporate the latest fitness techniques to maximize your results and overall well-being.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box wow bounceInUp" data-wow-delay="0.4s">
                    <div class="inner">
                        <div class="img">
                            <img src="../images/about3.jpg" alt="about" />
                        </div>
                        <div class="text">
                            <h4>Build Perfect Body</h4>
                            <p>
                                Our comprehensive approach combines strength training, cardio, and nutrition advice to help you build the perfect body. With support from our expert team and cutting-edge equipment, your fitness transformation is within reach.
                            </p>
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
