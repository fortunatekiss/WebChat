<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/15
 * Time: 20:17
 */

//获取客户端ip
$userIP = $_SERVER['REMOTE_ADDR'];
$data['userIP'] = $userIP;

//根据ip查找消息记录及用户信息（头像）
$data['msgInfo'] = array();
require_once("userDao.php");
$userDao = new userDao();
$userAvatar = $userDao->getAvatarByUserIP($userIP)->fetch_assoc();
if (!empty($userAvatar)) {
    $data['userAvr'] = $userAvatar['avatar'];
    require_once("DialogDao.php");
    $dialogDao = new DialogDao();
    $queryRes = $dialogDao->getMsgByUserIP($userIP);
    if (count($queryRes) > 0) {
        while ($row = $queryRes->fetch_assoc()) {
            array_push($data['msgInfo'], $row['msgInfo']);
        }
    }
} else {
    //若为新用户，则userInfo表中插入用户信息
    $userDao->addUser($userIP);
}

echo json_encode($data);
