<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/15
 * Time: 17:34
 */
ini_set('date.timezone', 'Asia/Shanghai');

$contents = file_get_contents("php://input");
$params = json_decode($contents, true);
$data['status'] = 1;

$time = date("Y-m-d H:i:s", time());

$result = validate($params);

//消息存入数据库
require_once('DialogDao.php');
$dialogDao = new DialogDao();
$insertRes = $dialogDao->addMsg($result['userIP'], $result['msg'], $time);

require_once('userDao.php');
$userDao = new userDao();
$userAvatar = $userDao->getAvatarByUserIP($result['userIP'])->fetch_assoc();


if ($insertRes[0] != false) {
    $data['status'] = 0;
    //服务器自动返回消息
    $data['msg'] = "你好，这里是服务器~";
    $data['userAvr'] = $userAvatar['avatar'];
    echo json_encode($data);
}

//验证参数是否有效
function validate($params)
{
    if (!empty($params['msg'] && !empty($params['userIP']))) {
        $result['msg'] = trim($params['msg']);
        $result['userIP'] = trim($params['userIP']);
    }

    return $result;
}
