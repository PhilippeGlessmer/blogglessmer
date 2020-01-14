<script src="<?= WEBSITE_URL;?>/Assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        language: 'fr_FR',
        selector: "textarea.wysiwyg",
        /* plugins: [
        "advlist autolink autoresize lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
        ], */
        plugins: ["advlist anchor autolink autoresize autosave charmap code colorpicker contextmenu directionality emoticons fullscreen hr image insertdatetime link lists media nonbreaking noneditable pagebreak paste preview print save searchreplace spellchecker tabfocus table template textcolor textpattern visualblocks visualchars wordcount"],
        // plugins: ["advlist autolink autoresize lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste"],
        convert_urls: false,
        relative_urls: false,
        autoresize_min_height: 200,
        autoresize_max_height: 600,
        width : 850,
        resize: true,
        spellchecker_language: 'fr',
        menu : { // this is the complete default configuration
            file   : {title : 'File'  , items : 'newdocument print'},
            edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
            insert : {title : 'Insert', items : 'link media image | insertdatetime hr'},
            view   : {title : 'View'  , items : 'visualaid'},
            format : {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | fontselect fontsizeselect formats | removeformat'},
            table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
            tools  : {title : 'Tools' , items : 'code'}
        },
        insertdatetime_formats: [
            "%d/%m/%Y à %H:%M:%S",
            "%d/%m/%Y",
            "%H:%M",
            "%H:%M:%S"
        ],
        nonbreaking_force_tab: true,
        image_advtab: true, // permet d'avoir l'onglet avancé pour les images
        media_alt_source: false,
        toolbar1: "undo redo | bold italic underline strikethrough | cut copy paste selectall | forecolor backcolor | link media image",
        toolbar2: "fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons charmap"
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Titre</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Ecrivez votre titre" name="title" value="<?= $data->titleArticle;?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Catégorie</span>
                    </div>
                    <select class="form-control" name="category" onchange="java_script_:showCategories(this.options[this.selectedIndex].value)" required="required">
                        <option value="">Choisissez votre catégorie</option>
                        <option value="0">Créer une catégorie</option>
                        <?php foreach ($allCategories as $index => $category): ?>
                            <option value="<?= $category['idCategorie'] ?>"<? if($category['idCategorie'] == $data->idCatArticle){ echo 'selected';}?>><?= $category['nameCategorie']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="newCategory" id='hiddenDiv' style="display: none" class="form-control" value="" placeholder="Ecrire le titre de la nouvelle catégorie">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Article</span>
                    </div>
                    <textarea class="form-control wysiwyg" name="article"><?= $data->contentArticle;?></textarea>
                </div>
                <input type="submit" class="btn btn-outline-success w-100" value="Enregistrer">
            </form>
            <br/><br/><br/><br/>
            <form action="<?php print $PHP_SELF?>" enctype="multipart/form-data" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Uploader images</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="__photos[]" type="file" multiple aria-describedby="inputGroupFileAddon01" accept="image/*">
                        <label class="custom-file-label" for="inputGroupFile01">Choisissez vos images</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit" id="inputGroupFileAddon04">Envoyer</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <?php
                foreach ($datas_images as $index => $valueImage):
                    ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="<?= WEBSITE_URL.'/'.$valueImage['url_thumbsImage'];?>" class="w-100"/>
                            <a href="<?= WEBSITE_URL.'/articles/editarticle/'.$id.'/?del_image='.$valueImage['idImage'];?>" class="btn btn-danger w-100">Supprimer l'images</a>
                        </div>
                    </div>
                    <?
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>