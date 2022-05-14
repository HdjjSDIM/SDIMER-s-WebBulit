<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>我最爱白老师的课辣</title>
  <link rel="stylesheet" href="css/eg.css">
  <link rel="stylesheet" href="css/eg2.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include('header_include.php')?>
  <?php
    if(isset($_SESSION['permission'])){
      $current_user_permission=$_SESSION['permission'];
      $current_user_username=$_SESSION['username'];
      $current_user_likedArtical=$_SESSION['likedArtical'];
      $current_user_id=$_SESSION['id'];
    }
    else{
      $current_user_permission="0";
      $current_user_username="";
      $current_user_likedArtical="";
      $current_user_id="";
    }
    
  ?>
  <!-- <div class="header">
    <h1>我的网页</h1>
    <p>重置浏览器大小查看效果。</p>
  </div> -->


  <div class="secondnav">
    <form action="classification_page.php" method="get">
      <?php
        //这一部分的目的就是获取数据库中的“分类”的名称并显示在导航栏下方
          //连接到数据库
          $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
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
      <input type="submit" class="normala2" value="<?php echo $classification['classification_name'];?>" name="fenqu">
      <!--当点击导航栏下方分区按钮时，表单会传递该分区的id告诉浏览器该显示什么-->
      <?php }?>
    </form>
  </div>
  <?php
    $current_artical_id=$_GET['current_artical_id'];
    //连接到数据库
    $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
    //检查连接是否成功
    if(!$conn){
    echo '连接错误：'.mysqli_connect_error();
    }
    //向数据表orders发起一个检索，获取所有下单信息
    $sql = 'SELECT * FROM passedarticle';
    //执行插入的查询语句
    $result = mysqli_query($conn,$sql); 
    //获取记录,并保存为数组
    $current_artical = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($current_artical as $u){
      if($u['uid']==$_GET['current_artical_id']){
        $showing_artical=$u;
      }
    }
  ?>
  <?php
    //连接到数据库
    $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
    //检查连接是否成功
    if(!$conn){
    echo '连接错误：'.mysqli_connect_error();
    }
    //向数据表orders发起一个检索，获取所有下单信息
    $sql = 'SELECT * FROM comment';
    //执行插入的查询语句
    $result = mysqli_query($conn,$sql); 
    //获取记录,并保存为数组
    $comments = mysqli_fetch_all($result,MYSQLI_ASSOC);
  ?>
  <div class="row">
    <div class="leftcolumn">
      <!--显示文章-->
      <div class="card">
        <h2>
          <?php echo $showing_artical['artical_title'];?>
        </h2>
        <h5>
          <?php echo $showing_artical['upload_time'];?>
        </h5>
        <div class="fakeimg" style="height:auto;word-wrap: break-word;">
          <?php echo $showing_artical['artical_abstract'];?>
        </div>
        <p>
          <embed src="artical/<?php echo $showing_artical['artical_pdf'];?>" style=" width: 1000px;height: 1000px;"
            hidden="ture" />
        </p>
      
      <?php if($current_user_permission==0){echo "请登录";}?>
      <?php if($current_user_permission==1||$current_user_permission==2){ ?>
        <div>
          <form action="" method="post">
            <button type="submit" id="like_btn" name="btn_like" class="" disabled="disabled"> like </button>
            <script>
              $("#btn").attr("disabled","true");
              $("#btn").attr("disabled","disabled");
              $("#btn").attr("disabled","false");
              $("#btn").removeAttr("disabled","disabled");
          </script>
            <?php
            if(isset($_POST['btn_like'])){
                $uid=$showing_artical['uid'];
              $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
              $query ="UPDATE passedarticle SET like_number=like_number+1 WHERE uid=$uid";
              mysqli_query($conn,$query);
              
              
              
             
              if($current_user_likedArtical==null){
                $query_recordLiked="UPDATE users SET likedArtical=$uid WHERE id=$current_user_id";
              mysqli_query($conn,$query_recordLiked);
              echo "<script>alert('初次点赞成功')</script>";
                }
                else{
                  $arrayLiked_old=explode("a", $current_user_likedArtical);
                  foreach ($arrayLiked_old as $articalId){
                    if($articalId==$uid){
                      
                    }
                    else{
                      $current_user_likedArtical .="a" .$uid;
              $query_recordLiked="UPDATE users SET likedArtical='$current_user_likedArtical' WHERE id=$current_user_id";
              mysqli_query($conn,$query_recordLiked);
              echo "<script>alert('点赞成功')</script>";
              
                    }

            
            } 
              }
            }
            
            //每次单机点赞后，页面会刷新并重新显示数据库中点赞数
            $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
            $sql = 'SELECT * FROM artical';
            $result = mysqli_query($conn,$sql); 
            $artical = mysqli_fetch_all($result,MYSQLI_ASSOC);
            foreach($artical as $artical){
              if($artical['uid']==$showing_artical['uid']){
                $showing_artical=$artical;
              }
            }
          ?>
            <div>
              <?php echo $showing_artical['like_number'];//显示点赞数?>
            </div>
          </form>
        </div>
        <?php
            if(isset($_POST['comment_btn'])){
              $artical_number=$showing_artical['uid'];
              $content=$_POST['comment'];
              $comment_time=date("Y-m-d");  //date("Y-m-d H:i:s")显示时间
              if(!empty($artical_number) && !empty($content)&&!empty($comment_time)){
                $adding_comment=1;
                foreach($comments as $comments1){
                  if($comments1['comment_writerid']==$current_user_id&&$comments1['content']==$content){
                    $adding_comment=0;
                  }
                }
                if($adding_comment==1){
                  $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
                  $query = "INSERT INTO comment VALUES(0,'$artical_number','$content','$comment_time','$current_user_id')";//数据库中向comment表中插入信息
                  mysqli_query($conn,$query);//操作数据库
                }
              }
          }
        ?>
        <form action="" method="post" name="comment_form">
          <div class="replytext">
            <input type="text" class="reply" placeholder="发表你的评论！" name="comment" autocomplete="off">
            <input type="submit" button class="replybtt" name="comment_btn">
            <i>回！</i>
            </button>
          </div>
        </form>
      </div>
      <?php
        $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
        //检查连接是否成功
        if(!$conn){
          echo '连接错误：'.mysqli_connect_error();
        }
        //向数据表orders发起一个检索，获取所有下单信息
        $sql = 'SELECT * FROM comment';
        //执行插入的查询语句
        $result = mysqli_query($conn,$sql); 
        //获取记录,并保存为数组
        $comment = mysqli_fetch_all($result,MYSQLI_ASSOC);
        foreach($comment as $comment){
          if($comment['artical_id']==$showing_artical['uid']){ ?>
      <div class="card">
        <div class="lou">
          <h2>
            <?php echo $current_user_username?>
          </h2>
          <?php echo $comment['comment_time']?>
          </h5>
        </div>
        <div class="ICON2">
          <a href="#" style="float:right" class="usericon">
            <img class="icon" src="images/icon.jpg" />
          </a>
        </div>
        <p>
          <?php echo $comment['content']; ?>
        </p>
      </div>
      <?php }
      } ?>

      <?php }?>
    </div>
  </div>

  <div class="footer">
    <h2>底部区域</h2>
  </div>
</body>

</html>