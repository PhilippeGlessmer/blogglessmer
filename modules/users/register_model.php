<?php
Users::registerUser($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['datebirth']);
require_once 'modules/users/register_view.php';
?>
