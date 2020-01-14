<?php
Users::adminVerif($_SESSION['auth']['idUser']);
$id = intval($_GET['code']);
$data = new Articles($id);
$allCategories = Categories::getAllCategories();
$newCategory = $_POST['newCategory'];
$addCategorie = Categories::addCategorie($newCategory);
$editAricle = Articles::editArticle($id, $_POST['category'],$_POST['title'],$_POST['article']);
$datas_images = Images::getAllimages($id);
$dossier = "modules/articles/images/".$id;
if(!is_dir($dossier)){
    mkdir( $dossier, 0777);
}
if($_FILES["__photos"]) {
    define("PATH_DIR_IMAGE", 'modules/articles/images/'.$id.'/');
    define("URL_DIR_IMAGE", 'modules/articles/images/'.$id.'/');
    ############ Configuration ##############
    $config["generate_image_file"]          = true;
    $config["generate_thumbnails"]          = true;
    $config["image_max_size"]               = 1000; //Maximum image size (height and width)
    $config["thumbnail_size"]               = 300; //Thumbnails will be cropped to 200x200 pixels
    $config["thumbnail_prefix"]             = "thumb_"; //Normal thumb Prefix
    $config["destination_folder"]           = PATH_DIR_IMAGE; //upload directory ends with / (slash)
    $config["thumbnail_destination_folder"] = PATH_DIR_IMAGE; //upload directory ends with / (slash)
    $config["upload_url"]                   = URL_DIR_IMAGE;
    $config["quality"]                      = 90; //jpeg quality
    $config["random_file_name"]             = true; //randomize each file name
    $config["file_data"] = $_FILES["__photos"];
    if($config["file_data"]['name']['0'] != ''){
        //include sanwebe impage resize class
        include("App/resize.class.php");
        //create class instance
        $im = new ImageResize($config);
        $responses = $im->resize(); //initiate image resize
        foreach($responses["images"] as $response){
            $image = URL_DIR_IMAGE.$response;
            $thumbs_image = URL_DIR_IMAGE.'thumb_'.$response;
            $fichier_image = $response;
            Images::addimages($image, $thumbs_image, $fichier_image, $id);
        }
    }
}
if(isset($_GET['del_image'])){
    $id_image  = $_GET['del_image'];;
    $value_image = Images::del_image($id_image);
}
require_once 'modules/articles/editarticle_view.php';
?>