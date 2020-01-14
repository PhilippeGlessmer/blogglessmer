<?php
/**
 * Commentaires
 * fonctions lire un commentaire, ajouter , tous les commentaires, ...
 */
class Commentaires
{
    public $idCommentaire;
    public $mailCommentaire;
    public $pseudoCommentaire;
    public $contentCommentaire;
    public $dateCommentaire;
    public $createCommentaire;
    //idCommentaire 	mailCommentaire 	pseudoCommentaire 	dateCommentaire 	idArticleCommentaire 	createCommentaire

    /**
     * Commentaires constructor.
     * @param $id
     */
    function __construct($id){
        $id = str_secur($id);
        $reqCommentaire = $db->fetch('SELECT * FROM articles__commentaires WHERE idCommentaire = ?', [$id], false);
        $data = $reqCommentaire;
        $this->idCommentaire = $data['idCategorie'];
        $this->mailCommentaire = $data['mailCommentaire'];
        $this->pseudoCommentaire = $data['pseudoCommentaire'];
        $this->contentCommentaire = $data['contentCommentaire'];
        $this->dateCommentaire = $data['dateCommentaire'];
        $this->idArticleCommentaire = $data['idArticleCommentaire'];
        $this->createCommentaire =  $data['createCommentaire'];
    }

    /**
     * @param $idArticle
     *Tous les commentaires d'un article
     * @return array|mixed
     */
    public function allCommentaire($idArticle){
        global $db;
        $reqCategories = $db->fetch('SELECT * FROM articles__commentaires WHERE idArticleCommentaire = ?', [$idArticle], true);
        if($reqCategories){
            return $reqCategories;
        }else{
            return array();
        }
    }

    /**
     * Ajouter un commentaire
     * @param $mailCommentaire
     * @param $pseudoCommentaire
     * @param $contentCommentaire
     * @param $dateCommentaire
     * @param $idArticleCommentaire
     * @throws \Exception
     */
    public function addCommentaire($mailCommentaire, $pseudoCommentaire, $contentCommentaire, $dateCommentaire, $idArticleCommentaire)
    {
        global $db;
        if($mailCommentaire) {
            $_SESSION['mail'] = $mailCommentaire;
            $_SESSION['pseudo'] = $pseudoCommentaire;
            $_SESSION['content'] = $contentCommentaire;
            $_SESSION['date'] = $dateCommentaire;
            $date = new DateTime($dateCommentaire);
            $date = $date->format('Y/m/d');
            if ($date == date('Y/m/d')) {
                $reqCommentaire = $db->execute("INSERT INTO articles__commentaires SET mailCommentaire = ?, pseudoCommentaire=?, contentCommentaire =?, dateCommentaire=?, idArticleCommentaire=?",
                    [
                        $mailCommentaire, $pseudoCommentaire, $contentCommentaire, $dateCommentaire, $idArticleCommentaire
                    ], true);
                header('location: ' . WEBSITE_URL . '/articles/read/' . $idArticleCommentaire.'/#commentaire');
            }
        }
    }
}