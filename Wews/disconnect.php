<?php
session_start();
session_destroy();
echo '<script type="text/javascript">';
echo 'alert("Te-ai deconectat! Vei fi redirectionat spre pagina de login.");';
echo 'window.location = "login/login.php";';
echo '</script>';
?>
