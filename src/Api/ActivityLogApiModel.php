<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.08.2018
 * Time: 13:34
 */

namespace App\Api;
class ActivityLogApiModel
{
    public $id;

    public $log;

    private $links = [];

    public function addLink($ref, $url)
    {

    }

    public function getLinks(){
        return $this->links;
    }
}