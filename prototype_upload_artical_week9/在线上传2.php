<em><!DOCTYPE html>
</em>
<html>
<head>
<meta charset="utf-8">
<title>在线上传1</title>
<link rel="stylesheet" href="upload_css.css">
</head>
<body>

<div class="header">
  <h1><em>SDMIERS' Website</em></h1>
  <p><em>重置浏览器大小查看效果。</em></p>
</div>

<div class="topnav">
  <em><a href="#">分类</a>
  <a href="#">搜索</a>
  <a href="#">发布</a>
  <a href="#" style="float:right">管理</a>
</em></div>

<em>
<div class="row">
  <div class="leftcolumn">
    <div class="card">
</em>
<h2><em>分享您的所知所想</em></h2>
<div class="fakeimg" style="height:200px;"><em>封面</em></div>



<form action="" enctype="multipart/form-data" method="post">  
  <span style="font-size: 18px">分类 :
    <select name = "sel1" style="width:150px">
      <?php
      //这一部分的目的就是获取数据库中的“分类”的名称并显示在框中
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
      $classification = mysqli_fetch_all($result,MYSQLI_ASSOC);
       echo json_encode($classification);?>
       <?php foreach($classification as $classification){ ?>
       <option value ="<?php echo $classification['uid'];?>" > <?php echo $classification['classification_name'];?></option>
      <?php }?>
       <ol>
      </ol>
    </select>


  标签 :
  <select name = "sel2" style="width:150px">
    <?php
        //这一部分的目的就是获取数据库中的“标签”的名称并显示在框中
       //连接到数据库
       $conn = mysqli_connect('localhost','root','','prototype_week9');
      //检查连接是否成功
    if(!$conn){
      echo '连接错误：'.mysqli_connect_error();
     }
     //向数据表orders发起一个检索，获取所有下单信息
    $sql = 'SELECT * FROM artical_label';
    //执行插入的查询语句
    $result = mysqli_query($conn,$sql); 
    //获取记录,并保存为数组
    $label = mysqli_fetch_all($result,MYSQLI_ASSOC);
     echo json_encode($label);?>
     <?php foreach($label as $label){ ?>
     <option value ="<?php echo $label['uid'];?> "> <?php echo $label['label_name'];?></option>
    <?php }?>
    <ol>
    </ol>
  </select>
  <br>
  <br>
  <p3>
    <label> 标题</label>
    <input  type="text" size = "90px" name = "title"/>
  </p3>
  <p4>
    <br>
    <label> 摘要&关键词</label>
    <input type="text" size = "80px"  name = "abstract"/>
  </p4>
  <br>
  </span></em>
    <hr size = "5px" color="#555555">
      <div class = "box2">
        <div> <span style="font-size: 18px"><em>
          <label for="name">上传封面：</label>
          <input type="file" id="avaPhoto" name="picture"/>
          <br/>
          <label for="name">上传文章：</label>
          <input type="file" id="avaPhoto" name="artical"/ >
          <br/>
          <p1>是否匿名</p1>
         <input type="radio" name = "isanonymous" value="1"/>
          是
          <input type="radio" name = "isanonymous" value="0"/>
          否
          <br>
          <input type="submit" value="提交" name="submit"/>
         </em></span></div>
      </div>
</form>
<?php
  define('NEW_PATH_photo','images/');   //文章封面保存地址
  define('NEW_PATH_artical','artical/'); //文章pdf保存地址
  if(isset($_POST['submit'])){
    echo $_POST['sel1'];
    echo $_POST['sel2'];
    echo $_POST['title'];
    echo $_POST['abstract'];
    echo $_FILES['artical']['tmp_name'];
    $target_picture = NEW_PATH_photo .$_FILES['picture']['name']; //images文件夹路径与图片名称拼接，作为新的相对地址
		$target_artical = NEW_PATH_artical .$_FILES['artical']['name'];
    $sel1=$_POST['sel1'];
    $sel2=$_POST['sel2'];
    $title=$_POST['title'];
    $abstract=$_POST['abstract'];
    $picture=$_FILES['picture']['name'];
    $artical=$_FILES['artical']['name'];
    $isanonymous=$_POST['isanonymous'];
    if(move_uploaded_file($_FILES['picture']['tmp_name'],$target_picture)&&move_uploaded_file($_FILES['artical']['tmp_name'],$target_artical)){ //转移，从原来的tmp临时文件夹转移到指定目标文件夹
      //连接到数据库
      $conn = mysqli_connect('localhost','root','','prototype_week9');
      //将：uid、分类、标签、标题、摘要、封面、文章内容、是否匿名、点赞数、收藏数、作者id  新建文章
      $query = "INSERT INTO artical VALUES(0,'$sel1','$sel2','$title','$abstract','$picture','$artical','$isanonymous','0','0','0')";
      mysqli_query($conn,$query);
     }
  }
?>
</body>
</html>


