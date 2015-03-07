<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 01/03/15
 * Time: 19:20
 */

class User extends Instagram{

    public function __construct(InstagramConfig $object){
        parent::__construct($object);
    }
    /**
     * Get basic information about a user.
     * @param $id
     * @return bool|array
     * @throws Exception
     */
    public function get($id){
        return $this->call('users/' . $id , false);

    }

    /**
     * Get the most recent media published by a user.
     * May return a mix of both image and video types.
     * @param string $id
     * @param array params count|max_timestamp|min_time_stamp|min_id|max_id
     * @return bool|mixed
     * @throws Exception
     */
    public function getMedia($id = 'self', $params = array()){
        return $this->call('users/' . $id . '/media/recent', ($id === 'self'), $params);
    }

    /**
     * See the authenticated user's feed.
     * May return a mix of both image and video types.
     * @param int $count
     * @param int $min_id
     * @param int $max_id
     * @return bool|mixed
     * @throws Exception
     */
    public function getFeed($count = 0, $min_id = 0, $max_id = 0){
        return $this->call('users/self/feed', true, array(
                'count' => $count,
                'min_id' => $min_id,
                'max_id' => $max_id,
            ));
    }

    /**
     * See the authenticated user's list of media they've liked.
     * May return a mix of both image and video types.
     * Note: This list is ordered by the order in which the user liked the media.
     * Private media is returned as long as the authenticated user has permission to view that media.
     * Liked media lists are only available for the currently authenticated user.
     * @param int $count
     * @param int $max_like_id
     * @return bool|mixed
     * @throws Exception
     */
    public function getLikes($count = 0, $max_like_id = 0){
        return $this->call('users/self/media/liked', true, array(
            'count' => $count,
            'max_like_id' => $max_like_id
        ));
    }

    /**
     * @param string $q
     * @param int $count
     * @return bool|array
     * @throws Exception
     */
    public function getSearch($q, $count = 0){
        return $this->call('users/search', true, array( 'q' => $q, 'count' => $count));
    }


}