<nav class="navbar navbar-default navbar-fixed-top header" style="margin-bottom:1000px;">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand">WillMill_updated</a></div>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".mynavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                <div class="collapse navbar-collapse mynavbar" >

                     <?php
                    if (isset($_SESSION['email'])) {  ?> 
                    <ul class="nav navbar-nav navbar-right">
                        <li> <div class="search-box">
                                  <input type="text" placeholder="Search" style="margin-top: 10px" class="form-control">
                                  <div class="result" style="position: absolute;background-color: white;border: 1px;box-shadow: 5px 10px 18px burlywood; width:197px;"></div>
                            </div> </li>

                            <li><a href="index.php">Home</a></li>
                            <li><a href="profile.php"><span class="glyphicon glyphicon-list-alt"></span>Portfolio</a></li>
                        <li><a href="people.php"><span class="glyphicon glyphicon-user"></span>people</a></li>
                        <li><a href="chat.php?profile_id=<?php echo "$profile_id"?>;"><span class="glyphicon glyphicon-envelope"></span>Message</a></li>

                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span><span class="glyphicon glyphicon-globe"></span>Notification</a>
                        <ul class="dropdown-menu"></ul>
                        
                        </li>

                        <li class="dropdown">
                            <a href="logout.php">Log out</a>
                         </li>

                     </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>
