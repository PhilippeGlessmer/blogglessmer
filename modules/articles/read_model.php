<?php
$id = $_GET['code'];
$article  = new Articles($id);
$image = Images::getAllimages($id);
$nbImage = count($image);
$allCategories = Categories::getAllCategories();
$allCommentaires = Commentaires::allCommentaire($id);
$addComment = Commentaires::addCommentaire($_POST['mail_comm'],$_POST['pseudo_comm'],$_POST['content_comm'],$_POST['date_comm'], $id );
require_once 'modules/articles/read_view.php';
?>