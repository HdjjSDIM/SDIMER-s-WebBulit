<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<?php include('header_include.php')?>
<title>用户注册</title>
	<link rel="stylesheet" href="css/fdl_week12_css.css">
	
<style>

</style>
</head>
<body>
    
<?php
   
    function checkInfo($Data)
    {
        $Data = trim($Data); //清除data中的空格
        $Data = htmlspecialchars($Data); //将html的特殊字符转化掉，避免被控制
        $Data = stripslashes($Data); //去除反斜杠（转义字符，可以用作恶意代码）
        return $Data;
    }



    //其实php可以不用给初始值，但是担心后面的echo要打印会报错，所以给出
    $username  = "";
    $isInfoAvailable = false;
    //错误提示信息，在输入框旁边显示，初始值是必填项目
    $errorusername  = "必填项目";

    //下面开始判断信息是否为空，是否合法
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST["username"])) {
            //改写错误提示信息即可
            $errorusername = "学号不能为空";
        } else {
            if (!preg_match("/^[0-9]{8}$/", $_POST["username"])) {
                $errorusername = "学号格式错误";
            } else {
                $username = checkInfo($_POST["username"]);
                $isInfoAvailable = true;
            }
        }
        
    }



    if ($isInfoAvailable == true) {
        $coon = mysqli_connect($host, $user,$dbpassword,$dbname); //大范围到小范围，服务器到数据库
        if (!$coon) {
            die("connect failed");
        } else {
            // echo "connect success!";
        }
        $sql = "SELECT username FROM users WHERE username= '$username' ";
        $result = mysqli_query($coon, $sql); //返回的是结果集 不是布尔
        $resultOfCheck = mysqli_fetch_assoc($result);
        if ($resultOfCheck) {
            $errorusername = "用户名已经存在";
        } else {
            $sql = "INSERT INTO users(username,nickName,password)VALUES( '$username','$username','$username')";
            if (mysqli_query($coon, $sql)) {
                // echo "注册成功";
                $sql = "SELECT username FROM users WHERE username= '$username' ";
                $result = mysqli_query($coon, $sql); //返回的是结果集 不是布尔
                $resultOfCheck = mysqli_fetch_assoc($result);
               if($resultOfCheck){
                 $errorusername="注册成功";
               }
            } else {
                echo "注册失败";
            }
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
          SDIMER'S -->
      <!-- </button> -->
  </div>
  <!-- <div class="nav-links">

      <ul>
          <li><a class="usericon" href=""><img class="icon" src="source/space_earth.jpg" alt="qwq"></a></li>
          <li><a href="">关注</a></li>
          <li><a href="Sorting_Page.html">收藏</a></li>
          <li><a href="">发布</a></li>
          <li><a href="">管理</a></li>

      </ul>
  </div> -->
  
</nav>
  <div >
    <span class="zone_classify"><a href="artical_manager.php" >文章管理</a></span>
    <span class="zone_classify" ><a href="user_register.php" style="color:blue;">用户新增</a></span>
  </div>
<div class="secondnav">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   <div class="biao_ti">
	<h2>用户注册</h2></div>

  <div class="leftcolumn" >
    <div class="card" style="height: 250px;text-align: center;line-height: 50px;padding:  100px;"  >
	  
		<label> 用户名</label>
      <input  type="text" style=" width:600px;height: 20px;" name = "username"/> 
      <?php
      echo $errorusername;
      ?>

		  <input type="submit" style="width: 80px;height: 30px;" value="注册" name="submit"/>
		
    </div>

</div>
  </form>
</div>




<div class="footer">
  <h2>底部区域</h2>
</div>

</body>
</html>