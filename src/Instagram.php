<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 23/02/15
 * Time: 20:17
 */

class Instagram {
    /**
     * The API base URL
     */
    const API_URL = 'https://api.instagram.com/v1/';

    /**
     * The API OAuth URL
     */
    const API_OAUTH_URL = 'https://api.instagram.com/oauth/authorize';

    /**
     * The OAuth token URL
     */
    const API_OAUTH_TOKEN_URL = 'https://api.instagram.com/oauth/access_token';
    /**
     * @var InstagramConfig
     */
    private $object;
    /**
     * The user access token
     *
     * @var string
     */
    private $accesstoken;

    /**
     * Whether a signed header should be used
     *
     * @var boolean
     */
    private $signedheader = true;

    /**
     * Available scopes
     *
     * @var array
     */
    private $scopes = array('basic', 'likes', 'comments', 'relationships');

    /**
     * Available actions
     *
     * @var array
     */
    private $actions = array('follow', 'unfollow', 'block', 'unblock', 'approve', 'deny');
    /**
     * @var array
     */
    private  $params = array();

    public function __construct(InstagramConfig $object){
        $this->object = $object;
    }

    /**
     * @param array $scope
     * @return string
     */
    public function getLoginUrl($scope = array('basic'))
    {
        if (is_array($scope) && count(array_intersect($scope, $this->scopes)) === count($scope)) {
            return self::API_OAUTH_URL.'?client_id='.$this->object->getClientId().'&redirect_uri='.$this->object->getRedirectUrl().'&scope='. implode('+', $scope) . '&response_type=code';
        }
    }

    /**
     * Access Token Setter
     * $_GET['code'] or object
     * @param object|string $data
     * @return void
     */
    public function setAccessToken($data) {
        (true === is_object($data)) ? $token = $data->access_token : $token = $data;
        $this->accesstoken = $token;

    }

    /**
     * Access Token Getter
     *
     * @return string
     */
    public function getAccessToken() {
        return $this->accesstoken;
    }

    /**
     * @param $code
     * @return bool|mixed
     */
    public function getOAuthToken($code){
        $apiData = array(
            'grant_type'      => 'authorization_code',
            'client_id'       => $this->object->getClientId(),
            'client_secret'   => $this->object->getClientSecret(),
            'redirect_uri'    => $this->object->getRedirectUrl(),
            'code'            => $code
        );
        return $this->callOAuth($apiData);
    }

    /**
     * @param array $apiData
     * @return bool|mixed
     */
    protected function callOAuth(array$apiData){
        $apiHost = self::API_OAUTH_TOKEN_URL;
        $curl = new Curl($apiHost);
        $curl->setPostFields($apiData);
        $curl->setHttpHeader($this->getJsonHeader());
        $curl->setReturnTransfer(true);
        $curl->setSSLVerifypeer(false);
        $jsonData = $curl->getResponse();
        $curl->close();
        if($jsonData !== false){
            return json_decode($jsonData);
        }
        return false;
    }

    /**
     * @param $function
     * @param $auth
     * @param null $params
     * @param string $method
     * @return bool|mixed
     * @throws Exception
     */
    protected function call($function, $auth, $params = null,  $method = 'GET'){
        if(false === $auth){
            $authMethod = '?client_id='.$this->object->getClientId();
        }else{
            if($this->getAccessToken() !== null){
                $authMethod = '?access_token='.$this->getAccessToken();
            }else {
                throw new \Exception("Error: call() | $function - This method requires an authenticated users access token.");
            }
        }

        if(empty($params)){
           $params = $this->getParams();
        }
        if (isset($params) && is_array($params)) {
            $paramString = '&' . http_build_query($params);
        } else {
            $paramString = null;
        }

        $url = self::API_URL . $function . $authMethod . (('GET' === $method) ? $paramString : null);
        // signed header of POST/DELETE requests
        $headerData = $this->getJsonHeader();
        if (true === $this->signedheader && 'GET' !== $method) {
            $headerData[] = 'X-Insta-Forwarded-For: ' . $this->getSignHeader();
        }
        $curl = new Curl($url);
        $curl->setHttpHeader($headerData);
        $curl->setConnectTimeOut(20);
        $curl->setReturnTransfer(true);
        $curl->setSSLVerifypeer(false);

        if('POST' === $method){
            $curl->setPost($params);
        }else{
            $curl->setCustomRequest('DELETE');
        }

        $jsonData = $curl->getResponse();
        $curl->close();
        if(false === $jsonData){
            return false;
        }
        return json_decode($jsonData);
    }


    /**
     * @param string $id
     * @param array $params
     * @return bool|array
     * @throws Exception
     */
    public function getUserFollows($id = 'self', $params = array()){
        return $this->call('users/' . $id . '/follows', true, $params);

    }
    /**
     * @param string $id
     * @param array $params
     * @return bool|array
     * @throws Exception
     */
    public function getUserFollower($id = 'self', $params = array()){
        return $this->call('users/' . $id . '/followed-by', true, $params);

    }
    /**
     * @param string $id
     * @param array $params
     * @return bool|array
     * @throws Exception
     */
    public function getUserRelationship($id = 'self', $params = array()){
        return $this->call('users/' . $id . '/relationship', true, $params);

    }/**
     * @param string $id
     * @param array $params action => 'follow/unfollow/block/unblock/approve/ignore'
     * @return bool|array
     * @throws Exception
     */
    public function setUserRelationship($id = 'self', $params = array()){
        return $this->call('users/' . $id . '/relationship', true, $params, 'POST');

    }
    /**
     * @return array
     */
    public function getParams(){
        return $this->params;
    }

    /**
     * @param array $array
     */
    public function setParams(array$array){
        $this->params = $array;
    }

    /**
     * Enforce Signed Header
     *
     * @param boolean $signedHeader
     * @return void
     */
    public function setSignedHeader($signedHeader) {
        $this->signedheader = $signedHeader;
    }
    /**
     * @return string
     */
    private function getSignHeader(){
        $ipAddress = $_SERVER['SERVER_ADDR'];
        echo $ipAddress;
        $signature = hash_hmac('sha256', $ipAddress, $this->object->getClientSecret(), false);
        return join('|', array($ipAddress, $signature));
    }
    /**
     * @return array
     */
    protected function getJsonHeader(){
        return array('Accept: application/json');
    }
}