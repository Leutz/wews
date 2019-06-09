
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
        <a class="alink" href="#"><img src="graphics/add.png">Add Content</a>
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
                <h1>Add Content</h1>
                <?php
                session_start();
                require 'database.php';
                $sql = "call `getUserID`(:email,@userid);";
              	$stmt = $conn->prepare($sql);
              	$stmt->bindParam(':email', $_SESSION['email']);

                if( $stmt->execute() )
              	{$sql = "SELECT @userid as useridoutput;";
              		$stmt = $conn->prepare($sql);
              		$stmt->execute();
              		$userid = $stmt->fetchALL(PDO::FETCH_ASSOC);
                  foreach ($userid as $id)
                  { $_SESSION['userid']=$id['useridoutput'];}

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
	                        echo "</br>";
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

            <form action="deletefeed.php" method="POST" class="container">
            <label for="site"><b style="">Delete</b></label>
            <input type="text" placeholder="Enter site" name="site" required>
            <input type="submit" class="loginbtn" value="Delete">
            </form>


        </div>

    </div>

</body>

</html>
