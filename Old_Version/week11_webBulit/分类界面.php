<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>分类与索引</title>
  <link rel="stylesheet" href="css/eg2.css">
  <link rel="stylesheet" href="css/style.css  ">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
  <script src="index.js"></script>
</head>

<body>
  <?php include('header_include.html'); ?>
  <?php
  if (isset($_SESSION['username'])) {
    $current_user_permission = $_SESSION['permission'];
    $current_user_username = $_SESSION['username'];
    $current_user_id = $_SESSION['id'];
  } else {
    $current_user_permission = 0;
    $current_user_username = "";
    $current_user_id = "";
  } ?>
  <?php
  //取出所有的user信息
  $conn = mysqli_connect('localhost', 'root', '', 'prototype_week9');
  $sql = 'SELECT * FROM users';
  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
  <div class="secondnav">
    <form action="" method="get">
      <?php
      //这一部分的目的就是获取数据库中的“分类”的名称并显示在导航栏下方
      //连接到数据库
      $conn = mysqli_connect('localhost', 'root', '', 'prototype_week9');
      //检查连接是否成功
      if (!$conn) {
        echo '连接错误：' . mysqli_connect_error();
      }
      //向数据表orders发起一个检索，获取所有下单信息
      $sql = 'SELECT * FROM artical_classification ';
      //执行插入的查询语句
      $result = mysqli_query($conn, $sql);
      //获取记录,并保存为数组
      $classification = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
      <?php foreach ($classification as $classification) { ?>
        <input type="submit" class="normala2" value="<?php echo $classification['classification_name']; ?>" name="fenqu">
        <!--当点击导航栏下方分区按钮时，表单会传递该分区的id告诉浏览器该显示什么-->
      <?php } ?>
    </form>
  </div>

  <?php if (isset($_GET['fenqu'])) { //以下是为了读取当前分区id并在数据库中找出对应的标签
  ?>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'prototype_week9'); //下面是为了获得当前分区的id
    //检查连接是否成功
    if (!$conn) {
      echo '连接错误：' . mysqli_connect_error();
    }
    //向数据表orders发起一个检索，获取所有下单信息
    $sql = 'SELECT * FROM artical_classification';
    //执行插入的查询语句
    $result = mysqli_query($conn, $sql);
    //获取记录,并保存为数组
    $classification = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($classification as $classification) {
      $u = $classification['classification_name'];
      if ($_GET['fenqu'] == $u) {
        $current_id = $classification['uid'];
        //echo $current_id;
      }
    }
    ?>

    <?php
    //echo $_GET['fenqu'];
    $conn = mysqli_connect('localhost', 'root', '', 'prototype_week9');
    $sql = 'SELECT * FROM artical_label';
    $result = mysqli_query($conn, $sql);
    $label = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <?php foreach ($label as $label) { ?>
      <?php if ($label['label_father_uid'] == $current_id) { ?>
        <form action="" class="row" method="get">
          <!--新建一个表单,传递当前大区id和标签id-->
          <div class="leftcolumn">
            <div class="card">
              <input type="hidden" value="<?php echo $current_id ?>" name="daqu_id" />
              <input type="hidden" value="<?php echo $label['uid'] ?>" name="biaoqian_id" />
              <input type="submit" value="<?php echo $label['label_name'] ?>" name="biaoqian" class="daquanniu" />
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
            </div>
          </div>
        </form>
      <?php } ?>
    <?php } ?>
  <?php } ?>

  <?php
  //当点击大区内具体某个标签时，就会显示该标签下有哪些文章
  if (isset($_GET['biaoqian'])) { ?>
    <div>
      <form action="" method="post">
        <input type="submit" value="按发布时间最新排序" name="lattest_btn">
        <input type="submit" value="按点赞最多排序" name="likest_btn">
        <input type="submit" value="按收藏最多排序" name="collect_btn">
      </form>
    </div>
    <?php
    if (isset($_POST['lattest_btn'])) {
      $sql = 'SELECT * FROM passedarticle ORDER BY uid DESC';
    } else if (isset($_POST['likest_btn'])) {
      $sql = 'SELECT * FROM passedarticle ORDER BY like_number DESC';
    } else if (isset($_POST['collect_btn'])) {
      $sql = 'SELECT * FROM passedarticle ORDER BY collection_number DESC';
    } else {
      $sql = 'SELECT * FROM passedarticle ORDER BY like_number DESC';
    }
    ?>
    <?php //echo $_GET['daqu_id'];
    //echo $_GET['biaoqian_id'];
    $conn = mysqli_connect('localhost', 'root', '', 'prototype_week9');
    $result = mysqli_query($conn, $sql);
    $artical = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
    <div class="row">
      <div class="leftcolumn">
        <?php foreach ($artical as $artical) { //遍历，将带有当前分区以及标签的文章显示出来
        ?>

          <?php if ($artical['artical_classification'] == $_GET['daqu_id']) { ?>
            <?php $subject = $artical['artical_label'];
            $pattern = '/[a]+/';
            $label_after_split = preg_split($pattern, $subject);
            ?>
            <?php $isshow_label = 0;
            for ($i = 1; $i <= count($label_after_split); $i++) {
              //echo $label_after_split[$i-1]." ";
              if ($label_after_split[$i - 1] == $_GET['biaoqian_id']) {
                $isshow_label = 1;
              }
            } ?>
            <?php if ($isshow_label == 1) { ?>
              <?php
              //取出所有的user信息
              $conn = mysqli_connect('localhost', 'root', '', 'prototype_week9');
              $sql = 'SELECT * FROM users';
              $result = mysqli_query($conn, $sql);
              $users = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
              <?php foreach ($users as $users1) {
                if ($users1['id'] == $artical['writer_id']) {
                  $current_users_name = $users1['username'];
                }
              } ?>
              <div class="card">
                <form action="文章详细显示.html" method="get">
                  <div class="usericoni">
                    <a href="#" style="float:left" class="usericon">
                      <img class="icon" src="images/usericon/LOGO.jpg" />
                      <!--这里的头像还不是数据库中用户的头像-->
                    </a>
                    <br>
                  </div>
                  <span>发布用户：<?php echo $current_users_name ?><span></span>
                    <input type="hidden" value="<?php echo $artical['uid']; ?>" name="current_artical_id">
                    <input type="submit" value="<?php echo $artical['artical_title']; ?>" name="current_artical">
                    <div><span><img src="images/<?php echo $artical['artical_cover']; ?>" class="cover" alt="" /></span>
                      <span>摘要：<?php echo $artical['artical_abstract'] ?></span>
                      <span>发布时间：<?php echo $artical['upload_time'] ?></span>
                    </div>
                    <span></span>

                    <div>点赞数:<?php echo $artical['like_number']; ?>
                      收藏数:<?php echo $artical['collection_number']; ?>
                    </div>

                </form>

              </div>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
</body>

</html>