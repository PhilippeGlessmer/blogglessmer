<?php
Users::adminVerif($_SESSION['auth']['idUser']);
Categories::addCategorie($_POST['newCategory']);
require_once 'modules/articles/addcategorie_view.php';
?>