<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>personal_zone_share</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/fdl_week12_css.css">

  <style>

  </style>
</head>

<body>
  <?php 
  include('header_include.php');
  // include('get_avatar.php');
   ?>
  <?php
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
  // $current_user = "";
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
      <img class="icon" style="float: left;" src=<?php echo_avatar_default($current_user["id"])?> alt="">
      <div class="name_zone" style="	margin-bottom: 10%;"><?php echo $current_user['nickName'] ?>的空间</div>
    </div>

    <div class="information_card">
      <p><strong> 账号:</strong>　<?php echo $current_user['username'] ?>　<strong> &nbsp &nbsp &nbsp &nbsp昵称:</strong>　<?php echo $current_user['nickName'] ?>　　</p>
      <br>
      <p> <strong>爱好／特长：</strong> <?php echo $current_user['habbits'] ?></p>

      <br>
      <p><strong> 电话:</strong>　<?php echo $current_user['telephoneNum'] ?>　<strong> </p>

    </div>
  </div>

  <!-- 下面建立一个个（文章）卡片 -->
  <!-- html和css来建立好的卡片排版的参考 - https://code.z01.com/v4/components/card.html -->
  <!-- 可能只会建立一个以作演示 -->
  <div class="container">
    <div class="card" style="max-width: 1000px;">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img src="source/sdim_1.jpg" class="card-img" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated a long time ago</small></p>
            <a href="https://www.bilibili.com/">
              <button type="button" class="btn-secondary btn-sm">Go and See</button>
            </a>
          </div>
        </div>
      </div>
    </div>

    <br>

    <div class="container">
    <div class="card" style="max-width: 1000px;">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img src="source/sdim_1.jpg" class="card-img" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated a long time ago</small></p>
            <a href="https://www.bilibili.com/">
              <button type="button" class="btn-secondary btn-sm">Go and See</button>
            </a>
          </div>
        </div>
      </div>
    </div>

  <!-- <div class="leftcolumn">
    <div class="card">
      <div class="封面">
        <img src="source/文章.png" width="230px" height="150px" alt="" />

      </div>
      <div class="artical_information">
        <input style="border: none; background:none; font-size: 30px;" type="button" value="文章标题">　　
        <br>


        <span style="font-family:'宋体';word-spacing:  4rem;">　作者：</span>
        <span style="font-family: '华文新魏'; padding-right: 150px;float: right">发布时间</span>
        <br>


        <input type="button" class="button_1" style="margin-left:  5px" value="取消发布">

        <h4>　摘要：　<span style="font-family:'宋体';">　这里写摘要 我想知道这里面的字体大于一行的时候它的排版我想知道这里面的字体大于一行的时候它的排版我想知道这里面的字体大于一行的时候它的排版我想知道这里面的字体大于一行的时候它的排版 <span style="color: #FD3134">右边操作栏会往下退，所以摘要字数要在100字以内</span></span></h4>
      </div>

    </div>

  </div> -->
  <div class="footer">
    <h2>SDIM欢迎你</h2>
  </div>

</body>

</html>