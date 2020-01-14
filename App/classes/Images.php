<?php

class Images
{
    public $idImage;
    public $urlImage;
    public $url_thumbsImage;
    public $fichierImage;
    public $idArticleImage;
    /**
     * Categories constructor.
     * @param $id
     */
    function __construct($id) {
        global $db;
        $id = str_secur($id);
        $reqImage = $db->fetch('SELECT * FROM articles__images WHERE idImage = ?', [$id], false);
        $data = $reqImage;
        $this->idImage = $data['idImage'];
        $this->urlImage = $data['urlImage'];
        $this->url_thumbsImage = $data['url_thumbsImage'];
        $this->fichierImage = $data['fichierImage'];
        $this->idArticleImage = $data['idArticleImage'];
    }

    /**
     * Suprimer une image du serveur et de la base de donnée
     * @param $id
     */
    static function del_image($id) {
        global $db;
        $verif= new Images($id);
        debug($verif->idArticleImage);
        unlink(WEBSITE_URL.'/modules/articles/images/'.$id.'/'.$verif->url_thumbsImage);
        unlink(WEBSITE_URL.'/modules/articles/images/'.$id.'/'.$verif->urlImages);
        $reqImages = $db->execute('DELETE FROM articles__images WHERE idImage = ?', [$id], false);
        header('location: '.WEBSITE_URL.'/articles/editarticle/'.$verif->idArticleImage);
    }

    /**
     * Affiche les données d'une image
     * @param $id_article
     * @return array|mixed
     */
    static function getImage($id_article) {
        global $db;
        $reqImages = $db->fetch('SELECT * FROM articles__images WHERE idArticleImage=?', [$id_article], false);
        return $reqImages;
    }
    /**
     * Envoie de toutes les données des images
     * @return array
     */
    static function getAllimages($id) {
        global $db;
        $reqImages = $db->fetch('SELECT * FROM articles__images WHERE idArticleImage =?', [$id], true);
        return $reqImages;
    }

    /**
     * Ajouter les données de l'image à la BDD
     * @param $urlImage
     * @param $url_thumbsImage
     * @param $fichierImage
     * @param $idArticleImage
     */
    static function addimages($urlImage, $url_thumbsImage, $fichierImage, $idArticleImage) {
        global $db;

            $reqCategorie = $db->execute("INSERT INTO articles__images SET urlImage = ?, url_thumbsImage=?, fichierImage=?, idArticleImage=? ", [
                $urlImage,
                $url_thumbsImage,
                $fichierImage,
                $idArticleImage
            ]);
           // header('location: ' . WEBSITE_URL . '/articles/editarticle/'.$idArticleImage);

    }
}