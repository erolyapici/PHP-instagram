<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 02/03/15
 * Time: 20:43
 */

class Comment extends Instagram{
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
        parent::getLoginUrl(array('comments'));
    }
    /**
     * Get a list of recent comments on a media object.
     * @param $id
     * @return bool|array
     * @throws Exception
     */
    public function get($id){
        return $this->call('media/' . $id .'/comments', false);

    }

    /**
     * Create a comment on a media object.
     * @param $id
     * @param $text
     * @return bool|array
     * @throws Exception
     */
    public function set($id,$text){
        return $this->call('media/' . $id .'/comments',true,array('text' => $text), 'POST');
    }

    /**
     * Remove a comment either on the authenticated user's media object or authored by the authenticated user.
     * @param $media_id
     * @param $comment_id
     * @return bool|arrray
     * @throws Exception
     */
    public function delete($media_id, $comment_id){
        return $this->call('media/' . $media_id .'/comments/'. $comment_id,true,array(), 'DELETE');
    }
}