<?php
/**
 * 这个文件提供快速获得用户头像的途径
 * 在使用方法的php或html文件的header中引用此php文件以使用方法
 * 复制以下以引用 include('get_avatar.php');
 * @author Toichi Tanaka, if any question, connect me through 11911421@mail.sustech.edu.cn
 * @function 
 */

/**
 * Default db connection parameters
 * $host = "xdm72191586.my3w.com";
 * $user = "xdm72191586";
 * $dbpassword = "Hdj13752854072";
 * $dbname = "xdm72191586_db";
 * $table = "users";
 * @param int $id table中的决定性属性，唯一确定用户身份 
 *  @return boolean 如果表中存在该id的用户则返回true并在方法中echo头像的地址(Address of avatar); 如果表中不存在该id的用户则返回false
*/
function echo_avatar_default($id)
{
    $host = "xdm72191586.my3w.com";
    $user = "xdm72191586";
    $dbpassword = "Hdj13752854072";
    $dbname = "xdm72191586_db";
    $table = "users";
    $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($conn,$sql); 
    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($users as $users_a){
      if($users_a['id'] == $id){
        // $current_user=$users_a;
        echo($users_a["avatar"]);
        return true;
        break;
      }
    }
    return false;
}

/**
 * @param int $id table中的决定性属性，唯一确定用户身份 
 * @return string 如果表中存在该id的用户则返回头像的地址(Address of avatar); 如果表中不存在该id的用户则触发一个错误提示
*/
function get_avatar_default($id)
{
    $host = "xdm72191586.my3w.com";
    $user = "xdm72191586";
    $dbpassword = "Hdj13752854072";
    $dbname = "xdm72191586_db";
    $table = "users";
    $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($conn,$sql); 
    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($users as $users_a){
      if($users_a['id'] == $id){
        // $current_user=$users_a;
        return $users_a["avatar"];
        break;
      }
    }
    trigger_error("变量值必须小于等于 1",E_USER_WARNING);
}

/**
 * @param string $host 数据库服务器主机域名或IP地址
 * @param string $user 数据库用户名
 * @param string $dbpassword 数据库用户密码
 * @param string $dbname 数据库名称
 * @param string $table 数据库操作的表单名称
 * @param int $id table中的决定性属性，唯一确定用户身份 
 * @return string 如果表中存在该id的用户则返回头像的地址(Address of avatar); 如果表中不存在该id的用户则触发一个错误提示
*/
function get_avatar_infor(string $host, string $user, string $dbpassword, string $dbname, string $table, int $id)
{
    $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($conn,$sql); 
    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($users as $users_a){
      if($users_a['id'] == $id){
        // $current_user=$users_a;
        return $users_a["avatar"];
        break;
      }
    }
    trigger_error("变量值必须小于等于 1",E_USER_WARNING);
}

/**
 * @param string $host 数据库服务器主机域名或IP地址
 * @param string $user 数据库用户名
 * @param string $dbpassword 数据库用户密码
 * @param string $dbname 数据库名称
 * @param string $table 数据库操作的表单名称
 * @param int $id table中的决定性属性，唯一确定用户身份 
 * @return boolean 如果表中存在该id的用户则返回true并在方法中echo头像的地址(Address of avatar); 如果表中不存在该id的用户则返回false
*/
function echo_avatar_infor(string $host, string $user, string $dbpassword, string $dbname, string $table, int $id)
{
    $conn = mysqli_connect($host,$user,$dbpassword,$dbname);
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($conn,$sql); 
    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($users as $users_a){
      if($users_a['id'] == $id){
        // $current_user=$users_a;
        echo($users_a["avatar"]);
        return true;
        break;
      }
    }
    return false;
}
