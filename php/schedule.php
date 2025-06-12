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

    <section class="schedule" id="schedule">
        <div class="container">
              <div class="content">
                     <div class="box text wow slideInLeft">
                            <h2>Classes Schedule</h2>
                            <p>
                                Our weekly class schedule offers a variety of sessions to help you meet your fitness goals. Whether you're focused on strength training, cardio, or flexibility, our timetable is designed to accommodate diverse fitness levels and preferences. Plan your week effectively by checking the class times, types, and room assignments below.
                            </p>
                            <img src="../images/schedule1.png" alt="schedule" />
                     </div>
                     <div class="box timing wow slideInRight">
                    <table class="table">
                         <tbody>
                             <tr>
                                 <td class="day">Monday</td>
                                 <td><strong>9:00 AM</strong></td>
                                 <td>Body Building <br/> 9:00 to 10:00 AM</td>
                                 <td>Room No:210</td>
                             </tr>
                             <tr>
                                 <td class="day">Tuesday</td>
                                 <td><strong>9:00 AM</strong></td>
                                 <td>Body Building <br/> 9:00 to 10:00 AM</td>
                                 <td>Room No:210</td>
                             </tr>
                             <tr>
                                 <td class="day">Wednesday</td>
                                 <td><strong>9:00 AM</strong></td>
                                 <td>Body Building <br/> 9:00 to 10:00 AM</td>
                                 <td>Room No:210</td>
                             </tr>
                             <tr>
                                 <td class="day">Thursday</td>
                                 <td><strong>9:00 AM</strong></td>
                                 <td>Body Building <br/> 9:00 to 10:00 AM</td>
                                 <td>Room No:210</td>
                             </tr>
                             <tr>
                                 <td class="day">Friday</td>
                                 <td><strong>9:00 AM</strong></td>
                                 <td>Body Building <br/> 9:00 to 10:00 AM</td>
                                 <td>Room No:210</td>
                             </tr>
                             <tr>
                                 <td class="day">Saturday</td>
                                 <td><strong>9:00 AM</strong></td>
                                 <td>Body Building <br/> 9:00 to 10:00 AM</td>
                                 <td>Room No:210</td>
                             </tr>
                         </tbody>
                    </table>
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
