<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/15
 * Time: 17:37
 */
class DialogDao
{
    public $tableName = 'dialogInfo';
    public $dao;

    public function __construct()
    {
        require_once("dao.php");
        $this->dao = new dao($this->tableName);
    }

    //增加消息记录
    public function addMsg($userIP, $msg, $time)
    {
        $objects = '`userIP`, `chatWith`, `msgInfo`, `time`';
        $conditions[] = '"' . $userIP . '", "server", "' . $msg . '","' . $time . '"';
        $conditions[] = '"server","' . $userIP . '", "你好，这里是服务器~","' . $time . '"';
        foreach ($conditions as $cond) {
            $insertRes[] = $this->dao->Insert($objects, $cond);
        }
        return $insertRes;
    }

    //获取消息记录
    public function getMsgByUserIP($userIP)
    {
        $objects = '`msgInfo`';
        $conditions = ' `userIP` = "' . $userIP . '" ORDER BY `time` ASC';
        $queryRes = $this->dao->Query($objects, $conditions);
        if ($queryRes != false){
            return $queryRes;
        }
        return;
    }
}