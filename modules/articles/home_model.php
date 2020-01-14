<?php
$id = $_GET['code'];
$allArticlesCat = Articles::getAllArticles($id);
$lastArticle = Articles::getLastArticle();
$lastArticleLeft = Articles::getLastArticle(1);
$lastArticleRight = Articles::getLastArticle(2);
$imageLeft = Images::getImage($lastArticleLeft['idArticle']);
$imageright = Images::getImage($lastArticleRight['idArticle']);
$parPage = 10;
$nbArticle = count($allArticlesCat);
$totalPages = ceil($nbArticle / $parPage);
if($_GET['page'] == null){
    $page_actuelle = 1;
}
if (isset($_GET['page']) && intval($_GET['page']) >= 1 && intval($_GET['page']) <= $totalPages)
    $page_actuelle = intval($_GET['page']);
else
    if (isset($_GET['page']))
        $page_actuelle = (isset($_GET['page']) && intval($_GET['page']) >= 1 && intval($_GET['page']) <= $totalPages) ? intval($_GET['page']) : 1;

$limit_start = ($page_actuelle > 1) ? (($page_actuelle * $parPage) - $parPage) : 0;
$limit_end = $parPage;
$allArticles = Articles::getPaginationArticles($id, $limit_start, $parPage);
$titleCat = new Categories($id);
$titleCategorie = '"'.$titleCat->nameCategorie.'"';
$allCategories = Categories::getAllCategories();
require_once 'modules/articles/home_view.php';
?>