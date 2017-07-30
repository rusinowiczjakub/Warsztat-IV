<?php
require_once __DIR__."/../src/Group.php";
require __DIR__."/../connection.php";

?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Shop</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?page=items">All Items</a></li>
                        <?php echo Groups::showGroups($conn)?>
                    </ul>
                </li>
            </ul>

            <?php

            echo '<ul class="nav navbar-nav" style="float:right">
                <li><a href="">Sign Up</a></li><li><a href="">Log In</a></li>
            </ul>';

            ?>
<!--IF SESSION SET-->
<!--            --><?php
//            echo '<ul class="nav navbar-nav" style="float:right">
//                <li><a href="">Log Out</a></li>
//            </ul>';
//            ?>
        </div>
    </div>
</nav>