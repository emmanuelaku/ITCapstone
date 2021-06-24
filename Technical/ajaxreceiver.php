<?php
    include('processing.php');
    $newobj = new processing();

    if(isset($_POST['issueStatusname'],$_POST['getentryID'])){
        $issueStatusentryID = $_POST['issueStatusname'];
        $entryID = $_POST['getentryID'];

        $newobj->getdata($issueStatusentryID,$entryID);
    }
?>