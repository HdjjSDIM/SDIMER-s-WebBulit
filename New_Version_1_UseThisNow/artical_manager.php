<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理文章</title>
	<link rel="stylesheet" href="css/fdl_week12_css.css">
	
<style>

</style>
</head>
<body>
<?php include('header_include.php')?>
  <?php
    $current_user_permission=$_SESSION['permission'];
    $current_user_username=$_SESSION['username'];
    $current_user_id=$_SESSION['id'];
  ?>
  <?php
    //取出所有的user信息
    $conn = mysqli_connect('localhost','root','','prototype_week9');
    $sql = 'SELECT * FROM users';
    $result = mysqli_query($conn,$sql); 
    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);?>
  <?php
    //取出所有待审核文章信息
    $sql = 'SELECT * FROM artical';
    $conn = mysqli_connect('localhost','root','','prototype_week9');
    $result2 = mysqli_query($conn,$sql); 
    $artical = mysqli_fetch_all($result2,MYSQLI_ASSOC);
  ?>
  <?php
  header("Content-type: text/html; charset=utf-8");
  // 从数据库取出数据
  // $host = "localhost";
  // $user = "root";
  // $dbpassword = "";
  // $dbname = "prototype_week9";
  
  // 创建连接
  $conn = new mysqli($host, $user, $dbpassword, $dbname);
  $sql = "SELECT id, date, content FROM messages";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    }
  }
  ?>
<nav>  <!--This stands for navigation links -->
  <div class="btn-container">
      <span class="strip-1"></span>
      <span class="strip-2"></span>
      <span class="strip-3"></span>
      <span class="strip-4"></span>
      <span class="strip-5"></span>
      <span class="strip-6"></span>
      <span class="strip-7"></span>
      <!-- <button class="btn">
          SDIMER'S
      </button>
  </div>
  <div class="nav-links">

      <ul>
          <li><a class="usericon" href=""><img class="icon" src="source/space_earth.jpg" alt="qwq"></a></li>
          <li><a href="">关注</a></li>
          <li><a href="Sorting_Page.html">收藏</a></li>
          <li><a href="">发布</a></li>
          <li><a href="">管理</a></li>

      </ul>
  </div> -->

</nav>
<div class="secondnav">
  <form action="" method="get">
    <?php
      //这一部分的目的就是获取数据库中的“分类”的名称并显示在导航栏下方
         //连接到数据库
         $conn = mysqli_connect('localhost','root','','prototype_week9');
        //检查连接是否成功
      if(!$conn){
        echo '连接错误：'.mysqli_connect_error();
       }
       //向数据表orders发起一个检索，获取所有下单信息
      $sql = 'SELECT * FROM artical_classification';
      //执行插入的查询语句
      $result = mysqli_query($conn,$sql); 
      //获取记录,并保存为数组
      $classification = mysqli_fetch_all($result,MYSQLI_ASSOC);?>
      <?php foreach($classification as $classification){ ?>
<?php }?>
      <input type="submit" class="zone_classify" value="文章管理" name="location"> 
			<input type="submit" class="zone_classify" value="新增用户" " name="location"  > 
			<input type="submit" class="zone_classify" value="风格管理" name="location" >
        <?php
        if(isset($_GET['location'])){
          if($_GET['location']=="文章管理")
        {
          $jump="artical_manager.php";
        }
        if($_GET['location']=="新增用户")
        {
          $jump="user_register.php";
        }
        
          header("Location:$jump");
        }

        ?> 

         
  </form>
</div>


<div class="biao_ti">
	<h2>文章管理</h2></div>

	
  <?php foreach($artical as $artical){ ?>
        <?php foreach($users as $users1){
          if($users1['id']==$artical['writer_id']){
            $current_users_name=$users1['username'];
            break;
          }
        }?>
	  <div class="leftcolumn" >
    <div class="card">
			<div class="封面">
		<img src="images/<?php echo $artical['artical_cover']?>" width = "230px" height ="150px" alt=""/>
		
		</div>
		<div class="artical_information">

	</div>
		<div class="artical_information">
    <form action="unpassed_article_show.php" method="get">
            <input type="hidden" value="<?php echo $artical['uid'];?>" name="current_artical_id">
            <input style="border: none; background:none; font-size: 30px;" type="submit" value="<?php echo $artical['artical_title']?>">
          </form>
		 <!-- <input style="border: none; background:none; font-size: 30px;"	type="button"  value="文章标题">　　 -->
		<br>
	
			
			<span style="word-spacing:  4rem;">
      发布用户：<?php echo $current_users_name?></span>
			<span style=" padding-right: 150px;float: right">
      发布时间：<?php echo $artical['upload_time']?></span>
			<br>
	
		<h4>　摘要：<?php echo $artical['artical_abstract']?>　<span style="font-family:'宋体';">　<span style="color: #FD3134"></span></span></h4>
	


    
         <form action="" method="post">
         <input type="hidden" style="float:right" name="current_artical_id_2" value="<?php echo $artical['uid']?>">
          <select class="not" name="comment">
            <option value="qaq">你是猪</option>
            <option value="qwq">我是你爹</option>
            <option value="qqq">不会发文章就不要发</option>
            <option value="qrq">ppp</option>
          </select>
		  <input type="submit" style="float:right;	margin: 0 10px;height: 20px;width: 50px;" name="unpassed" value="不通过">
          <input type="submit" style="float:right;	margin: 0 10px;height: 20px;width: 50px;" name="passed" value="通过">
          <?php
          
          if(isset($_POST['unpassed'])){
            $conn = mysqli_connect('localhost','root','','prototype_week9');
            $sql = 'SELECT * FROM artical';
            $result = mysqli_query($conn,$sql); 
            $current_artical = mysqli_fetch_all($result,MYSQLI_ASSOC);
            //检查连接是否成功
            foreach($current_artical as $u){
              if($u['uid']==$_POST['current_artical_id_2']){
                $comment1=$_POST['comment'];
                $uid=$_POST['current_artical_id_2'];
                mysqli_query($conn,"INSERT INTO unpassedarticle SELECT *  FROM artical WHERE uid=$uid");
                mysqli_query($conn,"DELETE FROM artical WHERE uid=$uid");
                mysqli_query($conn,"UPDATE unpassedarticle SET comment='$comment1' WHERE uid=$uid");
              }
            }
          }
          if(isset($_POST['passed'])){
            $conn = mysqli_connect('localhost','root','','prototype_week9');
            $sql = 'SELECT * FROM artical';
            $result = mysqli_query($conn,$sql); 
            $current_artical = mysqli_fetch_all($result,MYSQLI_ASSOC);
            //检查连接是否成功
            foreach($current_artical as $u){
              if($u['uid']==$_POST['current_artical_id_2']){
                $comment1="通过";
                $uid=$_POST['current_artical_id_2'];
                mysqli_query($conn,"INSERT INTO passedarticle SELECT *  FROM artical WHERE uid=$uid");
                mysqli_query($conn,"DELETE FROM artical WHERE uid=$uid");
              }
            }
          }
          ?>
         
        </form>
    </div>
    <?php }?>
</div>
</div>
<div class="footer">
  <h2>底部区域</h2>
</div>

</body>
</html>