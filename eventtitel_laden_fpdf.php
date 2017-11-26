<?php
    $_SESSION['event_title'] = null;
    $sql = "SELECT * from event where event_id = ".$_SESSION['event'];
    $res = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($res))
    {
        $_SESSION['event_title'] = $row['event_name']." ".$row['year'];
    }
?>