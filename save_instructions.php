<?php
	ob_start();
	session_start();
	
	
	$table		= isset($_POST['table'])  ?  htmlentities($_POST['table'])  : ""; 
	$condition 	= isset($_POST['condition'])  ? $_POST['condition'] : ""; 
	$fields 	= isset($_POST['fields'])  ? $_POST['fields'] : ""; 
	
	$datetime	= date("Y-m-d H:i:s");
	
	$update_info 			= $fields;
	$update_info['updatedate']	= $datetime;
	
	$return		= updateRecord($update_info,$table,stripslashes($condition));

	echo $return;

	ob_end_flush();
	
	  function isHexadecimalString ( $str ) {
			if ( preg_match("/^[a-f0-9]{1,}$/is", $str) ) {
			return 1;
			} else {
			return 0;
			}
	  }
	  function updateRecord($arrayValues, $table, $condition, $autoCommit="yes") {
        include_once 'connection.php';
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
?>
