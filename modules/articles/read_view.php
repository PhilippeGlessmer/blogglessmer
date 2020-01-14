
<main role="main">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
               <?= $article->titleArticle;
               echo Articles::edit($article->idArticle, $lang->librairie->edit, $_SESSION['auth']['rangUser']);?>
            </h3>
                <?
                if($nbImage> 1){
                    ?>
                <div class="carousel slide img-thumbnail" id="carousel-75318" data-ride="carousel" data-interval="2000" >
                    <ol class="carousel-indicators">
                        <?
                        for ($i=0; $i<$nbImage; $i++) {
                            ?>
                            <li data-slide-to="<?= $i;?>" data-target="#carousel-75318" <?php echo ($i == 0) ? ' active' : ''; ?>">
                            </li>
                            <?
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?
                        for ($i=0; $i<$nbImage; $i++) {

                            ?>
                            <div class="carousel-item <?php echo ($i == 0) ? ' active' : ''; ?> h-100">
                                <a href=""><img src="<?= WEBSITE_URL.'/'.$image[$i]['urlImage'];?>" alt="<?= $image[$i]->urlImagee;?>" class="w-100 h-100"></a>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-75318" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-75318" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                    <?
                }else{
                    echo '<img src="'.WEBSITE_URL.'/'.$image[0]['urlImage'].'" class="img-thumbnail w-100">';
                }
                ?>
            <div class="card p-3 my-1">
                <p>
                    <?= $article->contentArticle;?>
                </p>
            </div>
            <div class="card my-3"id="commentaire">
                <h3 class="card-header">Les commentaires</h3>
                <div class="card-body">
                    <form method="post">
                        <input type="text" class="form-control my-1" name="mail_comm" placeholder="Inscrivez votre Email"  value="<?= $_SESSION['mail'];?>" required>
                        <input type="text" class="form-control my-1" name="pseudo_comm" placeholder="Inscrivez votre pseudonyme"  value="<?= $_SESSION['pseudo'];?>" required>
                        <textarea class="form-control my-1" name="content_comm" placeholder="Inscrivez votre commentaire"   value="<?= $_SESSION['content'];?>"required></textarea>
                        <input type="date"  class="form-control my-1" name="date_comm"  value="<?= $_SESSION['date'];?>" required>
                        <input type="submit" value="Envoyer le commentaire" class=" my-1 btn btn-outline-success w-100">
                    </form>
                </div>
                <div class="card-footer">
                    <? foreach ($allCommentaires as $index => $commentaire):;?>
                        <p>
                            <?= $commentaire['contentCommentaire'];?>
                            <?= '<br/>';?>
                            <?= date_format(date_create($commentaire['createCommentaire']), "d/m/Y H:i")?> par <a href="#"><?= $commentaire['pseudoCommentaire']?></a>
                        </p>
                        <hr>
                    <? endforeach;?>
                </div>
            </div>
        </div><!-- /.blog-main -->
        <aside class="col-md-4 blog-sidebar">
            <div class="p-3 mb-3 bg-light rounded sticky-top">
                <ul class="list-group">
                    <? foreach ($allCategories as $index => $category):;?>
                        <li class="list-group-item list-group-item-action"><a href="<?=WEBSITE_URL.'/articles/home/'.$category['idCategorie'].'#list';?>"><?= $category['nameCategorie'];?><span class="badge badge-success float-right"><?= Articles::countArticle($category['idCategorie']);;?></span></a></li>
                    <? endforeach;?>
                </ul>
            </div>
        </aside><!-- /.blog-sidebar -->
    </div><!-- /.row -->
</main><!-- /.container -->
