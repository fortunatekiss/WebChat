/**
 * Created by lenovo on 2018/1/15.
 */
var url = "/WebChat/BackEnd/dialog.php";
var userIP;
var serverAvr = "../avatar/server.jpeg";
var response;
window.msgData;
window.userAvatar;

//加载页面
function load() {
    $.ajaxSetup({async: false});
    $.getJSON("/WebChat/BackEnd/loadMsg.php", function (data) {
        window.msgData = data.msgInfo;
        window.userAvatar = data.userAvr;
        userIP = data.userIP;
    });
    for (var i = 0; i < window.msgData.length; i++) {
        var content = '<div class="user">' +
            '<div class="userMsg">' +
            '<span class="userReply">' + window.msgData[i] + '</span>' +
            '<i class="userTriangle"></i>' +
            '</div><img class="userAvatar" src="' + window.userAvatar + '"/></div>';
        document.write(content);
        var serverReply = '<div class="server" id=' + i + '>' +
            '<img class="serverAvatar" src="' + serverAvr + '"/>' +
            '<div class="serverMsg">' +
            '<span class="serverReply">你好，这里是服务器~</span>' +
            '<i class="serverTriangle"></i>' +
            '</div> </div>';
        document.write(serverReply);
    }
}

//发送消息
function send() {
    var length = window.msgData.length - 1;
    var msgText = document.getElementById("inputText").value;
    $("#inputText").val('');
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: JSON.stringify({
            "msg": msgText,
            "userIP": userIP,
        }),
        success: function (data) {
            if (data.status == '0') {
                type = data.type;
                response = data.msg;

                var content = '<div class="user">' +
                    '<div class="userMsg">' +
                    '<span class="userReply">' + msgText + '</span>' +
                    '<i class="userTriangle"></i>' +
                    '</div><img class="userAvatar" src="' + data.userAvr + '"/></div>';
                var serverReply = '<div class="server" id=' + window.msgData.length + '>' +
                    '<img class="serverAvatar" src="' + serverAvr + '"/>' +
                    '<div class="serverMsg">' +
                    '<span class="serverReply">你好，这里是服务器~</span>' +
                    '<i class="serverTriangle"></i>' +
                    '</div> </div>';

                if (length > -1) {
                    $("#" + length).after(serverReply).after(content);
                } else {
                    $("#dialog").append(content).append(serverReply);
                }

            }
        }
    });
}
