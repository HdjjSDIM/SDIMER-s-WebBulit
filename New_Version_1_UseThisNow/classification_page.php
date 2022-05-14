<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>分类与索引</title>
<link rel="stylesheet" href="css/eg2.css">
</head>
<body>
<?php include('header_include.php'); ?>

<?php
if(isset($_SESSION['username'])){
  $current_user_permission=$_SESSION['permission'];
  $current_user_username=$_SESSION['username'];
  $current_user_id=$_SESSION['id'];
}
else{
  $current_user_permission=2;
  $current_user_username="";
  $current_user_id="";
}?>
  <?php
    //取出所有的user信息
    $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
    $sql = 'SELECT * FROM users';
    $result = mysqli_query($conn,$sql); 
    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);?>
<div class="secondnav">
  <form action="" method="get">
    <?php
      //这一部分的目的就是获取数据库中的“分类”的名称并显示在导航栏下方
         //连接到数据库
         $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
        //检查连接是否成功
      if(!$conn){
        echo '连接错误：'.mysqli_connect_error();
       }
       //向数据表orders发起一个检索，获取所有下单信息
      $sql = 'SELECT * FROM artical_classification ';
      //执行插入的查询语句
      $result = mysqli_query($conn,$sql); 
      //获取记录,并保存为数组
      $classification = mysqli_fetch_all($result,MYSQLI_ASSOC);?>
      <?php foreach($classification as $classification){ ?>
        <button type="submit" class="normala2" value="<?php echo $classification['classification_name'];?>"
         name="fenqu"> <?php echo $classification['classification_name'];?>&nbsp&nbsp&nbsp&nbsp </button>
         <!--当点击导航栏下方分区按钮时，表单会传递该分区的id告诉浏览器该显示什么-->
         <?php }?>
  </form>
</div>
      
      <?php if(isset($_GET['fenqu'])){ //以下是为了读取当前分区id并在数据库中找出对应的标签?> 
        <?php
          $conn = mysqli_connect($host,$user,$dbpassword,$dbname);//下面是为了获得当前分区的id
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
          foreach($classification as $classification){
            $u=$classification['classification_name'];
            if($_GET['fenqu']==$u){
              $current_id=$classification['uid'];
              //echo $current_id;
            }
          }
        ?>
        
        <?php 
          //echo $_GET['fenqu'];
          $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
          $sql = 'SELECT * FROM artical_label';
          $result = mysqli_query($conn,$sql); 
          $label = mysqli_fetch_all($result,MYSQLI_ASSOC);
        ?>
        <?php foreach($label as $label){ ?>
          <?php if($label['label_father_uid']==$current_id){ ?>
            <form action="" class="row" method="get">
              <div class="center">
                <div class="card1" id="<?php echo $label['class_id']?>">
                    <input type="hidden" value="<?php echo $current_id?>" name="daqu_id"/>
                    <input type="hidden" value="<?php echo $label['uid']?>" name="biaoqian_id"/>
                    <div class="cardright"> 
                      <h2 class="cardtitle">
                        <div class="daquname">
                          <input type="submit" value="<?php echo $label['label_name']?>" name="biaoqian" class="daquanniu"/>
                        </div>
                      </h2>
                      <h3 class="cardqu" style="color:rgb(255, 40, 40) ;"><专区></h3>
                      <!-- <div class="daquname">
                        <input type="submit" value="游戏" name="biaoqian" class="daquanniu"/>
                      </div>
                      <!-- <h3 class="cardqu">专区</h3> --> 
                      <p class="carddis"><?php echo $label['label_infor']?></p>
                      
                      <!-- <ul style="float: left;margin: 20px 0;"> 
                        <li>
                          <a href="#"><h4>《游戏》是由尹仁浩执导，申河均、边熙峰、李慧英主演的惊悚电影</h4> </a>
                        </li>
                        <li>
                          <a href="#"><h4>《游戏》是由尹仁浩执导，申河均、边熙峰、李慧英主演的惊悚电影</h4> </a>
                        </li>
                        <li>
                          <a href="#"><h4>《游戏》是由尹仁浩执导，申河均、边熙峰、李慧英主演的惊悚电影</h4> </a>
                        </li>
                      </ul> -->
                    </div>
                    
                    <!-- <input type="submit" value="<?php echo $label['label_name']?>" name="biaoqian" class="daquanniu"/>     -->

                    <!-- <ul>
                        <li><a href="#">热门文章</a></li>
                        <li><a href="#">热门文章</a></li>
                        <li><a href="#">热门文章</a></li>
                        <li><a href="#">热门文章</a></li>
                    </ul> -->
                  </div>
                </div>
            </form>
          <?php }?>
        <?php }?>
      <?php }?>

      <?php
         //当点击大区内具体某个标签时，就会显示该标签下有哪些文章
        if(isset($_GET['biaoqian'])){?>
          <div>
            <form action="" method="post">
              <button type="submit" value="按发布时间最新排序" name="lattest_btn" class="paixu">按发布时间最新排序</button>
              <button type="submit" value="按点赞最多排序" name="likest_btn" class="paixu">按点赞最多排序</button>
              <button type="submit" value="按收藏最多排序" name="collect_btn" class="paixu">按收藏最多排序</button>
            </form>
          </div>
          <?php 
          if(isset($_POST['lattest_btn'])){
            $sql = 'SELECT * FROM passedarticle ORDER BY uid DESC';
          }
          else if(isset($_POST['likest_btn'])){
            $sql = 'SELECT * FROM passedarticle ORDER BY like_number DESC';
          }
          else if(isset($_POST['collect_btn'])){
            $sql = 'SELECT * FROM passedarticle ORDER BY collection_number DESC';
          }
          else{
            $sql = 'SELECT * FROM passedarticle ORDER BY like_number DESC';
          }
          ?>
          <?php //echo $_GET['daqu_id'];
          //echo $_GET['biaoqian_id'];
          $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
          $result = mysqli_query($conn,$sql); 
          $artical = mysqli_fetch_all($result,MYSQLI_ASSOC);?>
          <div class="row">
            <div class="center">
              <?php foreach($artical as $artical){ //遍历，将带有当前分区以及标签的文章显示出来?>
                
                <?php if($artical['artical_classification']==$_GET['daqu_id']){ ?>
                  <?php $subject =$artical['artical_label'];
                        $pattern = '/[a]+/';
                        $label_after_split=preg_split($pattern, $subject);
                  ?>
                  <?php $isshow_label=0;for($i=1;$i<=count($label_after_split);$i++){
                    //echo $label_after_split[$i-1]." ";
                    if($label_after_split[$i-1]==$_GET['biaoqian_id']){
                      $isshow_label=1;
                
                    }
                  } ?>
                  <?php if($isshow_label==1){ ?>
                    <?php
                      //取出所有的user信息
                      $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
                      $sql = 'SELECT * FROM users';
                      $result = mysqli_query($conn,$sql); 
                      $users = mysqli_fetch_all($result,MYSQLI_ASSOC);?>
                    <?php foreach($users as $users1){
                        if($users1['id']==$artical['writer_id']){
                          $current_users_name=$users1['username'];
                        }
                    }?>
                    <div class="card2">
                      <form action="article_show.php" method="get">
                        <div class="artpicm">
                          <a href="#" style="float:left" class="artpicb">
                            <img class="artpic" src="images/<?php echo $artical['artical_cover']?>" /> <!--这里的头像还不是数据库中用户的头像-->
                          </a>
                          <br>
                        </div>
                        <div class="artil">
                            <div class="artil1">
                              <div>
                                <button type="submit" value="<?php echo $artical['artical_title'];?>" name="current_artical" class="artname"/><?php echo $artical['artical_title'];?></button>
                              </div>
                              <!-- <button type="submit" value="<?php echo $artical['artical_title'];?>" name="current_artical" class="artname"/>ovo</button> -->
                              <input type="hidden" value="<?php echo $artical['uid'];?>" name="current_artical_id">
                              <!-- <input type="submit" value="<?php echo $artical['artical_title'];?>" name="current_artical"> -->
                              <div style="word-wrap: break-word;">
                                摘要：<?php echo $artical['artical_abstract'];?>
                              </div>
                            </div>
  
                            <div class="artil2">
                              <div>点赞:<?php echo $artical['like_number'];?>  
                                收藏:<?php echo $artical['collection_number'];?>
                            </div>
                            <div>
                              <!-- 发布时间 -->
                              发布时间
                              <?php echo $artical['upload_time'];?>
                            </div>
                          </div>
                        </div>
                      
                      </form>
                      
                    </div>
                  <?php }?>
                <?php }?>
              <?php }?>
            </div>
          </div>    
        <?php }?>
</body>
</html>
