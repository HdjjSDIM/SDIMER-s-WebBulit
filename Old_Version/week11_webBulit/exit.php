<?php

header("Content-type: text/html; charset=utf-8");
session_start();
// if(isset($_SESSION['username'])){
    //要清除会话变量，将$_SESSION超级全局变量设置为一个空数组
    $_SESSION = array();
    //如果存在一个会话cookie，通过将到期时间设置为之前1个小时从而将其删除
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-3600);
    }
    //使用内置session_destroy()函数调用撤销会话
    session_destroy();
// }
//location首部使浏览器重定向到另一个页面
$home_url = 'Page.html';
header('Location:'.$home_url);



            
?>