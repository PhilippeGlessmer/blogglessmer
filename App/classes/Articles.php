<?php
class Articles
{
    public $idArticle;
    public $titleArticle;
    public $contentArticle;
    public $createArticle;
    public $idCatArticle;
    /**
     * Articles constructor.
     * @param $id
     */
    function __construct($idArticle) {
        global $db;
        $idArticle = str_secur($idArticle);
        $reqArticle = $db->fetch('
         SELECT *
            FROM articles a 
            INNER JOIN users au ON au.idUser = a.author_id
            INNER JOIN articles__categories c ON c.idCategorie = a.idCatArticle
            WHERE a.idArticle = ?
        ',
            [$idArticle],
            false);
        $data = $reqArticle;
        $this->idArticle = $idArticle;
        $this->titleArticle = $data['titleArticle'];
        $this->contentArticle = $data['contentArticle'];
        $this->sentenceArticle=  $sentence;
        $this->createArticle = $data['createArticle'];
        $this->idCatArticle = $data['idCatArticle'];
        $this->author = $data['firstnameUser'] . ' ' . $data['lastnameUser'];
        $this->category = $data['nameCategorie'];

        if(!$data){
            /**
             * Vérifie si l'article existe ou sinon tu renvoi sur la racine
             */
            header('location:  '.WEBSITE_URL);
        }
    }
    /**
     * Tous les article par Catégorie, ou sans par default
     * Envoie tous les articles
     * @return array
     */
    static function getAllArticles($id = null) {
        global $db;
        if(intval($id)){
                $reqArticles = $db->fetch('
                SELECT *
                FROM articles a
                INNER JOIN users au ON au.idUser = a.author_id
                INNER JOIN articles__categories c ON c.idCategorie = a.idCatArticle
                WHERE idCatArticle = ?
                ',
                    [$id],
                    true);
            return $reqArticles;
            }else{
                $reqArticles = $db->fetch('
                SELECT *
                FROM articles a 
                INNER JOIN users au ON au.idUser = a.author_id
                INNER JOIN articles__categories c ON c.idCategorie = a.idCatArticle
                ', [],true);
            return $reqArticles;
            }
    }

    /**
     * Tous les articles de la pagination avec ou sans catégorie
     * A reprendre pas tres propre
     * @param null $id
     * @param      $limit_start
     * @param      $parPage
     * @return array|mixed
     */
    static function getPaginationArticles($id = null, $limit_start , $parPage){
        global $db;
        if($id){
            $reqArticles = $db->fetch('
                SELECT *
                FROM articles  
                JOIN users  ON idUser = author_id
                JOIN articles__categories  ON idCategorie = idCatArticle
                WHERE idCatArticle = '.$id.'
                ORDER BY createArticle DESC
                LIMIT ' . $limit_start . ', ' . $parPage,
                [$id, $limit_start, $parPage ], true);
            return $reqArticles;
        }else {
            $reqArticles = $db->fetch('
                SELECT *
                FROM articles  
                JOIN users  ON idUser = author_id
                JOIN articles__categories  ON idCategorie = idCatArticle
                ORDER BY createArticle DESC
                LIMIT ' . $limit_start . ', ' . $parPage,
                [ $limit_start, $parPage ], true);
            return $reqArticles;
        }
    }
    /**
     * Lire le dernier article avec ou sans catégorie
     * Envoie tous les articles
     * @param null $category
     * @return array
     */
    static function getLastArticle($category = null) {
        global $db;
        if($category == null){
            $reqArticle = $db->fetch('
               SELECT *
                FROM articles a 
                INNER JOIN users au ON au.idUser = a.author_id
                INNER JOIN articles__categories c ON c.idCategorie = a.idCatArticle
                ORDER BY idArticle DESC
                LIMIT 1
            ',
                [],
                false);
        }else{
            $reqArticle = $db->fetch('
                SELECT *
                FROM articles a 
                INNER JOIN users au ON au.idUser = a.author_id
                INNER JOIN articles__categories c ON c.idCategorie = a.idCatArticle
                WHERE c.idCategorie = ?
                ORDER BY idArticle DESC
                LIMIT 1
            ',
                [str_secur($category)],
                false);
        }
        return $reqArticle;
    }

    /**
     * Ajouter un article
     * @param $idCatArticle
     * @param $titleArticle
     * @param $contentArticle
     * @param $idAuteur
     */
    public function addArticle($idCatArticle, $titleArticle, $contentArticle, $idAuteur){
        if($titleArticle) {
            global $db;
            $reqArticle = $db->execute("INSERT INTO articles SET idCatArticle=?, author_id=?, titleArticle=?, contentArticle=?", [
                $idCatArticle,
                $idAuteur,
                $titleArticle,
                $contentArticle
            ]);
            $lastid = $db->lastIndertId() ;
            header('location:  '.WEBSITE_URL.'/articles/editarticle/'.$lastid);
        }
    }

    /**
     * Modifier un article
     * @param $idArticle
     * @param $idCatArticle
     * @param $titleArticle
     * @param $contentArticle
     */
    public function editArticle($idArticle, $idCatArticle, $titleArticle, $contentArticle)
    {
        global $db;
        if ($titleArticle) {
            $reqArticle = $db->execute("UPDATE articles SET idCatArticle = ?, titleArticle = ?, contentArticle= ? WHERE idArticle = ?",
                [ $idCatArticle, $titleArticle, $contentArticle, $idArticle ]);
            header('location:  ' . WEBSITE_URL . '/articles/editarticle/' . $lastid);
        }
    }

    /**
     * Compte le nombre d'article par Cat
     * @param $id
     * @return int
     */
    public function countArticle($id){
            $nb = self::getAllArticles($id);
            $nbArticle = count($nb);
            return $nbArticle;
    }

    /**
     * Pagignation
     * @param $id_cat
     * @param $nb_results
     * @param $nb_results_p_page
     * @param $numero_page_courante
     * @param $nb_avant
     * @param $nb_apres
     * @param $premiere
     * @param $derniere
     *
     * @return string
     */
    public static function paginer($id_cat, $nb_results, $nb_results_p_page, $numero_page_courante, $nb_avant, $nb_apres, $premiere, $derniere)
    {
        if($nb_results > $nb_results_p_page){
            if($id_cat){
                define('URL_MODULE', WEBSITE_URL.'/articles/home/'.$id_cat);
            }else{
                define('URL_MODULE', WEBSITE_URL.'/articles/home/');
            }
            // Initialisation de la variable a retourner
            $resultat = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
            // nombre total de pages
            $nb_pages = ceil($nb_results / $nb_results_p_page);
            // nombre de pages avant
            $avant = $numero_page_courante > ($nb_avant + 1) ? $nb_avant : $numero_page_courante - 1;
            // nombre de pages apres
            $apres = $numero_page_courante <= $nb_pages - $nb_apres ? $nb_apres : $nb_pages - $numero_page_courante;
            // premiere page
            if ($premiere && $numero_page_courante - $avant > 1)
            {
                $resultat .= '<li class="page-item"><a href="'. URL_MODULE .'?page=1#list" title="Première page"  class="page-link">&laquo;&laquo;</a></li>';
            }
            // page precedente
            if ($numero_page_courante > 1)
            {
                $resultat .= '<li class="page-item"><a href="'. URL_MODULE.'?page='. ($numero_page_courante - 1) .'#list" title="Page précédente '. ($numero_page_courante - 1) . '"  class="page-link">&laquo;</a><li>&nbsp;';
            }
            // affichage des numeros de page
            for ($i = $numero_page_courante - $avant; $i <= $numero_page_courante + $apres; $i++)
            {
                // page courante
                if ($i == $numero_page_courante)
                {
                    $resultat .= '<li class="page-item active"><div  class="page-link">' . $i . '</div></li>';
                }
                else
                {
                    $resultat .= '<li class="page-item"><a href="'. URL_MODULE .'?page='. $i .'#list" title="Consulter la page '. $i . '"  class="page-link">' . $i . '</a></li>';
                }
            }
            // page suivante
            if($numero_page_courante < $nb_pages)
            {
                $resultat .= '<li class="page-item"><a href="'. URL_MODULE .'?page='. ($numero_page_courante + 1) .'#list" title="Consulter la page '. ($numero_page_courante + 1) . ' !"  class="page-link">&raquo;</a></li>&nbsp;';
            }
            // derniere page
            if ($derniere && ($numero_page_courante + $apres) < $nb_pages)
            {
                $resultat .= '<li class="page-item"><a href="'. URL_MODULE .'?page='. $nb_pages .'#list" title="Dernière page"  class="page-link">&raquo;&raquo;</a></li>&nbsp;';
            }
            $resultat .= '<ul></nav>';
            return $resultat;
        }
    }
    static function edit($id, $edit, $rang = null){
        if($rang == 10)
        return '<a href="'.WEBSITE_URL.'/articles/editarticle/'.$id.'" class="btn btn-outline-warning float-right">'.$edit.'</a>';
    }

}