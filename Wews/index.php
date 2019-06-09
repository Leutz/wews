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
            <?php
            require 'database.php';
            $feeds = array();
            $sql = "call `getUserID`(:email,@userid);";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $_SESSION['email']);

            if( $stmt->execute() )
            {
              $sql = "SELECT @userid as useridoutput;";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $userid = $stmt->fetchALL(PDO::FETCH_ASSOC);
              foreach ($userid as $id)
              { $_SESSION['userid']=$id['useridoutput'];}
            }

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
                    if (!$entry->enclosure['url'])
                    {$entry->enclosure['url']="graphics/d.jpg";}
                      ?>

                          <div class="article">
                                  <img src="<?= $entry->enclosure['url']?>" alt="Snow" style="width:100%;">
                                  <form method="post">
                                    <input class="top-left" type="submit" name="bookmark" id="test" value="BOOKMARK"><br/>
                                  </form>
                                  <?php
                                  if(!empty($_POST['bookmark']))
                                  {
                                    $sql = "INSERT into articles (id,titlu,link,topic,created_at,updated_at) values (id,:title,:link,:topic,created_at,updated_at)";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':title', $entry->title);
                                    $stmt->bindParam(':link', $entry->link);
                                    $stmt->bindParam(':topic', $entry->description);
                                    if($stmt->execute())
                                    {
                                    echo '<script type="text/javascript">';
                                    echo 'alert("Ai adaugat cu succes.");';
                                    echo '</script>';}
                                    unset($_POST['bookmark']);
                                  } ?>

                                  <div class="top-right" ><button class="readBtn" onclick="window.open('<?= $entry->link ?>','_blank')"><b>READ</b></button></div>
                                  <div class="bottom">
                                      <h4 id="title"><strong><?= $entry->title ?></strong></h4>
                                      <p><i><?= $entry->description ?></i></p>
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
