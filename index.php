<?php
require_once('./util/autoloader.php');
require_once('./layout/header.php');

?>
    <div class="container body-content">

        <br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class=""></li>
                <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item">
                    <img src="/image/banner05.png" alt="campus1" style="width: 100%">
                </div>

                <div class="item active">
                    <img src="/image/banner07.png" alt="campus2" style="width: 100%">
                </div>

                <div class="item">
                    <img src="/image/banner08.png" alt="campus3" style="width: 100%">

                </div>

                <div class="item">
                    <img src="/image/banner06.png" alt="campus4" style="width: 100%">

                </div>


            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <br><br>

        <div class="row mid-row">
            <div class="col-md-4">
                <h2>Quality Bags</h2>
                <p>
                    Welcome to Quality Bags
                </p>
                <p><a class="btn btn-default" href="/Bags.php.php">See New Bags »</a></p>
            </div>
            <div class="col-md-4">
                <h2>New In</h2>
                <p>New Bags this Autumn</p>
                <p><a class="btn btn-default" href="/Bags.php">See New Bags »</a></p>
            </div>
            <div class="col-md-4">
                <h2>Sales</h2>
                <p>Lowest Bags in Quality Bags</p>
                <p><a class="btn btn-default" href="/Bags.php">See Sales »</a></p>
            </div>
        </div>

        <br><br>

        <div>
            <a href="/Bags.php">
                <img src="/image/hopa5.png" alt="new in " style="width: 100%">
            </a>
        </div>
        <div>
            <a href="/Bags.php">
                <img src="/image/hopa2.png" alt="new in " style="width: 100%">
            </a>
        </div>
        <div>
            <a href="/Bags.php">
                <img src="/image/hopa4.png" alt="new in " style="width: 100%">
            </a>
        </div>
        <div>
            <a href="/Bags.php">
                <img src="/image/hopa3.png" alt="new in " style="width: 100%">
            </a>
        </div>
        <div>
            <a href="/Bags.php">
                <img src="/image/hopa5.png" alt="new in " style="width: 100%">
            </a>
        </div>



    </div>
<?php
require_once('./layout/footer.php');