<?php
date_default_timezone_set('Europe/Paris');
$locale = 'fr_FR.UTF-8';
setlocale(LC_ALL, $locale);
/**
 * Permet de sécuriser une chaine de caractères
 * @param $string
 * @return string
 */
function str_secur($string) {
    return trim(htmlspecialchars($string));
}

/**
 * Debug plus lisible des différentes variables
 * @param $var
 */
function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}


/**
 * Choix de la langue du visiteur
 * @return mixed|string
 */
function getUserLanguage(){
    if(isset($_GET['lang']) && !empty($_GET['lang'])){
        $lang = str_secur(strtolower($_GET['lang']));
        $availableLanguages = ['en', 'fr'];
        return (in_array($lang, $availableLanguages)) ? $lang : DEFAULT_LANGUAGE;
    }else{
        return (isset($_SESSION['lang']) && !empty($_SESSION['lang']))? $_SESSION['lang'] : DEFAULT_LANGUAGE;
    }
}
/**
 * Afficher la langue du visiteur
 * @return mixed|string
 */
function getPageLanguage($lang, $pages){
    $dataPage = [];
    foreach ($pages as $p){
        $jsonString = file_get_contents('_lang/'.$lang.'/'.$p.'.json');
        $json = json_decode($jsonString);
        $dataPage[$p] = $json;
    }
    return (object) $dataPage;
}

/**
 * Vérification de contenu
 * @param $content
 */
function verif($content){
    if(!$content)
        header('location: '.WEBSITE_URL);
}

/**
 * Raccourcir une chaine de caractere en lui rajoutant ...
 * @param $lenght
 * @param $content
 * * @return string
 */
function sentence($lenght, $content){
    return mb_substr(strip_tags($content), 0, $lenght, "UTF-8") . ((strlen(strip_tags($content)) > $lenght) ? "…" : "");
}