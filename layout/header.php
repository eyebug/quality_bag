<!DOCTYPE html>
<!-- saved from url=(0051)http://dochyper.unitec.ac.nz/chenc75/asp_assignment -->
<html class="gr__dochyper_unitec_ac_nz">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Quality Bags</title>


    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <meta name="x-stylesheet-fallback-test" content="" class="sr-only">
    <script>!function (a, b, c) {
            var d, e = document, f = e.getElementsByTagName("SCRIPT"), g = f[f.length - 1].previousElementSibling, h = e.defaultView && e.defaultView.getComputedStyle ? e.defaultView.getComputedStyle(g) : g.currentStyle;
            if (h && h[a] !== b)for (d = 0; d < c.length; d++)e.write('<link rel="stylesheet" href="' + c[d] + '"/>')
        }("position", "absolute", ["\/css\/bootstrap.min.css"]);</script>
    <link rel="stylesheet" href="../css/site.min.css">
    <link rel="stylesheet" href="../css/navcss.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">


</head>
<?php
$session = Session::getSession();
?>
<body data-gr-c-s-loaded="true">
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/index.php">
                <img src="/image/logo-brand.png" alt="Quality Bags" style="width:200px;height:70px;">
            </a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse">

            <?php if (!isset($_SESSION['id'])) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/Account/Register.php">Register</a></li>
                    <li><a href="/Account/Login.php">Log in</a></li>
                </ul>
            <?php } elseif (isset($_SESSION['role']) && $_SESSION['role'] == Session::ROLE_ADMIN) { ?>

            <?php } else { ?>
                <form method="post" id="logoutForm" class="navbar-right" action="/Account/LogOff.php">
                    <ul class="nav navbar-nav navbar-right narbar-nomargin">
                        <li class="dropdown">
                            <a title="Manage" href="/Manage.php">Hello <?php echo $_SESSION['email'];?>!</a>
                            <ul class="dropdown-menu nardropcolor">
                                <li><a href="/Orders.php">Orders</a></li>
                            </ul>
                        </li>
                        <li>
                            <button type="submit" class="btn btn-link navbar-btn navbar-link">Log off</button>
                        </li>
                    </ul>
            <?php } ?>


            <div>
                <ul class="nav navlayout">
                    <li class="navItem"><a href="/index.php">Home</a></li>
                    <li class="navItem"><a href="/DeleteSessionInBagView.php">Bags</a></li>
                    <li class="navItem"><a href="/About.php">About Us</a></li>
                    <li class="navItem"><a href="/Contact.php">Contact Us</a></li>
                    <li class="navItem"><a href="/ShoppingCart.php">My Cart<span id="cart-amount" class="badge">0</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>