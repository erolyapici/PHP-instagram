<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 01/03/15
 * Time: 19:23
 */

require_once '../curl/Curl.php';
require_once 'src/InstagramConfig.php';
require_once 'src/Instagram.php';
require_once 'src/User.php';
require_once 'src/InstagramParamater.php';

$config = new InstagramConfig();
$config->setClientId('eb66d7e42a4048df9a94bbdb8d428312');
$config->setClientSecret('6dbadc3c781945f3ba283c584d05598d');
$config->setRedirectUrl('http://projects/PHP/instagram/user.php');


$users = new User($config);

if(isset($_GET['access_token'])){

}
elseif(isset($_GET['code'])){

    $data = $users->getOAuthToken($_GET['code']);

    $users->setAccessToken($data);
    $medias = $users->getMedia('self',2);
    var_dump($medias);
}



?>
<a href="<?php echo $users->getLoginUrl();?>">Login</a>