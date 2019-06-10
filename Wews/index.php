<?php
session_start();
require "database.php";
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
               if(isset($_SESSION['userid']))
              {
                 $_SESSION['allfeeds']=array();

                 $records = $conn->prepare('SELECT feeds_id FROM follows where users_id=:users_id');
                  $records->bindParam(':users_id', $_SESSION['userid']);
                  $records->execute();
                 $results = $records->fetchALL(PDO::FETCH_ASSOC);

                   foreach ($results as $feeds)
                   {
                     $records = $conn->prepare('SELECT link FROM feeds where id=:feeds_id');
                     $records->bindParam(':feeds_id', $feeds['feeds_id']);
                     $records->execute();
                     $results = $records->fetchALL(PDO::FETCH_ASSOC);
                     foreach ($results as $links)
                     {
                         array_push($_SESSION['allfeeds'],$links['link']);
                     }
                     }

                 }
               foreach($_SESSION['allfeeds'] as $userfeeds){
                 list(,$var,) = explode('//', $userfeeds);
                 list($var,) = explode('/', $var);
                 ?>
                    <a href="getfeed.php?caller=<?=$var?>" class="clink"><?= $var ?></a>
                  <?php
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
            <a class="tlink" href="#"><img src="graphics/layout.png"> </a>
        </div>

        <div id="news">



            <div class="header">
                <h1>Latest News</h1>
            </div>
            <?php
            require 'database.php';
            $feeds = array();
            $sql = "SELECT feeds_id from follows where users_id=:uid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':uid', $_SESSION['userid']);
            $stmt->execute();
	          $results = $stmt->fetchALL(PDO::FETCH_ASSOC);

            foreach ($results as $feeds_id)
              {
                $sql = "SELECT link from feeds where id=:feeds_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':feeds_id', $feeds_id['feeds_id']);
                $stmt->execute();
    	          $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
                foreach ($results as $feeds_id)
                {
                array_push($feeds,$feeds_id['link']);
                }
              }

                  //Read each feed's items
                  $entries = array();
                  foreach($feeds as $feed) {
                      $xml = simplexml_load_file($feed);
                      $entries = array_merge($entries, $xml->xpath("//item"));
                  }

                  //Sort feed entries by pubDate
                  usort($entries, function ($feed1, $feed2) {
                      return strtotime($feed2->pubDate) - strtotime($feed1->pubDate);
                  });

                  ?>
                  <div class="row">
                    <div class="column">
                  <?php
                  //Print all the entries
                  foreach($entries as $entry){
                    $entry->description=mb_strimwidth($entry->description, 0, 100, ".");
                    if ($entry->enclosure['url']){
                      $image=$entry->enclosure['url'];
                      if(strpos($image, '.mp4') !== false)
                        {$image ="graphics/d.jpg";}
                      }
                      else {
                        $image ="graphics/d.jpg";
                      }

                      ?>


                          <div class="article">
                                  <img src="<?= $image?>" alt="Snow" style="width:100%;">
                                  <div class="top-left">
                                    <button class="readBtn"><a href="addbookmark.php?link=<?= $entry->link ?>&title=<?= $entry->title?>&description=<?= $entry->description?>">Bookmark</a></button>
                                  </div>
                                  <div class="top-right" >
                                    <button class="readBtn" onclick="window.open('<?= $entry->link ?>','_blank')"><b>READ</b></button>
                                  </div>
                                  <div class="bottom">
                                      <h6 id="title"><strong><span style="color: white; font-size: 15px;"><?= $entry->title ?></span></strong></h6>
                                      <i><span style="color: white; font-size: 13px;"><?= $entry->description ?></span></i>
                                  </div>
                              </div>

                      <?php
                  }
                  ?>
                </div>
               </div>

        </div>

    </div>

</body>

</html>
