<?php
include_once('connection.php');
?>
<!DOCTYPE html>
<html>
<head>
  	<title>MIPS64 Simulator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="jimstyles.css">-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>

<body>
<div>
	<table  class= "table table-responsive" border="1px solid black">
	<?php

	$sql = "SELECT * FROM instructions WHERE bin!='' AND hex!=''";
	$result = $conn->query($sql);
					if ($result->num_rows > 0) {
							 $cycle_counter = "";
							 $hex_val = "";
							 $default = "";
	echo '<tr>
									<th>&nbsp;</th>';
							$counter = GetValue('COUNT(id)','instructions','operation!=""');

							if($counter=='1'){
								$new_counter = '5';
							}else{
								$counter = $counter - 1;
								$new_counter = 5 + $counter;							
							}

							for ($val = 1; $val <= $new_counter; $val++) {
									echo '<th width="100px">Cycle '.$val.'</th>';
										
							}
	echo '</tr>';
	
							 while($row = $result->fetch_assoc()) {
								 $id    = $row['id'];
								 $label = $row["label"];
								 $name  = $row["name"];
								 $operation = $row["operation"];
								 $type = $row["type"];
								 $col1 = $row["col1"];
								 $col2 = $row["col2"];
								 $col3 = $row["col3"];
								 $bin = $row["bin"];
								 $hex = $row["hex"];
								 $next_id = $id + 1;
								 $cols = 7;							
								
								 for ($val = 1; $val <= $new_counter; $val++) {
									
									if($id==$val){
										$nc = GetValue('name','instructions','id="'.$next_id.'"');
										
										$ir .=  '<td width="100px">'.$hex.'</td>';
										$npc .= '<td width="100px">'.$nc.'</td>';
									
										for ($val = 1; $val <= $id; $val++) {
											$a_val .= '<td width="100px">&nbsp;</td>';
											$b_val	.= '<td width="100px">&nbsp;</td>';
											$imm_val .= '<td width="100px">&nbsp;</td>';
											$alu     .= '<td width="100px">&nbsp;</td>';
											$ir_decode .= '<td width="100px">&nbsp;</td>';
											$npc_decode     .= '<td width="100px">&nbsp;</td>';
										}

										/*if($type=='rtype'){
												$imm .= 'n/a';
										}else if($type=='itype'){
												if($operation=='011001'){
													$source = GetValue('updatedvalue','register','address="'.$col2.'"');
													$imm1 = hexdec($col3);
													$imm2 = hexdec($source);
													$sum = $imm1 +$imm2;
													$sum = dechex($sum);
													$count = strlen($sum);
									
													if($count!='16'){
													$zeros = '';
														$num_zeros = 16 - $count;
														for ($x = 1; $x <= $num_zeros; $x++) {
															$zeros .= '0';
														} 
														
														$imm .= $zeros.$sum;
														
													}
													
												}
												
										}

										$dec1 = hexdec($a);
										$dec2 = hexdec($rt);
										$sum = $dec1 +$dec2;
										$sum = dechex($sum);
										$count = strlen($sum);

										if($count!='16'){
											$zeros = '';
												$num_zeros = 16 - $count;
												for ($x = 1; $x <= $num_zeros; $x++) {
													$zeros .= '0';
												} 
												
												$str .= $zeros.$sum;
												
											}

										$arrVal['updatedvalue'] = $str;
										updateRecord($arrVal,'register',"addressname='$r_name'");

										
									 	$imm_val .= '<td width="100px">'.$imm.'</td>';
									    $alu     .= '<td width="100px">'.$str.'</td>';
										$wb 	 .= '<td id="wb_value">'.$r_name.": " .$str.'</td>';*/
									
									 /*}else{
										$a_val	 .= '<td width="100px">&nbsp;</td>';
										$b_val	 .= '<td width="100px">&nbsp;</td>';
										$imm_val .= '<td width="100px">&nbsp</td>';
										$alu 	 .= '<td width="100px">&nbsp</td>';
										$wb 	 .= '<td width="100px">&nbsp</td>';
									 }*/

										$a = GetValue('updatedvalue','register','address="'.$col2.'"');
										$b = GetValue('updatedvalue','register','address="'.$col1.'"');
										$rt = GetValue('updatedvalue','register','address="'.$col3.'"');
										$r_name = GetValue('addressname','register','address="'.$col1.'"');
										$ir_decode .=  '<td width="100px">'.$hex.'</td>';
										$npc_decode .= '<td width="100px">'.$nc.'</td>';

										$a_val	 .= '<td width="100px">'.$a.'</td>';
										$b_val	 .= '<td width="100px">'.$b.'</td>';

								}//1st if
							}//for
						}//while

	 echo ' <tr>
				<td>IF/ID.IR</td>';
		   echo $ir;
	 echo '</tr>';
	 echo ' <tr>
				<td>IF/ID.NPC</td>';
		   echo $npc;
	 echo '</tr>';
	 echo ' <tr>
				<td>PC</td>';
		   echo $npc;
	 echo '</tr>';
	 echo '<tr><td>&nbsp;</td></tr>';
	 echo '<tr>
				<td>ID/EX.A</td>';
		  echo $a_val;			  
	 echo '</tr>';
	 echo '<tr>
				<td>ID/EX.B</td>';
		   echo $b_val;
	echo '</tr>';
	echo ' <tr>
				<td>ID/EX.IR</td>';
		   echo $ir_decode;
	 echo '</tr>';
	 echo '<tr>
			<td>ID/EX.IMM</td>';
			echo $imm_val;
	echo '</tr>';
	echo '<tr>
			<td>ID/EX.NPC</td>';
			echo $npc_decode;
	echo '</tr>';
	echo ' <tr><td>&nbsp;</td></tr>';
	/*echo '<tr>
			 <td>EX/MEM.IR</td>';
			 echo $ir;
	echo '</tr>';
	echo '<tr>
			<td>EX/MEM.ALUoutput</td>';
		    echo $alu;
	echo '</tr>';
	echo '<tr>
			<td>EX/MEM.B</td>';
		    echo $b;
	echo '</tr>';
	echo '<tr>
			<td>EX/MEM.Cond</td>';
			echo '<td>0</td>';
	echo '</tr>';
	echo '<tr><td>&nbsp;</td></tr>';
	echo '<tr><td>WB</td>';
		echo $wb;
	echo '</tr>';*/
	
	}
?>

<!--
									<?php
										for ($val = 1; $val < 6; $val++) {
											if($val==1){
											$nc = GetValue('name','instructions','id="'.$next_id.'"');
											echo '<td width="100px">'.$nc.'</td>';											
											}else{
											echo '<td width="100px">&nbsp;</td>';
											}
											
										
										}
										
									?>	
								  </tr>
								  <tr>
									<td>PC</td>
									
									<?php
									for ($val = 1; $val < 6; $val++) {
											if($val==1){
											$nc = GetValue('name','instructions','id="'.$next_id.'"');	
											echo '<td>'.$nc.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
											
										
										}
									?>
									</td>	
								  </tr>
								  <tr><td>&nbsp;</td></tr>
								  <tr>
								  <td>ID/EX.A</td>
								  <?php
									for ($val = 1; $val < 6; $val++) {
											if($val==2){
											$a = GetValue('updatedvalue','register','address="'.$col2.'"');
											
											echo '<td>'.$a.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
								  ?></tr>
								  <tr>
								  <td>ID/EX.B</td>
								  <?php
								  for ($val = 1; $val < 6; $val++) {
											if($val==2){
											$b = GetValue('updatedvalue','register','address="'.$col1.'"');
											
											echo '<td>'.$b.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
								  ?></tr>
								  <tr>
								  <td>ID/EX.IR</td>
								  <?php
								  for ($val = 1; $val < 6; $val++) {
											if($val==2){
											
											echo '<td>'.$hex.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
											
									 	
										}
								 ?>
								</tr>
								  <tr>
								  <td>ID/EX.IMM</td>
								  <?php
								  for ($val = 1; $val < 6; $val++) {
											if($val==2){
											
											if($type=='rtype'){
												$imm = 'n/a';
											}else if($type=='itype'){
												if($operation=='011001'){
													$source = GetValue('updatedvalue','register','address="'.$col2.'"');
													$imm1 = hexdec($col3);
													$imm2 = hexdec($source);
													$sum = $imm1 +$imm2;
													$sum = dechex($sum);
													$count = strlen($sum);
									
													if($count!='16'){
													$zeros = '';
														$num_zeros = 16 - $count;
														for ($x = 1; $x <= $num_zeros; $x++) {
															$zeros .= '0';
														} 
														
														$imm = $zeros.$sum;
														
													}
													
												}
												
											}
											echo '<td>'.$imm.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
								  ?></tr>
								  <tr>
								  <td>ID/EX.NPC</td>
								  <?php
								  for ($val = 1; $val < 6; $val++) {
											if($val==2){
											$nc = GetValue('name','instructions','id="'.$next_id.'"');
											echo '<td width="100px">'.$nc.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
								  ?></tr>
								 <tr><td>&nbsp;</td></tr>
								  <tr>
									<td>EX/MEM.IR</td>
									 <?php
									 for ($val = 1; $val < 6; $val++) {
											if($val==3){
											
											echo '<td>'.$hex.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
									?>
								  </tr>
								  <tr>
									<td>EX/MEM.ALUoutput</td>
									 <?php
									 for ($val = 1; $val < 6; $val++) {
											if($val==3){
												
											$a = GetValue('updatedvalue','register','address="'.$col2.'"');
											$rt = GetValue('updatedvalue','register','address="'.$col3.'"');
											$dec1 = hexdec($a);
											$dec2 = hexdec($rt);
											$sum = $dec1 +$dec2;
											$sum = dechex($sum);
											$count = strlen($sum);
									
											if($count!='16'){
											$zeros = '';
												$num_zeros = 16 - $count;
												for ($x = 1; $x <= $num_zeros; $x++) {
													$zeros .= '0';
												} 
												
												$str = $zeros.$sum;
												
											}
											
											echo '<td>'.$str.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
									?>
								  </tr>
								  <tr>
									<td>EX/MEM.B</td>
									<?php
									for ($val = 1; $val < 6; $val++) {
											if($val==3){
											$b = GetValue('updatedvalue','register','address="'.$col1.'"');
											
											echo '<td>'.$b.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
								  ?>	
								  </tr>
								  <tr>
									<td>EX/MEM.Cond</td>
									<?php
									for ($val = 1; $val < 6; $val++) {
											if($val==3){
											
											echo '<td>0</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
								  ?>	
								  </tr>
								  <tr><td>&nbsp;</td></tr>
								   <tr>
									<td>MEM/WB.IR</td>
										<?php
										for ($val = 1; $val < 6; $val++) {
											if($val==4){
											
											echo '<td>'.$hex.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
										?>	
								  </tr>
								  <tr>
									<td>MEM/WB.LMD</td>
									<?php
										for ($val = 1; $val < 6; $val++) {
											if($val==4){
											
											echo '<td>0</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
										?>	
								  </tr>
								  <tr>
									<td>MEM/WB.AlUOUTPUT</td>
									<?php
										for ($val = 1; $val < 6; $val++) {
											if($val==4){
											
											echo '<td>'.$str.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
										?>	
								  </tr>
								  
								  <tr>
									<td>MEM[ALUOUTPUT]</td>
										<?php
										for ($val = 1; $val < 6; $val++) {
											if($val==4){
											
											echo '<td>'.$str.'</td>';
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
										?>	
								  </tr>
								  <tr><td>&nbsp;</td></tr>
								  <tr><td>WB</td>
										<?php
										for ($val = 1; $val < 6; $val++) {
											if($val==5){
											$r_name = GetValue('addressname','register','address="'.$col1.'"');
											
											echo '<td id="wb_value">'.$r_name.": " .$str.'</td>';
											$arrVal['updatedvalue'] = $str;
											updateRecord($arrVal,'register',"addressname='$r_name'");
											}else{
											echo '<td>&nbsp;</td>';
											}
										}
									
										?></tr>-->

		<!--</table>
	</td>
	</tr>-->
</table>
</div>
</body>
<?php
	function updateRecord($arrayValues, $table, $condition, $autoCommit="yes") {
    $servername = "localhost";
	$username = "root";
	$password = "123456";//burahin pag kay acer
	$dbname = "mips";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
        mysqli_autocommit($conn, false);
        

        $table_value = "";

        if (empty($arrayValues)) {
            echo "Incomplete Parameters Passed";
            die();
        }

        if (!is_array($arrayValues)) {
            echo "Parameter Passed is not an Array";
            return false;
        }

        foreach ($arrayValues as $ind => $v) {
            //$table_value .= $ind . "= '" . $v . "',";
            $firstChar	= substr($v,0,1);
            
            if($firstChar == '('){
        		$table_value .= $ind . "= " . $v . ",";
        	}else{
            	$table_value .= $ind . "= '" . $v . "',";
            }
        }

        $table_value = substr($table_value, 0, -1);
        
        try{ 

	 	 $sql 		=	"UPDATE $table SET $table_value WHERE $condition";

		    //Check if inserted to table, if not rollback
		    mysqli_query($conn, $sql);
		    if (mysqli_errno($conn)) {
		       $errno 	= mysqli_errno($conn);
			   mysqli_rollback($conn); 
				return "error";
		    } else {
		        if($autoCommit=="yes"){
		        	mysqli_commit($conn);
		        	return true;
		        }else{
		        	return true;
		        }
		    }
		 } catch (Exception $e) { 
				mysqli_rollback($conn); 
				return "error";
		}    
    }

	function GetValue($field,$fieldtable,$condition,$orderby=""){
	$servername = "localhost";
	$username = "root";
	$password = "123456";//burahin pag kay acer
	$dbname = "mips";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
		$value = '';
		$orderByClause = ($orderby)? " ORDER BY $orderby " : "";
		
		 $rec_query = "SELECT $field FROM $fieldtable WHERE $condition $orderByClause ";
		 $stmt 	= mysqli_query($conn, $rec_query);
		
		$result = (!empty($stmt)) ? $stmt->num_rows : 0;
		
		if($result > 0){
		    if ($row = mysqli_fetch_assoc($stmt)) {	 
				  $value .= stripslashes($row[''.$field.'']);
			}
		}
		return $value;
	}
?>
</html> 
