<em><!DOCTYPE html>
</em>
<html>

<head>
    <meta charset="utf-8">
    <title>在线上传1</title>
    <link rel="stylesheet" href="css/fdl_week12_css.css">
</head>
	<style>
		.alert-primary{
	
		color:#1D03FF;
		}
	
	</style>

<body>
    <?php include('header_include.php')?>
    <?php
    $current_user_permission=$_SESSION['permission'];
    $current_user_username=$_SESSION['username'];
    $current_user_id=$_SESSION['id'];
  ?>
        <?php
    $errors=array('sel1'=>'','sel2'=>'','title'=>'','abstract'=>'','picture'=>'请上传图片文件','artical'=>'请上传pdf文件','isanonymous'=>'',);
    define('NEW_PATH_photo','images/');   //文章封面保存地址
    define('NEW_PATH_artical','artical/'); //文章pdf保存地址
    if(isset($_POST['submit'])){
      //echo "sel1=:".$_POST['sel1'];
      $checkbox=$_POST['sel2'];
      $sel2="";
      for($i=1;$i<=sizeof($checkbox);$i++){
        $sel2=$sel2.$checkbox[$i-1];
        //echo"+1";
      }
      // echo $sel2;
      // echo $_POST['title'];
      // echo $_POST['abstract'];
      // echo $_FILES['artical']['tmp_name'];
      $target_picture = NEW_PATH_photo .$_FILES['picture']['name']; //images文件夹路径与图片名称拼接，作为新的相对地址
      $target_artical = NEW_PATH_artical .$_FILES['artical']['name'];
      $sel1=$_POST['sel1'];
      
      $title=$_POST['title'];
      $abstract=$_POST['abstract'];
      $picture=$_FILES['picture']['name'];
      $artical=$_FILES['artical']['name'];
      if(isset($_POST['isanonymous'])){
        $isanonymous=$_POST['isanonymous'];
      }
      $upload_time=date("Y-m-d");
      if($_POST['sel1']=="0"){
        $errors['sel1']='请选择分类';
      }
      if($_POST['sel2'][0]=="0"){
        $errors['sel2']="请选择标签（可多选）";
      }
      if(empty($title)){
        $errors['title']="请输入标题";
      }
      if(empty($abstract)){
        $errors['abstract']="请输入关键词、摘要";
      }
      if(empty($picture)){
        $errors['picture']="请选择封面";
      }
      if(empty($artical)){
        $errors['artical']="请上传文章";
      }
      if(empty($isanonymous)){
        $errors['isanonymous']="请选择是否匿名";
      }
      if(move_uploaded_file($_FILES['picture']['tmp_name'],$target_picture)&&move_uploaded_file($_FILES['artical']['tmp_name'],$target_artical)){ //转移，从原来的tmp临时文件夹转移到指定目标文件夹
          
          //连接到数据库
          $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
          //将：uid、分类、标签、标题、摘要、封面、文章内容、是否匿名、点赞数、收藏数、作者id  新建文章
          $query = "INSERT INTO artical VALUES(0,'$sel1','$sel2','$title','$abstract','$picture','$artical','$isanonymous','0','0','$current_user_id','$upload_time','')";
          mysqli_query($conn,$query);?>
          <meta   http-equiv = "refresh"  content = "0.1;url=http://localhost/SDIMER-s-WebBulit-main_last/SDIMER-s-WebBulit-main/week12/upload_result.php" >
          <!-- 上传成功后跳转页面 -->
      <?php }
    }
  ?>
    <div class="biao_ti">
      <h2>在线上传文章</h2></div>
      <div class="leftcolumn" >
        <div class="card4" style="height: 900px;text-align: center;line-height: 50px;padding: 0 100px;background:#FFF9F9;"  >
            <h2><em>分享您的所知所想</em></h2>
            <form name="stu_add_form" action="" enctype="multipart/form-data" method="post">
                <span style="font-size: 18px">
              <?php
                $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
                $sql = 'SELECT * FROM artical_classification';
                $result1 = mysqli_query($conn,$sql); 
                $classification = array();
                $classification = mysqli_fetch_all($result1,MYSQLI_ASSOC);
                //echo json_encode($classification);
                $conn2 = mysqli_connect($host,$user,$dbpassword,$dbname);
                $sql2 = 'SELECT * FROM artical_label ';
                $result2 = mysqli_query($conn,$sql2); 
                $label = array();
                $label = mysqli_fetch_all($result2,MYSQLI_ASSOC);
                //echo json_encode($label);
              ?>
              <script language = "JavaScript">
                var labelCount; // 存储label记录条数
                form_labels = new Array(); //储存分类下 label数据
                <?php 
                  $num2 = count($label); // $num2 获取label表中记录的个数 
                ?>
                labelCount=<?php echo $num2;?>;
                <?php 
                  for($j=0;$j<$num2;$j++) // 从 0开始取出上面 label[]中存储的专业数据填充数组 
                  { ?>
                    form_labels[<?php echo $j;?>]=new Array("<?php echo $label[$j]['uid'];?>","<?php echo $label[$j]['label_father_uid'];?>","<?php echo $label[$j]['label_name'];?>");
                  <?php }?>
                  function changeClassification(classification_uid) {
                    document.stu_add_form.sel2.length = 0;
                    var id=id;
                    var j;
                    document.stu_add_form.sel2.options[0] = new Option('==选择标签(shift多选) ==',''); // label的 value为空 ' '
                    for (j=0;j < labelCount; j++){   // 从 0开始判断 
                      if (form_labels[j][1] == classification_uid){  // if label_father_uid等于选择的分类的uid
                        document.stu_add_form.sel2.options[document.stu_add_form.sel2.length] = new Option(form_labels[j][2], form_labels[j][0]+"a");
                      }  
                    } 
                  }
              </script>
                <div>
                  分类：
                  <select name="sel1" onChange="changeClassification(document.stu_add_form.sel1.options[document.stu_add_form.sel1.selectedIndex].value)" size="1">
                    <option value="0">==请选择分类 ==</option>
                    <?php $num = count($classification); 
                      for($i=0;$i<$num;$i++){ ?>
                      <option value="<?php echo $classification[$i]['uid'];?>"><?php echo $classification[$i]['classification_name'];?></option>
                    <?php }?> 
                  </select>
                  <div class="alert-primary"><?php echo $errors['sel1'];?></div>   
                </div>
                <div>
                  标签 :
                  <select name="sel2[]"  id="sel2" size="1">
                    <option selected value="0">==选择专业 ==</option>   <?php $num = count($classification); 
                      for($i=0;$i<$num;$i++){ ?>
                      <option value="<?php echo $classification[$i]['uid'];?>"><?php echo $classification[$i]['classification_name'];?></option>
                    <?php }?> 
                  </select>
                  <div class="alert-primary"><?php echo $errors['sel2'];?></div>   <!--是否选择标签检查--!>
                </div>
              <ol>
              </ol>
          
              
            <ol>
            </ol>
          <p3>
            <label> 标题</label>
            <input  type="text" size = "90px"  name = "title"/>
            <div class="alert-primary"><?php echo $errors['title'];?></div>
          </p3>
          <p4>

            <label> 摘要&关键词</label>
            <input type="text" size = "80px"  name = "abstract"/>
            <div class="alert-primary"><?php echo $errors['abstract'];?></div>
          </p4>
          <br>
          </span></em>
                      <hr size="5px" color="#555555">
                      <div class="box2" style="line-height:30px;padding-top:20px;">
                          <div> <span style="font-size: 18px"><em>
                  <label for="name">上传封面：</label> 
                  <input type="file" id="avaPhoto" name="picture"/> <span style="font-size:15px;color:red;"></span>
                  <div class="alert-primary"><?php echo $errors['picture'];?></div>
                  <br/>
                  <label for="name">上传文章：</label>
                  <input type="file" id="avaPhoto" name="artical"/ ><span style="font-size:15px;color:red;"></span>
                  <div class="alert-primary"><?php echo $errors['artical'];?></div>
                  <br/>
                  <p1>是否匿名</p1>
                <input type="radio" name = "isanonymous" value="1"/>
                  是
                  <input type="radio" name = "isanonymous" value="0"/>
                  否
                  <br>
                  <div class="alert-primary"><?php echo $errors['isanonymous'];?></div>
           <input type="submit" style="width: 80px;height: 30px;" value="提交" name="submit"/>
                </em></span></div>
                      </div>
          </form>
        </div>
      </div>
    </div>


</body>

</html>