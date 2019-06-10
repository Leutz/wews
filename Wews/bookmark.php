<!DOCTYPE html>
<html>


<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="animations.js"></script>
    <link rel="stylesheet" href="layout_stylesheet.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>


<body>

    <div id="mySidenav" class="sidenav">
        <img src="graphics/logo2.png">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="alink" href="index.php"><img src="graphics/home.png">Home</a>
        <a class="alink" href="bookmark.php"><img src="graphics/bookmark.png">Bookmarks</a>
        <a class="alink" href="addcontent.php"><img src="graphics/add.png">Add Content</a>
        <a class="alink" onclick="myAccFunc()"><img src="graphics/add.png"> Follows </a>
             <div id="demoAcc" class="w3-hide">
               <?php
               session_start();
               if (isset($_SESSION['allfeeds']))
               {
               foreach($_SESSION['allfeeds'] as $userfeeds){
                 list(,$var,) = explode('//', $userfeeds);
                 list($var,) = explode('/', $var);
                 ?>
                    <a href="getfeed.php?caller=<?= $var ?>" class="blink"><?= $var ?></a>
                  <?php
                }}
                else {
                  echo "Sesiunea allfeeds nu exista";
                }
                ?>
             </div>
        <a class="alink" href="settings.php"><img src="graphics/settings.png">Settings</a>
        <a class="alink" href="disconnect.php"><img src="graphics/logout.png">Disconnect</a>
    </div>


    <div id="main">
        <div id="topNav">
            <span onclick="openNav()">&#9776; </span>

            <a class="tlink" href="#=" onclick="location.reload(true); return false;"><img src="graphics/refresh.png"> </a>
            <a class="tlink" href="index.php"><img src="graphics/layout.png"> </a>

        </div>

        <div id="news">



            <div class="header">
                <h1>Latest News</h1>
            </div>
            <div class="row">
              <div class="column">
            <?php
            require 'database.php';
            if (isset($_SESSION['userid']))
            {
            $sql = "SELECT articles_id from saves where users_id=:users_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':users_id', $_SESSION['userid']);
            $stmt->execute();
            $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
            foreach ($results as $articles_id)
            {
              $sql = "SELECT titlu,link,topic from articles where id=:articles_id";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':articles_id', $articles_id['articles_id']);
              $stmt->execute();
              $results2 = $stmt->fetchALL(PDO::FETCH_ASSOC);

              foreach ($results2 as $articles)
                {

              ?>

                          <div class="article">
                                  <img src="graphics/d.jpg" alt="Snow" style="width:100%;">
                                  <div class="top-right" ><button class="readBtn" onclick="window.open('<?= $articles['link'] ?>','_blank')"><b>READ</b></button></div>
                                  <div class="bottom">
                                      <h6 id="title"><strong><span style="color: white; font-size: 15px;"><?= $articles['titlu'] ?></span></strong></h6>
                                      <i><span style="color: white; font-size: 13px;"><?= $articles['topic'] ?></span></i>
                                  </div>
                              </div>

                      <?php
                }
              }
                }
                  ?>
                </div>
               </div>

        </div>

    </div>

</body>

</html>
