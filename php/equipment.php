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
                <a href="../index.php"></a>
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
    <!-- End Header -->

    <!-- Start Equipment Section -->
    <section class="equipment">
        <div class="container">
            <h2>Our Equipment</h2>
            <p class="title-p">Explore our state-of-the-art gym equipment designed to help you achieve your fitness goals.</p>
            <div class="content">
                <div class="box">
                    <img src="../images/bars.jpg" alt="Weights & Bars">
                    <h3>Weights & Bars</h3>
                    <ul>
                        <li>Dumbbells</li>
                        <li>Barbells</li>
                        <li>Weight Plates</li>
                        <li>Kettlebells</li>
                    </ul>
                </div>
                <div class="box">
                    <img src="../images/images.jpg" alt="Strength Machines">
                    <h3>Strength Machines</h3>
                    <ul>
                        <li>Leg Press</li>
                        <li>Chest Press</li>
                        <li>Lat Pulldown</li>
                        <li>Seated Row</li>
                    </ul>
                </div>
                <div class="box">
                    <img src="../images/conditioning.jpg" alt="Conditioning">
                    <h3>Conditioning</h3>
                    <ul>
                        <li>Bodyweight Training</li>
                        <li>Resistance Bands</li>
                        <li>Medicine Balls</li>
                        <li>Balance Boards</li>
                    </ul>
                </div>
                <div class="box">
                    <img src="../images/cardio.webp" alt="Cardio Equipment">
                    <h3>Cardio Equipment</h3>
                    <ul>
                        <li>Treadmills</li>
                        <li>Elliptical Machines</li>
                        <li>Rowing Machines</li>
                        <li>Exercise Bikes</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!-- End Equipment Section -->

    <!-- Start Footer -->
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
