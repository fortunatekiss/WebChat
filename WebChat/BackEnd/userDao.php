<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/16
 * Time: 14:25
 */
class userDao
{
    public $tableName = 'userInfo';
    public $dao;

    public function __construct()
    {
        require_once("dao.php");
        $this->dao = new dao($this->tableName);
    }

    //根据mac地址获取用户头像
    public function getAvatarByUserIP($userIP)
    {
        $userObj = '`avatar`';
        $userCond = '`userIP` = "' . $userIP . '"';
        $userInfo = $this->dao->Query($userObj, $userCond);
        if (!empty($userInfo)) {
            return $userInfo;
        }
        return;
    }

    //添加用户
    public function addUser($userIP)
    {
        $object = '`userIP`';
        $condition = '"' . $userIP . '"';
        $this->dao->Insert($object, $condition);
    }
}