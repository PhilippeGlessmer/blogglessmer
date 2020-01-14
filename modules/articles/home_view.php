<div>
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-12 px-0">
            <h1 class="display-4 font-italic"><?= $lastArticle['titleArticle']?></h1>
            <p class="lead my-3"><?= sentence(150, $lastArticle['contentArticle']);?></p>
            <p class="lead mb-0"><a href="<?= WEBSITE_URL.'/articles/read/'.$lastArticle['idArticle'];?>" class="text-white font-weight-bold"><?= $lang->librairie->continue ?></a></p>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-primary"><?= $lastArticleLeft['nameCategorie'] ?></strong>
                    <h3 class="mb-0">
                        <a class="text-dark" href="<?= WEBSITE_URL.'/articles/read/'.$lastArticleLeft['idArticle'];?>"><?= sentence(15, $lastArticleLeft['titleArticle']);?></a>
                    </h3>
                    <div class="mb-1 text-muted"><?= $lastArticleLeft['createArticle']?></div>
                    <p class="card-text mb-auto text-justify"><?= sentence(100, $lastArticleLeft['contentArticle']);?></p>
                    <a href="#"><?= $lang->librairie->continue ?></a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" src="<?= WEBSITE_URL.'/'.$imageLeft['url_thumbsImage'];?>" alt="<?= $lastArticleLeft['titleArticle'];?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-success"><?= $lastArticleRight['nameCategorie'] ?></strong>
                    <h3 class="mb-0">
                        <a class="text-dark" href="<?= WEBSITE_URL.'/articles/read/'.$lastArticleRight['idArticle'];?>"><?= sentence(15, $lastArticleRight['titleArticle']);?></a>
                    </h3>
                    <div class="mb-1 text-muted"><?= $lastArticleRight['createArticle'] ?></div>
                    <p class="card-text mb-auto"><?= sentence(100,$lastArticleRight['contentArticle']);?></p>
                    <a href="<?= WEBSITE_URL.'/articles/read/'.$lastArticleRight['idArticle'];?>"><?= $lang->librairie->continue ?></a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" src="<?= WEBSITE_URL.'/'.$imageright['url_thumbsImage'];?>" alt="<?= $lastArticleRight['titleArticle'] ?>">
            </div>
        </div>
    </div>
</div>
<main role="main" >
    <div class="row">
        <div class="col-md-8 blog-main" id="list">
            <h3 class="pb-3 mb-4 font-italic border-bottom text-center">
                <?= $lang->librairie->ariane.' '.$titleCategorie;?>
            </h3>
            <?= Articles::paginer($id, $nbArticle, $parPage, $page_actuelle, 4, 4, 1, 1); ?>
            <?php foreach ($allArticles as $index => $article):
                $image = Images::getImage($article['idArticle']);?>
                <div class="card my-2">
                    <div class="card-header">
                        <h2 class="blog-post-title"><?= sentence(35,$article['titleArticle']);?></h2>
                    </div>
                    <div class="card-body">
                        <p class="text-justify">
                            <img class="float-left w-25 img-thumbnail m-1" src="<?= WEBSITE_URL.'/'.$image['url_thumbsImage'];?>" alt="<?= $image['titleArticle'] ?>">
                            <?= sentence(500,$article['contentArticle'] ); ?> </p>
                    </div>
                    <div class="card-footer">
                        <p class="blog-post-meta">
                            <?= date_format(date_create($article['createArticle']), "d/m/Y H:i")?> par <a href="#"><?= $article['firstnameUser'] . ' ' . $article['lastnameUser']?></a> <a class="float-right btn btn-outline-primary" href="<?= WEBSITE_URL.'/articles/read/'.$article['idArticle'];?>"><?= $lang->librairie->continue ?></a></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <?= Articles::paginer($id, $nbArticle, $parPage, $page_actuelle, 4, 4, 1, 1); ?>
        </div><!-- /.blog-main -->
        <aside class="col-md-4 blog-sidebar">
            <div class="p-3 mb-3 bg-light rounded sticky-top">
                <ul class="list-group">
                    <? foreach ($allCategories as $index => $category):;?>
                    <li class="list-group-item list-group-item-action"><a href="<?=WEBSITE_URL.'/articles/home/'.$category['idCategorie'].'#list';?>"><?= $category['nameCategorie'];?><span class="badge badge-success float-right"><?= Articles::countArticle($category['idCategorie']);;?></span></a></li>
                    <? endforeach;?>
                </ul>
            </div>
        </aside>
        <!-- /.blog-sidebar -->
    </div><!-- /.row -->
</main><!-- /.container -->