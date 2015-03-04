<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 04/03/15
 * Time: 20:04
 */

class Geographies extends Instagram{
    /**
     * @param InstagramConfig $object
     */
    public function __construct(InstagramConfig $object){
        parent::__construct($object);
    }
    /**
     * Get information about a geographies.
     * @param int $geo_id
     * @return bool|array
     * @throws Exception
     */
    public function getRecent($geo_id,$count, $min_tag_id){
        return $this->call('geographies/' . $geo_id . '/media/recent', true,array(
            'count' => $count,
            'min_id' => $min_tag_id,
        ));

    }

}