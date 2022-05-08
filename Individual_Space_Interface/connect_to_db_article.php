<?php
    $witer_id = 1; // Change this value referring to different users / authors
    // SQL sentence to excute the command
    $sql = "SELECT * FROM artical WHERE writer_id = $witer_id";

    // If you have cookies reserved, use the command like this:
    // $XXX = XXX
    // $sql = "SELECT * FROM user WHERE XXX ='$XXX'";

    $query_result_information = mysqli_query($connection,$sql);
    
    // We use assoc style here. You can acquire the return information through both numeric id or string key.
    $information_article = mysqli_fetch_all($query_result_information,MYSQLI_ASSOC);
?>