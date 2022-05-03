<!-- This file in chinese named 个人空间 主页 -->
<!-- To avoid rendering problems, I change its name into english -->
<!-- TODO - 由于“个人空间 主页” 与“个人空间 收藏” 对数据库的操作基本一样，考虑到前端同学将重新coding，因此暂不对main_space做修改 -->
<?php
include "connect_to_db.php";
include "connect_to_db_user.php";
include "connect_to_db_article.php";
// Use $information[xx] to get the information.
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>个人空间 主页</title>
  <link rel="stylesheet" href="../web version 1 (3)(1)/web version 1/css/eg2.css">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial;
      padding: 10px;
      background: #f1f1f1;
      margin-left: 0px;
    }

    /* 头部标题 */
    .header {
      padding: 30px;
      text-align: center;
      background: white;
    }

    .header h1 {
      font-size: 50px;
    }

    /* 导航条 */
    .topnav {
      overflow: hidden;
      background-color: #333;
    }

    /* 导航条链接 */
    .topnav a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    /* 链接颜色修改 */
    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }

    .clasify_button {
      border: none;
      background-color: #aaa;
      height: 60px;
      font-size: 20px;
      width: 120px;
    }

    /* 创建两列 */
    /* Left column */
    .leftcolumn {
      margin-left: 50px;
      float: left;
      width: 70%;
    }

    /* 右侧栏 */
    .rightcolumn {
      float: right;
      width: 25%;
      background-color: #f1f1f1;
      padding-left: 20px;
    }

    /* 图像部分 */
    .fakeimg {
      background-color: #aaa;
      width: 90%;
      margin: 0 5%;
      padding: 80px;
      height: 300px
    }

    /* 文章卡片效果 */
    .card {

      background-color: white;
      padding: 30px;
      margin-top: 20px;
      font-family: Arial;
      height: 250px;

    }

    /* 列后面清除浮动 */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* 底部 */
    .footer {
      padding: 20px;
      text-align: center;
      background: #ddd;
      margin-top: 20px;
    }


    /* 响应式布局 - 屏幕尺寸小于 800px 时，两列布局改为上下布局 */
    @media screen and (max-width: 800px) {

      .leftcolumn,
      .rightcolumn {
        width: 100%;
        padding: 0;
      }
    }

    /* 响应式布局 -屏幕尺寸小于 400px 时，导航等布局改为上下布局 */
    @media screen and (max-width: 400px) {
      .topnav a {
        float: none;
        width: 100%;
      }
    }
  </style>
</head>

<body>


  <div class="topnav">
    <a href="#">
      <img class="sdimlogo" src="../web version 1 (3)(1)/web version 1/images/LOGO.jpg" alt="sdim 的logo">
    </a>
    <a href="#" class="normala">分类</a>
    <a href="#" class="normala">发布</a>
    <a href="#" class="normala">管理</a>
    <div class="Search">
      <input type="text" class="search" placeholder="搜点啥吧">
      <button>
        <i>搜！</i>
      </button>
    </div>
    <a href="#" class="normala" style="float:right">收藏</a>
    <a href="#" class="normala" style="float:right">关注</a>
    <a href="#" style="float:right" class="usericon">
      <img class="icon" src="../web version 1 (3)(1)/web version 1/images/icon.jpg" />
    </a>
  </div>

  <div class="secondnav">

    <input type="button" class="clasify_button" value="分类">
    <input type="button" class="clasify_button" value="分类">
  </div>


  <div class="box1" style="margin: 5%;margin-bottom: 0; width: 40%;height: 120px; float: left">
    <img src="../img/杜证件照2.jpg" width="70" height="100" alt="" />
    <p1 style=" text-align: left; font-size: 18px;"></p1>

  </div>
  <div cliass="admin" style="float: right;margin: 5%;margin-bottom: 0; width: 40%;height: 120px;">
    <!--<a href="#" class="admin2">设置时权限</a> -->
    <input type="button" size="60px" value="设置状态">
    <br>
    <br>
    <input type="button" size="60px" value="管理权限">
  </div>



  <div class="box2">
    <a href="Individual_main_space.php">
      <input style="border: none; font-size: 30px" type="button" value="我的发布">
    </a>
    <a href="Individual_collection.php">

      <input style="border: none; font-size: 30px" type="button" value="收藏">
    </a>
    <a href="Individual_space_setting.php">

      <input style="border: none; font-size: 30px" type="button" value="设置">
    </a>
  </div>


  <div class="row">
    <div class="leftcolumn">
      <div class="card">
        <div class="封面">
          <img src="../img/银行卡正面.jpg" width="300px" height="180px" alt="" />

        </div>
        <div class="artical_information">
          <input style="border: none;background-color: white;font-size: 30px;" type="button" value="文章标题">　　
          <br>
          <br>

          <span style="font-family:'宋体';word-spacing:  4rem;">　　状态：审核中 点赞数：</span>
          <span style="font-family: '华文新魏'; padding-right: 150px;float: right">发布时间</span>
          <br>
          <span style="font-family:'宋体';">　　审核评价</span>

          <input type="button" style="margin-right: 20px; float:right;color: red;" value="取消发布">

          <h4>　摘要：　<span style="font-family:'宋体';">　这里写摘要</span></h4>
        </div>

      </div>




    </div>
    <div class="rightcolumn">
      <div class="card">
        <h2>关于我们</h2>
        <div class="fakeimg" style="height:100px;">图片</div>
        <p>关于我的一些信息..</p>
      </div>
      <div class="card">
        <h3>热门文章</h3>
        <div class="fakeimg">
          <p>图片</p>
        </div>
        <div class="fakeimg">
          <p>图片</p>
        </div>

      </div>
      <div class="card">
        <h3>关注我</h3>
        <p>一些文本...</p>
      </div>
    </div>
  </div>

  <div class="footer">
    <h2>底部区域</h2>
  </div>

</body>

</html>