<?php
    // SQL sentence to excute the command
    $sql = "SELECT * FROM users WHERE id = 3";

    // If you have cookies reserved, use the command like this:
    // $XXX = XXX
    // $sql = "SELECT * FROM user WHERE XXX ='$XXX'";

    $query_result_information = mysqli_query($connection,$sql);
    
    // We use assoc style here. You can acquire the return information through both numeric id or string key.
    $information_user = mysqli_fetch_assoc($query_result_information);
?>