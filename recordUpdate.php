<?

class recordUpdate extends connectUpdate{

		private $sqlQuery;
		private $items	=	10;
		private $conn;
		private $insertHeaderId;


//**-------------RETRIEVE CUSTOM QUERY AND RETURN OBJECT FROM THE DATABASE ----------------------**/	
    public function retrieveCustomQueryObject($query){
        $conn 		= $this->getDbConnection();
        $errmsg 	= ""; 
	 	$sql 		= $query;
		//SET SQL QUERY
		self::setSqlQuery($sql);        
		$stmt = mysqli_query($conn, $sql);
        $returnArray 	= array();
        $returnArr 		= array();
        if($stmt){
		    while ($row = mysqli_fetch_object($stmt)) {
				 $returnArr[] = $row;
		    }
			mysqli_free_result($stmt);
		}
        return $returnArr;
    }
    		 
//**-------------RETRIEVE CUSTOM ENTRY FROM THE DATABASE----------------------**/
    public function retrieveCustomQuery($query) {
        $conn 		= $this->getDbConnection();        
        $errmsg 	= ""; 
		$sql = $query;
		//SET SQL QUERY
		self::setSqlQuery($sql);        
		$stmt = mysqli_query($conn, $sql);
        $returnArray 	= array();
        $returnArr 		= array();

        if($stmt){
		    while ($row = mysqli_fetch_assoc($stmt)) {
		        foreach ($row as $rowIndex => $rowValue) {
		            $returnArray[$rowIndex] = $rowValue;
		        }
		        $var 			= implode('|', $returnArray);
		        $returnArr[] 	= $var;
		    }

			mysqli_free_result($stmt);
		}
        return $returnArr;
    }

//**-------------RETRIEVE ENTRY FROM THE DATABASE----------------------**/
    public function retrieveEntry($table, $arrayValues, $jointable='', $condition) {
        $conn 		= $this->getDbConnection();
        $db_fields 	= "";
        $errmsg 	= "";

        if (empty($arrayValues)) {
            echo "Incomplete Parameters Passed";
            die();
        }

        if (!is_array($arrayValues)) {
            echo "Parameter Passed is not an Array";
            return false;
        }

        foreach ($arrayValues as $v) {
            $db_fields .= $v . ",";
        }

			$db_fields = substr($db_fields, 0, -1);

        if (!empty($condition)) {
            $condition = "WHERE $condition";
        } else {
            $condition = "";
        }

	    $sql = "SELECT $db_fields FROM $table $jointable $condition ";
		//SET SQL QUERY
		self::setSqlQuery($sql);
        
		$stmt = mysqli_query($conn, $sql);	 
		 

        $returnArray 	= array();
        $returnArr 		= array();
        
        if($stmt){

		    while ($row = mysqli_fetch_assoc($stmt)) {
		        foreach ($row as $rowIndex => $rowValue) {
		            $returnArray[$rowIndex] = $rowValue;
		        }
		        $var 			= implode('|', $returnArray);
		        $returnArr[] 	= $var;
		    }

			mysqli_free_result($stmt);
		}
        return $returnArr;
    }

//**-------------INSERT RECORDS DYNAMICALLY TO THE DATABASE----------------------**/
    public function insertRecord($arrayValues, $table, $autoCommit="yes") {
        $conn = $this->getDbConnection(); 
        mysqli_autocommit($conn, false);         
        $table_index = "";
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
            $table_index .= $ind . ",";
            $table_value .= "'" . $v . "',";
        }

        $table_index 	= substr($table_index, 0, -1);
        $table_value 	= substr($table_value, 0, -1);

  
        try{        
        	$sql = "INSERT INTO $table ($table_index) VALUES ($table_value)"; 
				mysqli_query($conn, $sql);
				if (mysqli_errno($conn)) {
		        	$errno 	= mysqli_errno($conn);
		        	mysqli_rollback($conn); 
					return "error";
            	}else{
					if($autoCommit=="yes"){
				    	mysqli_commit($conn);
				    	return true;
				    }else{
				    	return $conn;
				    }
				}    
        } catch (Exception $e) { 
				mysqli_rollback($conn); 
				return "error";
		}
    }

	//**-------------UPDATE RECORDS DYNAMICALLY TO THE DATABASE----------------------**/
    public function updateRecord($arrayValues, $table, $condition, $autoCommit="yes") {
        $conn = $this->getDbConnection();
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


//**-------------DELETE RECORD/S FROM THE DATABASE----------------------**/
    public function deleteRecord($table, $condition) {
        $conn = $this->getDbConnection();
        mysqli_autocommit($conn, false); 
		try{
		     $sql3 = "DELETE FROM `$table` WHERE $condition";
		    mysqli_query($conn, $sql3);
		    mysqli_commit($conn);
			return true;	 
		} catch (Exception $e) { 
			mysqli_rollback($conn); 
			return false;
		}  
    }


	private function setSqlQuery($sqlQuery){
		$this->sqlQuery = $sqlQuery;
	}

	public function getSqlQuery(){
		return $this->sqlQuery;
	}

	public function setItems($items){
		$this->items = $items;
	}

	public function getItems(){
		return $this->items;
	}
	 
	//PAGINATION
	public function paginationQuery($query){
		$items 										=	self::getItems();
		$pagination_array							=	array();
		$pagination 								= 	new MyPagina ();
		$pagination->sql 							= 	$query ;
	    $pagination->rows_on_page					=	$items;
	    $pagination_array['max_page']	 			=	$pagination->get_num_pages();
		$pagination_array['result']					=	$pagination->get_page_result();
		$pagination_array['num_rows']				=	$pagination->get_page_num_rows();
		$pagination_array['PAGINATION_LINKS']		=	$pagination->navigation(" | ", " | ");
		$pagination_array['PAGINATION_INFO']		=	$pagination->page_info();
		$pagination_array['PAGINATION_TOTALRECS']	=	$pagination->get_total_rows();

		return $pagination_array;
	}

	//Additional Codes
	public function GetValue($field,$fieldtable,$condition,$orderby=""){
		$value = '';
		$orderByClause = ($orderby)? " ORDER BY $orderby " : "";
		$con = $this->getDbConnection();
		 $rec_query = "SELECT $field FROM $fieldtable WHERE $condition $orderByClause ";
		$stmt 	= mysqli_query($con, $rec_query);
		$result = (!empty($stmt)) ? $stmt->num_rows : 0;
		
		if($result > 0){
		    if ($row = mysqli_fetch_assoc($stmt)) {	 
				  $value .= stripslashes($row[''.$field.'']);
			}
		}
		return $value;
	}


	//set latest header id in insert
    public function setLatestHeaderIdInsert($insertHeaderId){
		$this->insertHeaderId = $insertHeaderId;
	}

    //get latest header id in insert
	public function getLatestHeaderIdInsert(){
		return $this->insertHeaderId;
	}

	//insert transaction details
	public function insertTransactionRecords($mainArrayValues, $maintable, $detailsArrayValues, $detailtable){
   		$headerId 	= self::getLatestHeaderIdInsert(); //get the header id
   		$header = "";
   		$details = array();
   		try { 
			$header =  self::insertRecord($mainArrayValues, $maintable, "no"); //insert header record without auto commit
			 if($header!="error"){
			 	mysqli_commit($header); 			  
			 
				foreach($detailsArrayValues as $detVal){						 
					 		 $details[]  = self::insertRecord($detVal, $detailtable); //insert detailed record with auto commit					  
				}
					 if(in_array("error",$details,true)){
		  				 $headerId = self::getLatestHeaderIdInsert();
						 $fieldId 	= key($headerId);   //get the key of an array for delete condition
		 				 $fieldVal	= $headerId[$fieldId];  //get the value of an array for delete condition
						 self::deleteRecord($maintable, "$fieldId='$fieldVal'");  //delete the header if there's an error occurs in the details
						 
						 return false;
			  		}
			  }else{
			  
			  	return false;
			  }	 
			  
		} catch (Exception $e) { 
				mysqli_rollback($header);  //if error in the header it will not save and will rollback
				return $e;
		}
	}

	//IS EXISTING RECORD
	function isExist($field,$table,$condition){
		$conn = $this->getDbConnection();

		if(empty($field)){
			return "Missing Field Parameter";
		}

		if(empty($table)){
			return "Missing Table Parameter";
		}

		if(empty($condition)){
			return "Missing Condition Parameter";
		}

	 	 $sql	= "SELECT $field FROM $table WHERE $condition";
		$stmt 	= mysqli_query($conn, $sql);
		$result = (!empty($stmt)) ? $stmt->num_rows : 0;
		
		if($result > 0){
			if($row = mysqli_fetch_assoc($stmt)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	//REDIRECTION TO LISTING - AFTER CREATE < EDIT < VIEW < DELETE
	function redirection($cmp,$modname,$type,$task='',$sid='',$extra=''){
		$value='';		 		
		if($task=='view'){			
			if($type!="profile"){
				$value .= '<a href="index.php?mod='.$modname.'&type='.$type.'">Back</a>';
			}else{
				$value .= "index.php?mod=".$modname."&type=".$type."&task=".$task."&sid=".$sid."";	
			}
		}else if($task=='link'){						
				$value .= "index.php?mod=".$modname."&type=".$type."";							
		}else if($type=='bank_details'){						
			$value .= "index.php?mod=".$modname."&type=".$type."&task=".$task."&bcode=".$extra."";							
		}else{
			$value .= "index.php?mod=".$modname."&type=".$type."&task=".$task."";							
		}
		
		return $value;		
	}
	function getSeqNo($modname,$cmp=""){
	    $secArray = array('prefix','nextnumber','maximumno');
		$secVal = $this->retrieveEntry('seqcontrol',$secArray,''," modulename='$modname' AND companycode='$cmp' ORDER BY nextnumber DESC ");
		
		 foreach ($secVal as $retrieveIndex => $retValue) {
		    $$retrieveIndex = $retValue;
		    $mainVal = explode('|', $$retrieveIndex);
		    foreach ($mainVal as $mainIndex => $retrieveValue) {
		        $$secArray[$mainIndex] = $retrieveValue;
		    }
		}		
			if($maximumno < $nextnumber){
			 	$stat = 0; 
				trigger_error("Voucher number has exceeded maximum limit.",E_USER_NOTICE);
				$zero	= addLeadingZero($nextnumber, strlen($maximumno));		
				return $stat;							  
			}else{							 
				$ids = $nextnumber+1;		
				$this->updateRecord(array('nextnumber'=>$ids), 'seqcontrol', " modulename='$modname' AND prefix='$prefix' AND companycode='$cmp' ")	;								 													
				$zero	= addLeadingZero($nextnumber, strlen($maximumno));									
				return $prefix.$zero;
			}		
	}
	
	/**CUSTOMIZED QUERY FOR CREATE/TRUNCATE/DROP TABLE**/
	public function customizedQuery($query)
	{
		$conn = $this->getDbConnection();
        mysqli_autocommit($conn, false); 
		try{
		 echo   $sql 		= $query;
		    mysqli_query($conn, $sql);
		    
		    if (mysqli_errno($conn)) {
	        	$errno 	= mysqli_errno($conn);
	        	mysqli_rollback($conn); 
				return false;
        	}else{
				mysqli_commit($conn);
				return true;
			}
			
		} catch (Exception $e) { 				
			mysqli_rollback($conn); 
			return false;				
		}
	}
	
}

	function insertTransactionRecords($mainArrayValues, $maintable, $detailsArrayValues, $detailtable){
		
		$headerId 	= self::getLatestHeaderIdInsert(); //get the header id
   		if(empty($mainArrayValues) || empty($maintable) || empty($detailsArrayValues) || empty($detailtable)){
			echo "Incomplete Parameters Passed";
			die();
		}

   		try { 
			$header =  self::insertRecord($mainArrayValues, $maintable, "no"); //insert header record without auto commit
			
			 if($header!="error"){
			 	mysqli_commit($header); 			  
			 	
				foreach($detailsArrayValues as $detVal){						 
					 	 $details[]  = self::insertRecord($detVal, $detailtable); //insert detailed record with auto commit					  
				} 
				 
					 if(in_array("error",$details,true)){
			  				 $headerId = self::getLatestHeaderIdInsert();
							 $fieldId 	= key($headerId);   //get the key of an array for delete condition
			 				 $fieldVal	= $headerId[$fieldId];  //get the value of an array for delete condition
							 self::deleteRecord($maintable, "$fieldId='$fieldVal'");  //delete the header if there's an error occurs in the details
							 self::deleteRecord($detailtable, "$fieldId='$fieldVal'");  //delete the header if there's an error occurs in the details
							 return false;
			  		}
			  }else{
			  	return false;
			  }
			  
		} catch (Exception $e) { 
				mysqli_rollback($header);  //if error in the header it will not save and will rollback
				return $e;
		}
   		
	}





	function verificationEmail($companycode){
			
		$retArray = self::retrieveCustomQuery("Select u.email,u.firstname,u.lastname from users as u LEFT JOIN userscompany as us USING(username) Where us.companycode='$companycode'");	

		foreach($retArray as $retrieveIndex => $retrieveValue):
				$$retrieveIndex		= $retrieveValue;
				$mainArr			= explode('|',$$retrieveIndex);
				$email				= $mainArr[0];
				$firstname			= $mainArr[1];
				$lastname			= $mainArr[2];
		endforeach;		
			
			$msgBody	.= "<html>
							<header></header>
								<body>http://ourwebprojects.com/oojeema_online/view/html/images/logo.jpg
									<table>
										<tr backgroung-color=\"#EE3551\">
											<td><img src=\"http://ourwebprojects.com/oojeema_online/view/html/images/logo.jpg\"></td>
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr>
											<td><p>Hi $firstname $lastname</p></td>
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr>
											<td><p>Welcome to Oojeema!</p></td>
									
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td><p>To confirm your Oojeema account, please follow this link:
<a href=\"http://ourwebprojects.com/oojeema_online/index.php?verify=$email \"><button style=\"background-color:#A1BF58\"><h4>Verify email address</h4></button></a></p>
										</tr>
										<tr><td>&nbsp;</td></tr>	
										<tr>
										<td><p>

Please do not reply to this email. This mail box is not monitored and you will not receive a response. For assistance with your OOJEEMA account, please visit our FAQ page. For comment and feedback on the Oojeema service, please visit <a href=\"http://support.oojeema.com\">http://support.oojeema.com</a></p></td>
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr>
														<td align=\"center\"><h2>Thank you for signing up for <strong>OOJEEMA!</strong></h2></td>
										</tr>	
										<tr><td>&nbsp;</td></tr>
										<tr>
											<td align=\"center\"></td>
										</tr>
										<tr><td>&nbsp;</td></tr>
									</table>
								</body>
							</html>";
			
			//Sending Email to New Admin User
				$mail		=	new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
				$mail->IsSendmail(); // telling the class to use SendMail transport
				try {					
					  //$mail->AddBCC($adminemail, $adminname);
					  //$mail->AddReplyTo($email, $firstname . $lastname);
					  $mail->AddAddress($email, $firstname . $lastname);
					  //$mail->SetFrom($adminemail, $adminname);
					  $mail->AddReplyTo($email, $firstname . $lastname);
					  $mail->Subject = "$main_title : User Access";
					
					  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically 
					  $mail->MsgHTML($msgBody);
					  $mail->Send();
					 		  
							return "SUCCESS . $email . $firstname . $lastname . $adminemail . $adminname";
						 
					} catch (phpmailerException $e) {
					    $e->errorMessage(); //Pretty error messages from PHPMailer
						return "FAILED 1";
					} catch (Exception $e) {
					    $e->getMessage(); //Boring error messages from anything else!
						return "FAILED 2";
					} 
	}
?>
