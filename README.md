简易WebChat
因为没有注册登录功能，暂用客户端ip唯一标识用户
页面加载所有与服务器的聊天记录
输入新消息并发送，服务器自动返回一条消息

服务器：Apache 2.4
        可在局域网内通过ip访问
        外网暂时无法访问

前端：HTML+CSS+JQuery /FormEnd
      home.html 首页
      home.css 首页布局文件
      home.js 首页JavaScript文件

后端：PHP 5.6 /BackEnd
      loadMsg.php 获取客户端ip及加载页面
      dialog.php 新消息存入处理
      DialogDao.php 消息表dao层
      userDao.php 用户信息表dao层
      dao.php 数据库交互


数据库：MySQL 5.7
建表语句：

----------------------------------------------------------------------------------------+
| userinfo | CREATE TABLE `userinfo` (
  `userIP` varchar(20) NOT NULL,
  `avatar` varchar(100) DEFAULT '../avatar/user.jpg',
  PRIMARY KEY (`userIP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |


----------------------------------------------------------------------------------------+
| dialoginfo | CREATE TABLE `dialoginfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chatWith` varchar(20) NOT NULL,
  `userIP` varchar(20) NOT NULL,
  `msgInfo` varchar(50) NOT NULL,
  `TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userIP` (`userIP`),
  CONSTRAINT `dialoginfo_ibfk_1` FOREIGN KEY (`userIP`) REFERENCES `userinfo` (`userIP`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 |	


其他：/avatar
      用户及服务器头像（暂无上传头像功能，所以用户头像都是一样的）

      /截图
      局域网内不同ip访问效果
