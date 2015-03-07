<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 23/02/15
 * Time: 20:46
 */
require_once '../curl/Curl.php';
require_once 'src/InstagramConfig.php';
require_once 'src/Instagram.php';
require_once 'src/User.php';
require_once 'src/Tags.php';
require_once 'src/Subscriptions.php';
require_once 'src/InstagramParamater.php';
$config = new InstagramConfig();
$config->setClientId('45df629562f545da8cfc32791206167c');
$config->setClientSecret('b0ff39c9d2674bbabc72d947967a245c');
$config->setRedirectUrl('http://projects/PHP/instagram/');
$config->setCallBackUrl('http://www.erlypci.com/instagram/callback.php');
$link = "";
$subs = new Subscriptions($config);
if(isset($_GET['code']) && !isset($_GET['access_token'])){

    $data = $subs->getOAuthToken($_GET['code']);
   $link = 'http://projects/PHP/instagram?code='.$_GET['code'].'&access_token='.$data->access_token;

}elseif(isset($_GET['access_token'])){
    $subs->setAccessToken($_GET['access_token']);
    $a = $subs->setTag("galatasaray");
    var_dump($a);
}



?>
<a href="<?php echo $subs->getLoginUrl();?>">Login</a>
<a href="<?php echo $link;?>">Subsc</a>