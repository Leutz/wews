<?php
session_start();
require 'database.php';

if(isset($_SESSION['userid'])  && isset($_GET["link"]) && isset($_GET['title']) && isset($_GET['description']))
{
  $sql = 'INSERT INTO articles (id,titlu,link,topic) values(id,:titlu,:link,:topic);';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':titlu', $_GET['title']);
  $stmt->bindParam(':link', $_GET['link']);
  $stmt->bindParam(':topic', $_GET['description']);
  $stmt->execute();
  $sql = "SELECT id from articles where titlu=:titlu and link=:link";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':titlu', $_GET['title']);
  $stmt->bindParam(':link', $_GET['link']);
  $stmt->execute();
  $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
  $sql = "INSERT INTO saves(id,users_id,articles_id) values(id,:users_id,:articles_id)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':users_id', $_SESSION['userid']);
  $stmt->bindParam(':articles_id', $results[0]['id']);
  if($stmt->execute())
  echo "<script type='text/javascript'>alert('Ai adaugat cu succes articolul in Bookmark!');window.history.back();</script>";
}
  else {
    echo "Nu s-a executat";
  }



  ?>
