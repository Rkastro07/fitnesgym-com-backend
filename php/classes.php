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

    <section class="classes" id="classes">
        <div class="container">
             <div class="content">
                   <div class="box img wow slideInLeft">
                        <img src="../images/img/modalidade-cardio.png" alt="classes" />
                   </div>
                   <div class="box text wow slideInRight">
                        <h2>Our Classes</h2>
                        <p>Discover our diverse range of classes designed to help you achieve your fitness goals. From high-intensity workouts to calming yoga sessions, we offer programs that cater to all fitness levels and preferences.</p>
                       <div class="class-items">
                        <div class="item wow bounceInUp">
                         <div class="item-img">
                              <img src="../images/img/modalidade-fitdance.png" alt="classes" />
                              <div class="price">
                                   $99
                              </div>
                         </div>
                         <div class="item-text">
                               <h4>Stretching Training</h4>
                               <p>Enhance flexibility and reduce muscle tension with our guided stretching exercises designed for all levels.</p>
                               <a href="">Get Details</a>
                         </div>
                        </div>
                        <div class="item wow bounceInUp">
                         <div class="item-text">
                               <h4>Strength & Conditioning</h4>
                               <p>Build muscle, improve endurance, and boost overall fitness through our comprehensive strength and conditioning program.</p>
                               <a href="">Get Details</a>
                         </div>
                         <div class="item-img">
                              <img src="../images/class1.jpg" alt="classes" />
                              <div class="price">
                                   $99
                              </div>
                         </div>
                        </div>
                       </div>
                   </div>
             </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>Panabianco © 2024. All rights reserved.</p>
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
