<?php
session_start();
if( !isset( $_SESSION['logged'] ) ) {
echo '<script type="text/javascript">';
echo 'alert("Nu esti conectat! Vei fi redirectionat spre pagina de logare!");';
echo 'window.location = "login/login.php";';
echo '</script>';
}

 ?>
<!DOCTYPE html>
<html>


<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="animations.js"></script>
    <link rel="stylesheet" href="layout_stylesheet.css">
</head>


<body>

    <div id="mySidenav" class="sidenav">
        <img src="graphics/logo2.png">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="alink" href="index.php"><img src="graphics/home.png">Home</a>
        <a class="alink" href="#"><img src="graphics/bookmark.png">Bookmarked</a>
        <a class="alink" href="addcontent.php"><img src="graphics/add.png">Add Content</a>
        <a class="blink" href="#">Categories</a>
        <a class="blink" href="#">Layout</a>
        <a class="blink" href="#">Preferences</a>
        <a class="blink" href="#">Settings</a>
        <a class="alink" href="disconnect.php"><img src="graphics/logout.png">Disconnect</a>
    </div>



    <div id="main">
        <div id="topNav">
            <span onclick="openNav()">&#9776; </span>

            <a class="tlink" href="#=" onclick="location.reload(true); return false;"><img src="graphics/refresh.png"> </a>
            <a class="tlink" href="#"><img src="graphics/layout.png"> </a>
            <a class="tlink" href="#"><img src="graphics/search.png"></a>
            <input type="text" placeholder="Search for articles.."><br>
        </div>

        <div id="news">



            <div class="header">
                <h1>Latest News</h1>
            </div>

            <!-- Photo Grid -->
            <div class="row">
                <div class="column">

                    <div class="article">
                        <img src="graphics/rb.gif" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>Antique building crashed after plane landed on it</strong></h4>
                            <p><i>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/d.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>GOOGLE'S HUGE UPDATE FOR GOOGLE IMAGES</strong></h4>
                            <p><i>"CEO of ABC announces huge changes for the entire Google company..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/g.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>CHEAP VACATIONS ARE NOW HUNTED</strong></h4>
                            <p><i>"Hurry up and get your plane ticket, because you'll regret it later, says AirplaneThatFlies Company ..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/c.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>SPRING AGAIN</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/g.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KINd</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="article">
                        <img src="graphics/h.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>THIS BIRD CAN SING? PEOPLE ASK</strong></h4>
                            <p><i>"Neque che io scrir achire..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/e.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>IF YOU SEE THIS ANIMAL, YOU BETTER RUN FOR HIS LIFE</strong></h4>
                            <p><i>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/f.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>BEST SPACE PHOTOS YOU'LL EVER SEE</strong></h4>
                            <p><i>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/g.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KINd</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/d.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KINd</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>

                </div>


                <div class="column">
                    <div class="article">
                        <img src="graphics/d.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KING</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/g.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>Game Developed By Romanian Team HexaCoin Rocks</strong></h4>
                            <p><i>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/rb.png" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>Game Developed By Romanian Team HexaCoin Rocks</strong></h4>
                            <p><i>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/rb.png" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>Game Developed By Romanian Team HexaCoin Rocks</strong></h4>
                            <p><i>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/g.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KINd</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/D.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KINd</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="article">
                        <img src="graphics/c.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>With spring coming, the winter is now almost over.</strong></h4>
                            <p><i>"A spring specialist talks about what danger comes once with the spring, but also, talks about flowers..."</i></p>
                        </div>
                    </div>

                    <div class="article">
                        <img src="graphics/rb.png" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>Game Developed By Romanian Team HexaCoin Rocks</strong></h4>
                            <p><i>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/b.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KING</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/g.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KINd</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                    <div class="article">
                        <img src="graphics/g.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left"><img src="graphics/bookmark.png"> </div>
                        <div class="top-right"><button class="readBtn"><b>READ</b></button></div>
                        <div class="bottom">
                            <h4 id="title"><strong>dAMN CAT TURNS AGAINST IT'S OWN KINd</strong></h4>
                            <p><i>"Weow, weeeeow, weoooow..."</i></p>
                        </div>
                    </div>
                </div>

            </div>



        </div>

    </div>

</body>

</html>
