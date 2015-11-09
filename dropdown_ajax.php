<?php
	header('Content-type: application/json');
	include_once('connection.php');
	
	ob_start();
	session_start();
	
	$destination = "";
	$source1     = "";
	$source2     = "";
	
	$id			= isset($_POST['id'])  ?  htmlentities($_POST['id'])  : "";
	$type		= isset($_POST['type'])  ?  htmlentities($_POST['type'])  : "";
	
	
		$destination	.= '<select class="form-control" name="rd" id="rd'.$id.'">';
		$source1	.= '<select class="form-control" name="rs" id="rs'.$id.'">';
		$source2	.= '<select class="form-control" name="rt" id="rt'.$id.'">';
		$sql = "SELECT id,addressname, address , defaultvalue ,updatedvalue FROM register WHERE id NOT IN ('33','34')";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						 // output data of each row
						 
						 while($row = $result->fetch_assoc()) {
						
							$address = $row["addressname"];
							$val = $row["address"];
							$defaultValue = $row["defaultvalue"];
							$updateValue = $row["updatedvalue"];
							
							
							$updateVal = (!empty($updateValue) && $updateValue!='0000000000000000') ? $updateValue : $defaultValue; 
							 
							 $destination .= '<option value ="'.$val.'">'.$row['addressname'].'</option>';
							 $source1 .= '<option value ="'.$val.'">'.$row['addressname'].'</option>';
							 $source2 .= '<option value ="'.$val.'">'.$row['addressname'].'</option>';
						 }
					} else {
						     $destination .= '<option>- No Records Found -</option>';
							 $source1 .= '<option>- No Records Found -</option>';
							 $source2 .= '<option>- No Records Found -</option>';
					}
		
		$destination	.= '</select>';
		$source1	.= '</select>';
		$source2	.= '</select>';
		//$tablerow	.= '<td class="center" colspan="5">- No Records Found -</td>';
		//$tablerow	.= '</tr>';

	
	$dataArray			= array('destination'=>$destination,'source1'=>$source1,'source2'=>$source2);
	
	echo json_encode($dataArray);
	exit;
	
	ob_end_flush();
?>
