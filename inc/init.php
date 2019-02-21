<?php
session_start();
require './inc/fonction.php';
ini_set('display_errors', 'on');
unset($_SESSION['login']);
date_default_timezone_set('Europe/Paris');

define('URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/blog/');

/* variable d'affichage */
$affichage = "";
$erreur = "";
$page = "";
$commentaire = "";

// Invalide Email
$invalidMail = array('@yopmail.com','@laposte.net','@armyspy.com','@cuvox.de','@dayrep.com','@einrot.com','@fleckens.hu','@gustr.com','@jourrapide.com','@rhyta.com','@superrito.com','@teleworm.us','@boximail.com','@boximail.com','@boximail.com','@boximail.com','@boximail.com','@boximail.com','@getairmail.com','@zetmail.com','@vomoto.com','@clrmail.com','@vmani.com','@emlhub.com','@mozej.com','@carins.io','@goooomail.com','@ziyap.com','@sharklasers.com','@guerrillamail.info','@grr.la','@guerrillamail.biz','@guerrillamail.com','@guerrillamail.de','@guerrillamail.net','@guerrillamail.org','@guerrillamailblock.com','@guerrillamailblock.com','@spam4.me');


?>