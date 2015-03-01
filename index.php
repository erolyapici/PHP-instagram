<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 23/02/15
 * Time: 20:46
 */
require_once '../curl/Curl.php';
require_once 'src/Instagram.php';
require_once 'src/InstagramConfig.php';

$config = new InstagramConfig();
$config->setClientId('--clientid--');
$config->setClientSecret('--client--secret');
$config->setRedirectUrl('redirect url');
$instagram = new Instagram($config);
if(isset($_GET['access_token'])){

}
elseif(isset($_GET['code'])){

    $data = $instagram->getOAuthToken($_GET['code']);

    $instagram->setAccessToken($data);
    $medias = $instagram->getUserMedia();
    var_dump($medias);
}



?>
<a href="<?php echo $instagram->getLoginUrl();?>">Login</a>