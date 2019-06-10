<?php
session_start();
require 'database.php';

if(isset($_GET['article_id']) && !empty($_SESSION['userid']))
{
  $sql="DELETE FROM saves where users_id=:uid and articles_id=:aid";
  $records = $conn->prepare($sql);
  $records->bindParam(':aid',$_GET['article_id']);
  $records->bindParam(':uid',$_SESSION['userid']);

     if($records->execute())
     {echo "<script type='text/javascript'>alert('Ai sters cu succes bookmark-ul din baza de date!');window.location = 'bookmark.php';</script>";}
     else
       {echo "<script type='text/javascript'>alert(' Querry-ul nu a fost apelat!');window.location = 'bookmark.php';</script>";}



}
?>
