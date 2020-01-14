<?
session_start();
require_once 'App/define.php';
require_once 'App/functions.php';
require_once('App/Autoloader.php');
Autoloader::register();
require_once '_config/db.php';
//$Session = new FlashMessage();
//$Sessions = new FlashMessage();
$_SESSION['lang'] = getUserLanguage();
$lang = getPageLanguage($_SESSION['lang'], ['librairie']);
ob_start();
if (!empty($_GET['module'])){
    $module = 'modules/' . $_GET['module'] . '/';
    $action = (!empty($_GET['action'])) ? $_GET['action'] . '_model.php' : 'home_model.php';
    if (is_file($module . $action)){
        include $module . $action;
    }else{
        require_once 'assets/templates/default.php';
    }
}else{
    require_once 'assets/templates/default.php';
}
$content = ob_get_clean();
require_once 'assets/index.php';
