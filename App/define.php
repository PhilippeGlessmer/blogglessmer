<?php
// --------------------------- //
//       ERRORS DISPLAY        //
// --------------------------- //

//!\\ A enlever lors du déploiement
//error_reporting(E_ERROR | E_PARSE);
//ini_set('display_errors', true);


// --------------------------- //
//          SESSIONS           //
// --------------------------- //


//ini_set('session.cookie_lifetime', false);
//session_start();

// --------------------------- //
//         CONSTANTS           //
// --------------------------- //

// Paths
define("PATH_REQUIRE", substr($_SERVER['SCRIPT_FILENAME'], 0, -9)); // Pour fonctions d'inclusion php
define("PATH", 'https://blog.glessmer.fr/'); // Pour images, fichiers etc (html)
define("DOMAINE",$_SERVER['HTTP_HOST']);
define("URL","https://".$_SERVER['HTTP_HOST']);
// Website informations
define("WEBSITE_TITLE", "");
define("WEBSITE_NAME", "Exercice5");
define("WEBSITE_URL", "https://blog.glessmer.fr");
//define("WEBSITE_DESCRIPTION", "");
//define("WEBSITE_KEYWORDS", "");
define("WEBSITE_LANGUAGE", "FR");
define("WEBSITE_AUTHOR", "GLESSMER Philippe");
define("WEBSITE_AUTHOR_MAIL", "philippe@glessmer.fr");

// Facebook Open Graph tags
//define("WEBSITE_FACEBOOK_NAME", "");
//define("WEBSITE_FACEBOOK_DESCRIPTION", "");
//define("WEBSITE_FACEBOOK_URL", "");
//define("WEBSITE_FACEBOOK_IMAGE", "");

// DataBase informations
define("DATABASE_HOST", "localhost");
define("DATABASE_NAME", "blog");
define("DATABASE_USER", "glessmerblog");
define("DATABASE_PASSWORD", "r!Kt4a68");

// Data Google Captchat
define("CLE_CAPT_GOOGLE", '6Ld8C7gUAAAAALTPdRuzHZyBblvg-zVGqbMVMy90');
define("SECRET_CLE_CAPT_GOOGLE", '6Ld8C7gUAAAAADCIad2eijanx6SbSveE70KyL8QT');
// Language
define("DEFAULT_LANGUAGE", "fr");

define("CLE_GOOGLE", 'AIzaSyBjG61ugoD9sx78ZMbDAbhX1z-RXKqa2XY');