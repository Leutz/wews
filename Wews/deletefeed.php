<?php
session_start();
require 'database.php';

if(isset($_GET['link']) && !empty($_SESSION['userid']))
{
  $sql="SELECT id FROM feeds where link=:site_link";
  $records = $conn->prepare($sql);
  $records->bindParam(':site_link',$_GET['link']);
  $records->execute();
  $results = $records->fetchALL(PDO::FETCH_ASSOC);

     $records = $conn->prepare("DELETE FROM follows where feeds_id=:feeds_id and users_id=:users_id");
     $records->bindParam(':feeds_id', $results[0]['id']);
     $records->bindParam(':users_id', $_SESSION['userid']);
     if($records->execute())
     {echo "<script type='text/javascript'>alert('Ai sters cu succes feedul din baza de date!');window.location = 'addcontent.php';</script>";}
     else {
       {echo "<script type='text/javascript'>alert(' Querry-ul nu a fost apelat!');window.location = 'addcontent.php';</script>";}

     }

}
?>
