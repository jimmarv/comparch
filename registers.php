<?php
include_once('connection.php');?>
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
<table style="width:100%" border="1px solid black">


  <tr>
    <th>Register</th>
    <th>Value</th>
	
  </tr>
  <?php
					$sql = "SELECT id,addressname, address , defaultvalue ,updatedvalue FROM register";
					$result = $conn->query($sql);
					$id    = 1;
					$var = "";
					if ($result->num_rows > 0) {
						 // output data of each row
						 while($row = $result->fetch_assoc()) {
							 //echo "<br> Register Name: ". $row["addressname"]. " Register Value: ". $row["address"]. "<br>";
							$binary =  $row["address"];
							$hex = dechex(bindec($binary));
							$address = $row["addressname"];
							$defaultValue = $row["defaultvalue"];
							$updateValue = $row["updatedvalue"];
							//echo $hex;<div id="val['.$id.']"> '. $row["defaultvalue"]. ' </div>
							$readOnly = (!empty($address) && $address=='R0')? "readOnly" : "";
							$updateVal = (!empty($updateValue) && $updateValue!='0000000000000000') ? $updateValue : $defaultValue; 
							$var = $row['addressname'];
							 echo '
								<tr>
									<td>'. $row["addressname"]. '</td>
									<td>
										<input type="text" value="'.$updateVal.'" '.$readOnly.' onBlur=\'save_register(this.value,"'.$var.'");\'/>
											
									
									</td>	
	
								  </tr>
							 ';
							 $id++;
						 }
						
					} else {
						 echo "<tr><td colspan='2'>0 result</td></tr>";
					}
				?>


</table>
</div>
<script>
	
	function save_register(value,address){
		
		var data = 'value='+value+'&address='+address;
		
			var address = address;
			var updateval = value;

			var column = {};
		  	column['updatedvalue']   = updateval;
			column['status']   = 'temp';
			
			if(value!='0000000000000000'){
					$.post("save_data.php",{ table: "register", condition: " addressname = '"+address+"' ", value : value , fields : column } , function(update){
						if(update==1){
							
							window.location.replace('http://localhost/trainjim/mips/registers.php');
						}else{
							alert(update);
						}
					});

			}
		
	}

$(document).ready(function(){

	$('#changeVal').click(function(){
		alert('click');
	});
});

</script>
</body>

</html> 
