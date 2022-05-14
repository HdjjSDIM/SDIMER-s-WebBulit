<section >
    <nav>  
    <div class="btn-container">
        <span class="strip-1"></span>
        <span class="strip-2"></span>
        <span class="strip-3"></span>
        <span class="strip-4"></span>
        <span class="strip-5"></span>
        <span class="strip-6"></span>
        <span class="strip-7"></span>
        <button class="btn">
            SDIMER'S
        </button>
    </div>
        <div class="nav-links">
            <!-- <i class="fa-solid fa-rectangle-xmark"></i> -->
            <!-- <i class="fa-solid fa-circle-xmark" style="font-size: 10px"></i> -->
            <!-- <i class="fa fa-times"></i> -->
            <!-- 不做icons -->
            <ul>
                <li><a class="usericon" href="login1.1.php"><img class="icon" src="source/space_earth.jpg" alt="qwq"></a></li>
                <?php session_start();?>
                <?php
                    $host="xdm72191586.my3w.com";
                    $user="xdm72191586";
                    $dbpassword="Hdj13752854072";
                    $dbname="xdm72191586_db";
                ?>
                <?php if(isset($_SESSION['username'])){ ?>
                    <?php
                        $current_user_permission=$_SESSION['permission'];
                        if($current_user_permission==1){ 
                    ?>
                            <li><a href="artical_manager.php" >管理</a></li>
                            <li><a href="upload_page.php">发布</a></li>
                            <li><a href="" >个人空间</a></li>
                            <li><a href="exit.php" >退出登录</a></li>
                        <?php }?>
                <?php }?>
                <li><a href="Contact.php">关于我们</a></li>
            </ul>
        </div>
    </nav>
  </section>