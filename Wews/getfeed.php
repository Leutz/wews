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
            <?php
            require 'database.php';
            $feeds = array();


            if(isset($_SESSION['userid'])  && isset( $_GET["caller"] ))
          {
            $sql = "SELECT link from feeds where INSTR(link,:substr)>0";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':substr', $_GET['caller']);
            $stmt->execute();
            $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
            foreach ($results as $feeds_id)
            {
            array_push($feeds,$feeds_id['link']);
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


<div class="group">
    <div class="container">
      <!-- Normal Demo-->

        <!-- Post-->
        <div class="post-module">
          <!-- Thumbnail-->
          <div class="thumbnail">
            <div class="date">
              <div><?= $entry->category ?></div>

            </div><img src="<?= $image?>" alt="Snow"/>
          </div>
          <!-- Post Content-->
          <div class="post-content">
            <div class="rb"><button class="readBtn" onclick="window.open('<?= $entry->link ?>','_blank')"><b>READ</b></button></div>
            <div class="bb"><button class="readBtn"><a href="addbookmark.php?link=<?= $entry->link ?>&title=<?= $entry->title?>&description=<?= $entry->description?>">Bookmark</a></button></div>
            <div class="sh"><button class="readBtn" onclick="window.open('http://www.facebook.com/sharer.php?u=<?= $entry->link?>','_blank')"><b>Share</b></button></div>
            <h1 class="title"><strong><span><?= $entry->title ?></span></strong></h1>
            <p class="description"><?= $entry->description ?>..</p>
            <div class="post-meta"><span class="timestamp"><?= $entry->pubDate ?></span><span class="comments"><i class="fa fa-comments"></i></span></div>
          </div>
        </div>


    </div>
</div>

                      <?php
                  }
                }
                  ?>
                </div>
               </div>

        </div>

    </div>

</body>

</html>
