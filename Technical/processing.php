<?php
    class processing{
        private $link;

        function __construct(){
            $this->link= new mysqli('localhost','root','asukuruk','ITcapstone');
            if(mysqli_connect_errno()){
                die ("connection failed".mysqli_connect_errno());
            }
        }

        function display(){
            $sql = $this->link->stmt_init();
            $entryID=1;
            if($sql->prepare("SELECT entryID,dueDate,zone,lane,deviceType,issueType,issueStatus FROM reported_issues ORDER BY entryID DESC")){
                $sql->bind_result($entryID,$dueDate,$zone,$lane,$deviceType,$issueType,$issueStatus);
                if($sql->execute()){
                    while($sql->fetch()){ 
?>

                        <tr>
                            <td><?php echo $entryID;?></td>
							<td><?php echo $dueDate; ?></td>
                            <td><?php echo $zone;?></td>
							<td><?php echo $lane; ?></td>
							<td><?php echo $deviceType; ?></td>
							<td><?php echo $issueType; ?></td>
							<td><p id="display"><?php echo $issueStatus;?></p></td>
                            <td>
                                <select name="issueStatus" issueStatus-entryID=<?php echo $entryID;?> id="selectissueStatus" class="selectissueStatus">
                                    <option value="" selected> ---- </option>
									<option>Acknowledged</option>
                                    <option>Inspected</option>
                                    <option>Processing</option>
                                    <option>Resolved</option>
									<option>Escalated</option>
									<option>Under Further Investigation</option>
									<option>Waiting for Parts</option>
									<option>No Issue Found</option>
									<option>Others</option>
                                </select>
							</td>
	
							<td><a href="delete.php?id=<?php echo $entryID;?>">Delete</a></td>
							
							<td><a href="editIssues.php?id=<?php echo $entryID;?>">Edit</a></td>
                        </tr>
				
            <?php   
                    }
                }
            }
        }

        function getdata($issueStatusentryID,$entryID){
            $sql = $this->link->stmt_init();
            if($sql->prepare("UPDATE reported_issues SET issueStatus=? WHERE entryID=?")){
                $sql->bind_param('si',$issueStatusentryID,$entryID);
                if($sql->execute()){
                    echo $issueStatusentryID;
                }
                else
                {
                    echo "Update Failed";
                }
            }
        }
    }
	
?>
