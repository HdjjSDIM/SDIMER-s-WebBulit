<?php
echo 'You have change your account information. You need to login again to ensure your account safety.';
?>

<!DOCTYPE html>

<head></head>

<body>
    <div style="text-align:center">
        <h2 center>Click the button, jump to the former web page.</h2>
        <!-- <form method="post" action="个人空间 设置.php">
            <button type="button">我们能不能回去从前？</button> -->

        <!-- 创建一个超链接指向“个人空间 设置.php” -->
        <!-- <a type="button" href = "个人空间 设置.php">我们能不能回去从前？</a>  -->

        <!--创建一个放置在页面中间的button，点击触发后指向“个人空间 设置.php”-->
        <!--这里为了快点做完dev，我们使用的是href.在后续开发过程中注意更改使用ajax实现 -->
        <a href="./Individual_space_setting.php">
            <button type="button">我们能不能回去从前？</button>
        </a>


    </div>

</body>