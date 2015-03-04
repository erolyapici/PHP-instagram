<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 04/03/15
 * Time: 20:03
 */

class Likes extends Instagram{
    /**
     * @param InstagramConfig $object
     */
    public function __construct(InstagramConfig $object){
        parent::__construct($object);
    }
    /**
     * @return string
     */
    public function getLoginUrl(){
        parent::getLoginUrl(array('likes'));
    }
    /**
     * Get a list of users who have liked this media.
     * @param $media_id
     * @return bool|array
     * @throws Exception
     */
    public function get($media_id){
        return $this->call('media/' . $media_id .'/likes', false);

    }

    /**
     * Set a like on this media by the currently authenticated user.
     * @param $media_id
     * @return bool|array
     * @throws Exception
     */
    public function set($media_id){
        return $this->call('media/' . $media_id .'/likes/',true,array(), 'POST');
    }

    /**
     * Remove a like on this media by the currently authenticated user.
     * @param $media_id
     * @return bool|arrray
     * @throws Exception
     */
    public function delete($media_id){
        return $this->call('media/' . $media_id .'/likes/',true,array(), 'DELETE');
    }
}