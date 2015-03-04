<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 04/03/15
 * Time: 20:03
 */

class Tags extends Instagram{
    /**
     * @param InstagramConfig $object
     */
    public function __construct(InstagramConfig $object){
        parent::__construct($object);
    }
    /**
     * Get information about a tag object.
     * @param string $tag_name
     * @return bool|array
     * @throws Exception
     */
    public function get($tag_name){
        return $this->call('tags/' . $tag_name, true);

    }

    /**
     * Get a list of recently tagged media.
     * Note that this media is ordered by
     * when the media was tagged with this tag,
     * rather than the order it was posted.
     * Use the max_tag_id and min_tag_id parameters in the
     * pagination response to paginate through these objects.
     * Can return a mix of image and video types.
     * @param $tag_name
     * @param $count
     * @param $min_tag_id
     * @param $max_tag_id
     * @return bool|mixed
     * @throws Exception
     */
    public function getRecent($tag_name,$count, $min_tag_id, $max_tag_id){
        return $this->call('tags/' . $tag_name . '/media/recent', true,array(
            'count' => $count,
            'min_tag_id' => $min_tag_id,
            'max_tag_id' => $max_tag_id
        ));

    }
    /**
     * Search for tags by name. Results are ordered first as an exact match,
     * then by popularity. Short tags will be treated as exact matches.
     * @param string $tag_name
     * @return bool|array
     * @throws Exception
     */
    public function search($tag_name){
        return $this->call('tags/search?q=' . $tag_name, true);

    }
}