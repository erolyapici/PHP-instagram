<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 06/03/15
 * Time: 10:47
 */

class Subscriptions extends Instagram{
    public function __construct(InstagramConfig $object){
        parent::__construct($object);
    }

    public function set($params){
        $params['callback_url'] = urlencode($this->object->getCallBackUrl());
        $params['hub.mode'] = 'subscribe';
        $params['client_id']  = $this->object->getClientId();
        $params['client_secret']  = $this->object->getClientSecret();
        return $this->call('subscriptions/',false, $params, 'POST');
    }

    public function setUser(){
        $this->set(
            array(
                'object' => 'user',
                'aspect' => 'media'
            )
        );
    }

    /**
     * @param $object_id
     * @return bool|mixed
     */
    public function setTag($object_id){
        return $this->set(
            array(
                'object' => 'tags',
                'aspect' => 'media',
                'object_id' => $object_id
            )
        );
    }

    /**
     * @param $object_id
     */
    public function setTLocation($object_id)
    {
        $this->set(
            array(
                'object' => 'location',
                'aspect' => 'media',
                'object_id' => $object_id
            )
        );
    }

    /**
     * @param $lat
     * @param $lng
     * @param $radius
     */
    public function setTGeo($lat,$lng,$radius){
        $this->set(
            array(
                'object' => 'location',
                'aspect' => 'media',
                'lat'    => $lat,
                'lng'    => $lng,
                'radius' => $radius,
            )
        );
    }

    /**
     * @param $params
     * @throws Exception
     */
    public function delete($params){
        $this->call('subscriptions',true,$params,'DELETE');
    }
}