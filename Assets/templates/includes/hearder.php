<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 d-flex align-items-center">
            <?php
            if($_SESSION['auth']){
                echo '<a class="btn btn-sm btn-outline-secondary" href="'.WEBSITE_URL.'/users/logout">'.$lang->librairie->deconnexion.'</a>';
            }else{
                echo '<a class="btn btn-sm btn-outline-secondary" href="'.WEBSITE_URL.'/users/register/">'.$lang->librairie->Subscribe.'</a>';
            }
            ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle btn btn-sm btn-outline-secondary" id="navbarDropdownMenuLink" data-toggle="dropdown"><?= $lang->librairie->langage;?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?= WEBSITE_URL.'/fr/';?>"><?= $lang->librairie->french;?></a>
                        <a class="dropdown-item" href="<?= WEBSITE_URL.'/en/';?>"><?= $lang->librairie->english;?></a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="<?= WEBSITE_URL;?>"><?= WEBSITE_NAME;?></a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            <a class="text-muted" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
            </a>
            <?php
            if($_SESSION['auth']){
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle btn btn-sm btn-outline-secondary" id="navbarDropdownMenuLink" data-toggle="dropdown"><?= $lang->librairie->manager;?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?= WEBSITE_URL.'/articles/addarticle';?>"><?= $lang->librairie->addArticle;?></a>
                            <a class="dropdown-item" href="<?= WEBSITE_URL.'/articles/addcategorie';?>"><?= $lang->librairie->addCategorie;?></a>
                        </div>
                    </li>
                </ul>
            <?
                echo '<a class="btn btn-sm btn-outline-secondary" href="'.WEBSITE_URL.'/users/logout">'.$lang->librairie->deconnexion.'</a>';
            }else{
                echo '<a class="btn btn-sm btn-outline-secondary" href="'.WEBSITE_URL.'/users/login/">'.$lang->librairie->connexion.'</a>';
            }
            ?>
        </div>
    </div>
</header>