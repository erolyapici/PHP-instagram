<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 23/02/15
 * Time: 20:18
 */

class InstagramConfig {
    /**
     * The Instagram API Key
     *
     * @var string
     */
    public $clientId;

    /**
     * The Instagram OAuth API secret
     *
     * @var string
     */
    public $clientSecret;

    /**
     * The redirect URL
     *
     * @var string
     */
    public $redirectUrl;
    /**
     * The callback URL for real time
     *
     * @var string
     */
    public $callBackUrl;

    public function setClientId($clientKey){
        $this->clientId = $clientKey;
    }
    public function getClientId(){
        return $this->clientId;
    }

    public function setClientSecret($secretKey){
        $this->clientSecret = $secretKey;
    }
    public function getClientSecret(){
        return $this->clientSecret;
    }
    public function setRedirectUrl($redirectUrl){
        $this->redirectUrl = $redirectUrl;
    }
    public function getRedirectUrl(){
        return $this->redirectUrl;
    }
    public function setCallBackUrl($callBackUrl){
        $this->callBackUrl = $callBackUrl;
    }
    public function getCallBackUrl(){
        return $this->callBackUrl;
    }
}