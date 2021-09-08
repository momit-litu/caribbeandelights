<?php
include 'views/layout/common_php.php';
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <?php
    include 'views/layout/header_files.php';
    ?>
</head>

<body>
<?php
include 'views/layout/pre_load.php';
?>
<script>
    customer_id=<?php echo $customer_id;?>
</script>
<div class="wrapper">
    <!-- Start Header -->
    <?php
    include 'views/layout/header.php';
    ?>
    <!-- End Header -->
    <!-- Start Main -->
    <?php
    include 'views/layout/auth_modal.php';
    ?>

    <!-- Start Main -->
    <div class="main-part" id="content" style="min-height: 600px;" >

        <section class="breadcrumb-part" data-stellar-offset-parent="true" data-stellar-background-ratio="0.5" style="background-image: url('./images/breadbg1.jpg');max-height: 220px">
            <div class="container">
                <div class="breadcrumb-inner">
                    <h2>CATERING SERVICE</h2>
                    <a href="index.php">Home</a>
                    <span>Catering Service</span>
                </div>
            </div>
        </section>
        <section class="term-condition home-icon">
            <div class="icon-default">
                <img src="./images/scroll-arrow.png" alt="">
            </div>
            <div class="container">
                <h3>Karibbean Delight Offers</h3>
                <ul>
                    <li style="font-size: 16px">
                        <i class="material-icons" style="font-size:20px; color: #FBAD50">restaurant</i>
                        <b >Package #1, Perfect Platters, $19 / person:</b><br>
                        Buffet style, make your own platter: Carne - Pollo Asada, choice of beans, Mexican rice, pico de gallo, tortillas, chips, lettuce, guacamole, sour cream, cilantro, picante, roast tomatoes, salsa verde, corn.
                    </li>
                    <br>
                    <li>
                        <i class="material-icons" style="font-size:20px; color: #FBAD50">restaurant</i>
                        <b>Pack #2, Taco Twister, $20 / person</b><br>
                        Buffet style, make your own taco salad: edible baked taco salad shells, chips, beans, Mexican rice, grilled chicken, grilled steak, ground beef, lettuce, pico de gallo, cheese, sour cream, guacamole, and chips.
                    </li>
                    <br>

                    <li>
                        <i class="material-icons" style="font-size:20px; color: #FBAD50">restaurant</i>
                        <b>Pack #3, Crunch King, $19 / person</b><br>
                        Create your own Tacos, buffet style: hard and soft taco shells, ground beef, grilled chicken, steak, cheese, lettuce, pico de gallo, guacamole, sour cream, and chips.
                    </li>
                    <br>

                    <li>
                        <i class="material-icons" style="font-size:20px; color: #FBAD50">restaurant</i>
                        <b>Pack #4, Burrito Beast, $18 / person</b><br>
                        Burritos served buffet style: veggies and choice of meats (chicken, steak, carnitas) individually wrapped. Guacamole, sour cream, chips, and salsa.
                    </li>
                    <br>

                    <li>
                        <i class="material-icons" style="font-size:20px; color: #FBAD50">restaurant</i>
                        <b>Pack #5, Fabulous Fajitas, $19 / person</b><br>
                        Fajitas, buffet style: peppers, onions, lettuce, cheese, salsa, chips, guacamole, sour cream, tortillas, grilled chicken, steak, and beans for the vegetarians.
                    </li>

                </ul>
            </div>
        </section>

    </div>

    <!-- End Main -->
    <!-- Start Footer -->
    <?php
    include 'views/layout/footer.php';
    ?>
    <!-- End Footer -->

    <?php
    include 'views/layout/open_time_modal.php';
    ?>
</div>
<!-- Back To Top Arrow -->
<a href="#" class="top-arrow"></a>
</body>


<!-- Mirrored from laboom.sk-web-solutions.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Sep 2018 06:20:20 GMT -->
</html>


<?php
include 'views/layout/footer_files.php';
?>

<script>

    showCart()

</script>




