
<!DOCTYPE html>
<html>


<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="animations.js"></script>
    <link rel="stylesheet" href="layout_stylesheet.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>


<body>

    <div id="main">
        <div id="topNav">
            <span onclick="openNav()">&#9776; </span>

            <a class="tlink" href="#=" onclick="location.reload(true); return false;"><img src="graphics/refresh.png"> </a>
            <a class="tlink" href="index.php"><img src="graphics/layout.png"> </a>
        </div>

        <div id="news">



            <div class="header">
                <h1>Your follows</h1>
                <?php
                session_start();
                require 'database.php';

                if(isset($_SESSION['userid']))
              	{
                  $_SESSION['feeds']=array();

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
	                       echo $links['link'];
                         ?>

                             <a href="deletefeed.php?link=<?= $links['link'] ?>"><img src="graphics/delete.jfif" height="20" width="20"></a>

                         <?php
	                        echo "</br>";
                          array_push($_SESSION['feeds'],$links['link']);
                      }
                      }

                  }
else {
  echo "Nu s-a executat querry-ul";
}


      ?>
            </div>

            <form action="addcontent.php" method="POST" class="container">
            <label for="site"><b style="">Site</b></label>
            <input type="text" placeholder="Enter site" name="site" required>
            <input type="submit" class="loginbtn" value="Add">
            </form>
            <?php

            if(!empty($_POST['site'])){
              if(strpos(file_get_contents($_POST['site']),'<?xml')===false) {
                  echo "<script type='text/javascript'>alert('Link-ul nu este validat ca fiinds de tip RSS FEED')</script>";
              }
              else
              {
              $sql = "call `addfeed`(:site,:email);";
            	$stmt = $conn->prepare($sql);
            	$stmt->bindParam(':email', $_SESSION['email']);
              $stmt->bindParam(':site', $_POST['site']);
              if ($stmt->execute())
              { echo "<script type='text/javascript'>alert(' Ai adaugat cu succes');window.location = 'addcontent.php';</script>";}
                else {echo "<script type='text/javascript'>alert('S-a intamplat ceva. Incearca iar')</script>";}
              }
           }
            ?>
        </div>

    </div>

    <div id="mySidenav" class="sidenav">
        <img src="graphics/logo2.png">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="alink" href="index.php"><img src="graphics/home.png">Home</a>
        <a class="alink" href="bookmark.php"><img src="graphics/bookmark.png">Bookmarks</a>
        <a class="alink" href="addcontent.php"><img src="graphics/add.png">Add Content</a>
        <a class="alink" onclick="myAccFunc()"><img src="graphics/add.png"> Follows </a>
             <div id="demoAcc" class="w3-hide">
               <?php
               foreach($_SESSION['feeds'] as $userfeeds){
                 list(,$var,) = explode('//', $userfeeds);
                 list($var,) = explode('/', $var);
                 ?>
                    <a href="getfeed.php?caller=<?= $var ?>" class="blink"><?= $var ?></a>
                  <?php
                   }
                ?>

             </div>
        <a class="alink" href="settings.php"><img src="graphics/settings.png">Settings</a>
        <a class="alink" href="disconnect.php"><img src="graphics/logout.png">Disconnect</a>
    </div>

</body>

</html>
