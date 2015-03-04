<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 04/03/15
 * Time: 20:04
 */

class Locations extends Instagram{
    /**
     * @param InstagramConfig $object
     */
    public function __construct(InstagramConfig $object){
        parent::__construct($object);
    }
    /**
     * Get information about a location.
     * @param int $location_id
     * @return bool|array
     * @throws Exception
     */
    public function get($location_id){
        return $this->call('locations/' . $location_id, true);

    }

    /**
     * Get a list of recent media objects from a given location. May return a mix of both image and video types.
     * @param $location_id
     * @param $min_timestamp
     * @param $max_timestamp
     * @param $min_tag_id
     * @param $max_tag_id
     * @return bool|mixed
     * @throws Exception
     */
    public function getRecent($location_id,$min_timestamp, $max_timestamp, $min_tag_id, $max_tag_id){
        return $this->call('locations/' . $location_id . '/media/recent', true,array(
            'min_timestamp' => $min_timestamp,
            'max_timestamp' => $max_timestamp,
            'min_id' => $min_tag_id,
            'max_id' => $max_tag_id
        ));

    }

    /**
     * Search for a location by geographic coordinate
     * @param $lat
     * @param $lng
     * @param int $distance
     * @param null $facebook_places_id
     * @param null $foursquare_id
     * @param null $foursqeare_V2_id
     * @return bool|mixed
     * @throws Exception
     */
    public function search($lat, $lng , $distance = 1000, $facebook_places_id  = null,$foursquare_id = null, $foursqeare_V2_id = null){
        return $this->call('locations/search', true,array(
            'lat' => $lat,
            'lng' => $lng,
            'distance' => $distance,
            'facebook_places_id'=> $facebook_places_id,
            'foursquare_id'     => $foursquare_id,
            'foursquare_v2_id'  => $foursqeare_V2_id
        ));

    }

}