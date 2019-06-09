<?php
session_start();
require 'database.php';

if(!empty($_POST['site']))
{
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
  }

  $sql="SELECT id FROM feeds where link=:site_link";
  $records = $conn->prepare($sql);
  $records->bindParam(':site_link',$_POST['site']);
  $records->execute();
  $results = $records->fetchALL(PDO::FETCH_ASSOC);
  var_dump($results);
  echo $_SESSION['uerid'];
  echo $_POST['site'];

   foreach ($results as $feeds)
   {
     $records = $conn->prepare('DELETE FROM follows where feeds_id=:feeds_id and users_id=:users_id');
     $records->bindParam(':feeds_id', $feeds['id']);
     echo $feeds;
     $records->bindParam(':users_id', $_SESSION['userid']);
     $records->execute();
   }
}
?>
