<?php
$allCategories = Categories::getAllCategories();
echo '<div class="nav-scroller py-1 mb-2">';
echo '<nav class="nav d-flex justify-content-between">';
foreach ($allCategories as $index => $category):
echo '<a class="p-2 text-muted" href="'.WEBSITE_URL.'/articles/home/'.$category['idCategorie'].'">'.$category['nameCategorie'].'</a>';
endforeach;
echo '</nav>';
echo '</div>';