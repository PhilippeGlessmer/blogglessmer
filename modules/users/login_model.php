<?
if(!empty($_POST)) {
    $login = Users::login($_POST['email'], $_POST['password']);
    if($login){
        //$login->setFlash('success', 'Vous êtes bien connecté');
    }
}
require_once 'modules/users/login_view.php';
?>