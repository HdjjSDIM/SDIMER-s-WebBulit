<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>personal_zone_setting</title>
  <link rel="stylesheet" href="css/fdl_week12_css.css">
</head>

<body>


  <?php 
  include('header_include.php');
  // include('get_avatar.php');
  ?>
  <?php
  // $current_user = "";
  if (isset($_SESSION['username'])) {
    $current_user_permission = $_SESSION['permission'];
    $current_user_username = $_SESSION['username'];
    $current_user_id = $_SESSION['id'];
  } else {
    $current_user_permission = 2;
    $current_user_username = "";
    $current_user_id = "";
  } ?>

  <?php
  //取出所有的user信息
  $conn = mysqli_connect($host, $user, $dbpassword, $dbname);
  $sql = 'SELECT * FROM users';
  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($users as $users1) {
    if ($users1['id'] == $current_user_id) {
      $current_user = $users1;
    }
  }
  ?>
  <?php
  if (isset($_POST['submit'])) {

    $input_g_1 = $current_user['nickName'];
    $input_g_2 = $current_user['password'];
    $input_g_3 = $current_user['habbits'];
    $input_g_4 = $current_user['telephoneNum'];
    $target_picture = $current_user['avatar'];
    if ($_POST['nickName'] != "") {
      $input_g_1 = $_POST['nickName'];
    }
    if ($_POST['password'] != "") {

      $input_g_2 = $_POST['password'];
    }
    if ($_POST['habbits'] != "") {

      $input_g_3 = $_POST['habbits'];
    }
    if ($_POST['telephoneNum'] != "") {

      $input_g_4 = $_POST['telephoneNum'];
    }

    if (isset($_FILES["avatar_picture"]["error"])) {
      $allowedExts = array("gif", "jpeg", "jpg", "png");
      $temp = explode(".", $_FILES["avatar_picture"]["name"]);
      $extension = end($temp);        // 获取文件后缀名
      if ((($_FILES["avatar_picture"]["type"] == "image/gif")
          || ($_FILES["avatar_picture"]["type"] == "image/jpeg")
          || ($_FILES["avatar_picture"]["type"] == "image/jpg")
          || ($_FILES["avatar_picture"]["type"] == "image/pjpeg")
          || ($_FILES["avatar_picture"]["type"] == "image/x-png")
          || ($_FILES["avatar_picture"]["type"] == "image/png"))
          && ($_FILES["avatar_picture"]["size"] < 1024000)    // Size of picture should be less than 1000 kb
          && in_array($extension, $allowedExts)
      ) {
        if ($_FILES["avatar_picture"]["error"] > 0) {
          echo "错误：" . $_FILES["avatar_picture"]["error"] . "<br>";
        } else {
          define('NEW_PATH_photo', 'images/usericon/');   //Avatar图片保存地址
          $input_g_5 = "avatar-" . $current_user['id'];
          $target_picture = NEW_PATH_photo . $input_g_5 .".". $extension; //images文件夹路径与图片名称拼接，作为新的相对地址
          $old_path = $_FILES["avatar_picture"]["tmp_name"]; //在这里使用@让php不报出undefined index的warning,这个warning并不有任何实际影响
          if (move_uploaded_file($old_path, $target_picture)) 
          {
            echo ('It works');
          } else {
            echo "We can not move the photo-avatar to the right place. Check it again!";
          }
        }
      } else {
        echo "非法的文件格式";
      }
    }

    //连接到数据库
    $conn = mysqli_connect($host, $user, $dbpassword, $dbname);
    $query = "UPDATE users SET nickName='$input_g_1', password='$input_g_2',avatar= '$target_picture',telephoneNum =  '$input_g_4',habbits = '$input_g_3'  WHERE id = '$current_user_id'  ";
    mysqli_query($conn, $query);
  }
  ?>
  <?php
  //取出所有的user信息
  $conn = mysqli_connect($host, $user, $dbpassword, $dbname);
  $sql = 'SELECT * FROM users';
  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($users as $users1) {
    if ($users1['id'] == $current_user_id) {
      $current_user = $users1;
    }
  }
  ?>


  <div class="secondnav">
    <li><a href="personal_zone_share_week13.php" class="zone_classify">我的发布</a></li>
    <li><a href="personal_zone_collect_week13.php" class="zone_classify">收藏</a></li>
    <li><a href="personal_zone_setting.php" class="zone_classify">设置</a></li>
  </div>

  <div class="box1">
    <div class="tou_xiang" style="">
      <img class="icon" style="float: left;" src=<?php echo_avatar_default($current_user["id"])?> alt=<?php $current_user['nickName'] ?>> <!-- TODO - 在server上检查setting中修改avatar的功能是否正常运行 -->
      <div class="name_zone" style="	margin-bottom: 10%;"><?php echo $current_user['nickName'] ?>的空间</div>
    </div>

    <div class="information_card">
      <p><strong> 账号:</strong>　<?php echo $current_user['username'] ?>　<strong> &nbsp &nbsp &nbsp &nbsp昵称:</strong>　<?php echo $current_user['nickName'] ?>　　</p>
      <p><strong>爱好／特长：</strong> <?php echo $current_user['habbits'] ?></p>
      <p><strong> 密码:</strong>　<?php echo $current_user['password'] ?>　<strong> </p>
      <p><strong> 电话:</strong>　<?php echo $current_user['telephoneNum'] ?>　<strong> </p>


    </div>
  </div>

  <div class="leftcolumn">
    <div class="card" style="height: 350px;">
      <h2>编辑资料</h2>

      <form method="post" action="personal_zone_setting.php" style="line-height: 40px;text-align: center;letter-spacing: 5px;font-size: 20px" enctype="multipart/form-data">

        昵称:<input type="text" style=" width:300px;height: 20px;" name="nickName">
        <br>
        密码:<input type="text" style=" width:300px;height: 20px;" name="password">

        <br>

        爱好:<input type="text" style=" width:300px;height: 20px;" name="habbits">
        <br>
        电话:<input type="text" style=" width:300px;height: 20px;" name="telephoneNum">
        <br>
        <label for="name"> 修改头像：</label>
        <!-- 参考上传文件在PHP - https://www.runoob.com/php/php-file-upload.html -->
        <input type="file" id="avatar_picture" name="avatar_picture">
        <br>
        <input type="submit" style="width: 100px;height: 30px;" value="保存&提交" name="submit">　　
        <input type="reset" style="width: 80px;height: 30px;" value="清空">
      </form>
    </div>
  </div>

  <div class="footer">
    <h2>sdim欢迎你</h2>
  </div>

</body>

</html>