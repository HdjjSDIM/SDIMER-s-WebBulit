<section>
    <nav>
        <div class="btn-container">
            <span class="strip-1"></span>
            <span class="strip-2"></span>
            <span class="strip-3"></span>
            <span class="strip-4"></span>
            <span class="strip-5"></span>
            <span class="strip-6"></span>
            <span class="strip-7"></span>
            <a href="classification_page.php">
                <button class="btn">
                    SDIMER'S
                </button>
            </a>
        </div>
        <div class="nav-links">
            <?php session_start(); ?>
            <!-- <i class="fa-solid fa-rectangle-xmark"></i> -->
            <!-- <i class="fa-solid fa-circle-xmark" style="font-size: 10px"></i> -->
            <!-- <i class="fa fa-times"></i> -->
            <!-- 不做icons -->
            <ul>
                <?php
                if (isset($_SESSION['id'])) {
                    $host = "xdm72191586.my3w.com";
                    $user = "xdm72191586";
                    $dbpassword = "Hdj13752854072";
                    $dbname = "xdm72191586_db";
                    // $host="localhost";
                    // $user="root";
                    // $dbpassword="";
                    // $dbname="prototype_week9";
                    include('get_avatar.php');
                ?>
                    <li><a class="usericon" href="personal_zone_share_week13.php"><img class="icon" src= <?php echo_avatar_default($_SESSION['id'])?> alt="qwq"></a></li>
                <?php } ?>
                <?php
                if (!isset($_SESSION['id'])) { ?>
                    <li><a class="usericon" href="login.php"><img class="icon" src="source/please_login.png" alt="qwq"></a></li>
                <?php } ?>
                <li><a href="classification_page.php">主页</a></li>
                <?php if (isset($_SESSION['username'])) { ?>
                    <?php
                    $current_user_permission = $_SESSION['permission'];
                    if ($current_user_permission == 1) {
                    ?>
                        <li><a href="artical_manager.php">管理</a></li>
                        <li><a href="upload_page.php">发布</a></li>
                        <li><a href="personal_zone_share_week13.php">个人空间</a></li>
                        <li><a href="exit.php">退出登录</a></li>
                    <?php } ?>
                    <?php
                    if ($current_user_permission == 0) {
                    ?>
                        <li><a href="upload_page.php">发布</a></li>
                        <li><a href="personal_zone_share_week13.php">个人空间</a></li>
                        <li><a href="exit.php">退出登录</a></li>
                    <?php } ?>
                    <?php
                    if ($current_user_permission == 2) {
                    ?>
                        <li>you are visitor,bitch!</li>
                    <?php } ?>
                <?php } ?>

                <li><a href="https://www.sustech.edu.cn/">关于我们</a></li>
            </ul>
        </div>
    </nav>
</section>