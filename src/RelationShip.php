<?php
/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 01/03/15
 * Time: 19:20
 */

class RelationShip extends Instagram{
    /**
     * @param InstagramConfig $object
     */
    public function __construct(InstagramConfig $object){
        parent::__construct($object);
    }
    /**
     * @param array $scope
     * @return string
     */
    public function getLoginUrl($scope = array('basic'))
    {
        parent::getLoginUrl(array('relationships'));
    }
    /**
     * Get the list of users this user follows.
     * @return bool|array
     * @throws Exception
     */
    public function getRequestedBy(){
        return $this->call('users/self/requested-by',true);
    }

    /**
     * Modify the relationship between the current user and the target user.
     * @param $id
     * @param string $action One of follow/unfollow/block/unblock/approve/ignore.
     * @return bool|mixed
     * @throws Exception
     */
    public function setRelationShip($id,$action = '')
    {
        return $this->call('users/' . $id . '/relationship', true, array('action' => $action), 'POST');
    }

}