<?php
$idAuteur = $_SESSION["auth"]['idUser'];
Users::adminVerif($idAuteur);
$allCategories = Categories::getAllCategories();
Articles::addArticle( $_POST['category'],$_POST['title'], $_POST['article'],  $_SESSION['auth']['idUser']);
require_once 'modules/articles/addarticle_view.php';
?>