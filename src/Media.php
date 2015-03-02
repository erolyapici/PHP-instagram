<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 02/03/15
 * Time: 20:36
 */

class Media extends Instagram{
    /**
     * @param InstagramConfig $object
     */
    public function __construct(InstagramConfig $object){
        parent::__construct($object);
    }
    /**
     * Get information about a media object.
     * The returned type key will allow you to differentiate between image and video media.
     * Note: if you authenticate with an OAuth Token,
     * you will receive the user_has_liked key which quickly tells you whether the current user has liked this media item.
     * @param $id
     * @return bool|array
     * @throws Exception
     */
    public function get($id){
        return $this->call('media/' . $id , false);

    }

    /**
     * This endpoint returns the same response as GET /media/media-id.
     * A media object's shortcode can be found in its shortlink URL.
     * An example shortlink is http://instagram.com/p/D/
     * Its corresponding shortcode is D.
     * @param $shortCode
     * @return bool|array
     * @throws Exception
     */
    public function getShortCode($shortCode){
        return $this->call('media/shortcode/' . $shortCode , false);

    }

    /**
     * Search for media in a given area. The default time span is set to 5 days.
     * The time span must not exceed 7 days.
     * Defaults time stamps cover the last 5 days. Can return mix of image and video types.
     * @param array $params lat|min_timestamp|lng\max_timestamp|distance
     * @return bool|array
     * @throws Exception
     */
    public function search(array$params){
        return $this->call('media/search',false,$params);
    }

    /**
     * Get a list of what media is most popular at the moment. Can return mix of image and video types.
     * @return bool|array
     * @throws Exception
     */
    public function getPopular(){
        return $this->call('media/popular/',false);
    }
}