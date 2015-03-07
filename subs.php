<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 07/03/15
 * Time: 14:19
 */

require_once '../curl/Curl.php';
require_once 'src/InstagramConfig.php';
require_once 'src/Instagram.php';
require_once 'src/Subscriptions.php';

$config = new InstagramConfig();
$config->setClientId('45df629562f545da8cfc32791206167c');
$config->setClientSecret('b0ff39c9d2674bbabc72d947967a245c');
$config->setRedirectUrl('http://projects/PHP/instagram/');
$config->setCallBackUrl('http://www.erlypci.com/instagram/callback.php');
$link = "";
$subs = new Subscriptions($config);
$post = $subs->getParams();

$a = $subs->setTag("galatasaray");
$error = $subs->getErrors();
$params = $subs->getParams();
var_dump($params);
var_dump($error);
var_dump($post);
var_dump($a);