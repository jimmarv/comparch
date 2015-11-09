<?php
	header('Content-type: application/json');
	include_once('connection.php');
	
	ob_start();
	session_start();
	$hex = "";
	$type = isset($_POST['type'])  ?  htmlentities($_POST['type'])  : "";
	$operation	= isset($_POST['operation'])  ?  htmlentities($_POST['operation'])  : "";
	$rt		= isset($_POST['rt'])  ?  htmlentities($_POST['rt'])  : "";
	$rs		= isset($_POST['rs'])  ?  htmlentities($_POST['rs'])  : "";
	$rd		= isset($_POST['rd'])  ?  htmlentities($_POST['rd'])  : "";
	$cond = ($type=='rtype')? "WHERE function='$operation'" : "WHERE opcode='$operation'";
	$sql = "SELECT * FROM $type $cond";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						 
						 while($row = $result->fetch_assoc()) {
							if($type=='rtype'){
								$instruction = $row['instruction'];
								$opcode 	 = $row['opcode'];
								$fix		 = $row['fix'];
								$function	 = $row['function'];
								if($instruction=='DMULT'){
									$rd = $row['rd'];
									
								}
								$bin = $opcode.$rs.$rt.$rd.$fix.$function;
								$str = strtoUpper(dechex(bindec($bin)));
								$count = strlen($str);
									
									if($count!='8'){
									$zeros = '';
										$num_zeros = 8 - $count;
										for ($x = 1; $x <= $num_zeros; $x++) {
											$zeros .= '0';
										} 
										
										$hex = $zeros.$str;
										
									}
								//$hex    = sprintf('%08X', $hexval);
							}else if($type=='itype'){
								
								$instruction = $row['instruction'];
								$opcode  = $row['opcode'];
								
								if($instruction=='ANDI' || $instruction=='DADDIU'){
									$str  = base_convert($rt,16,2);
									$count = strlen($str);
									
									if($count!='16'){
									$zeros = '';
										$num_zeros = 16 - $count;
										for ($x = 1; $x <= $num_zeros; $x++) {
											$zeros .= '0';
										} 
										
										$str = $zeros.$str;
										
									}
									
									
									$bin = $opcode.$rs.$rd.$str;
									
								}else if($instruction=='LW' || $instruction=='LWU'){
									$str  = base_convert($rs,16,2);
									//$bin = $opcode.$rt.$rd.$rs;
									$count = strlen($str);
									
									if($count!='16'){
									$zeros = '';
										$num_zeros = 16 - $count;
										for ($x = 1; $x <= $num_zeros; $x++) {
											$zeros .= '0';
										} 
										
										$str = $zeros.$str;
										
									}
									$bin = $opcode.$rt.$rd.$str;
								}else if($instruction=='SW'){
									$str  = base_convert($rs,16,2);
									$count = strlen($str);
									
									if($count!='16'){
									$zeros = '';
										$num_zeros = 16 - $count;
										for ($x = 1; $x <= $num_zeros; $x++) {
											$zeros .= '0';
										} 
										
										$str = $zeros.$str;
										
									}
									$bin = $opcode.$rt.$rd.$str;
								}
								$hex = strtoUpper(dechex(bindec($bin)));
								//$hex = strtoUpper(base_convert($bin,2,16));
							}
						}
							
					}
	$dataArray			= array('opcodeHex'=>$hex,'opcodeBin'=>$bin);
	
	echo json_encode($dataArray);
	exit;
	
	ob_end_flush();
?>
