<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 23/02/15
 * Time: 20:46
 */
require_once 'src/Instagram.php';
require_once 'src/InstagramConfig.php';

$config = new InstagramConfig();
$config->setClientId('eb66d7e42a4048df9a94bbdb8d428312');
$config->setClientSecret('6dbadc3c781945f3ba283c584d05598d');
$config->setRedirectUrl('http://projects/PHP/instagram/');
$instagram = new Instagram($config);
if(isset($_GET['access_token'])){
    $instagram->setAccessToken(json_decode($_GET['access_token']));

    $medias = $instagram->getUserMedia();
    var_dump($medias);
}
elseif(isset($_GET['code'])){
    //$data = $instagram->getAccessToken();

    $data = $instagram->getOAuthToken($_GET['code']);
    $instagram->setAccessToken($data);

    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'&access_token='.json_encode($instagram->getAccessToken());
    Header("Location : $url");
    exit();

}



?>
<a href="<?php echo $instagram->getLoginUrl();?>">Login</a>