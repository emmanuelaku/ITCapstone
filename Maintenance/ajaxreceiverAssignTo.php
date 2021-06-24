<?php
    include('processingAssignTo.php');
    $newobj = new processingAssignTo();

    if(isset($_POST['assignToname'],$_POST['getentryID'])){
        $assignToentryID = $_POST['assignToname'];
        $entryID = $_POST['getentryID'];

        $newobj->getdata($assignToentryID,$entryID);
    }
?>