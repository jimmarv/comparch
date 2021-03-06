<?php
include_once('connection.php');?>
<!DOCTYPE html>
<html>
<head>
  	<title>MIPS64</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="jimstyles.css">-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="reCopy.js"></script>

	<script>
		$(document).ready(function(){
    		$("#show").click(function(){
       	 $("#itemsTable").show();
    		});
		});
</script>

</head>

<body>

<table align="center">
	<tr>
		<td>
		
			<h1>Registers</h1>
				<div id="reg_value">
					<iframe src="registers.php">
	  					<p>Your browser does not support iframes.</p>
					</iframe>
				</div>



		</td>
		<td width="50px">&nbsp;</td>

		<td  >
				<h1> Data</h1>
				<iframe src="data.php">
  					<p>Your browser does not support iframes.</p>
				</iframe>
			
		</td>
	</tr>

	<!--<tr>
		<td>

<button id="edit_reg">Save</button>
		</td>
		<td width="50px">&nbsp;</td>
		<td>
<button id="edit_data">Save</button>
		</td>

	</tr>-->


</table>






<div   class="row"><br/><br/></div>

<!--<div  class="container">-->
<h1  id="codes" align="center">Enter MIPS Codes Here</h1>
<div class="row">
	<div class="well well-lg">
	<div  class="table-responsive"  >
		<table id="itemsTable" class="table table-hover">
				<thead>
					<tr>
						<th>Label(Optional)</th>
						<th >Operation</th>
						<th >&nbsp;</th>
						<th >&nbsp;</th>
						<th >&nbsp;</th>
						<!--<th >Register Destination</th>
						<th >Register Source</th>
						<th >Register Another Source</th>-->
						<th >&nbsp;</th>
						
						<th>OpCode(Binary)</th>
						<th >OpCode(Hex)</th>
						<th >Task</th>			
					</tr>
				</thead>

				<tbody >
				
				 <?php
					for ($val = 1; $val < 6; $val++) {
				?>
				<p>'.$val.'</p>
				<!--<tr class="clone">
					
					<td>
					
					<select class="form-control" id="label'.$val.'">
							<option value="">- Select One - </option>
							<option value="1">L1</option>
							<option value="2">L2</option>
							<option value="3">L3</option>
							<option value="4">L4</option>
							<option value="5">L5</option>
							<option value="6">L6</option>
							<option value="7">L7</option>
							<option value="8">L8</option>
							<option value="9">L9</option>
							<option value="10">L10</option>
					</select>
					</td>

					<td>
					<select class="form-control" id="operation'.$val.'" name= "operation'.$val.'">
					<option>- Select One -</option>
					<option disabled="">&nbsp;</option>
					  <option disabled="">R Type</option>
					
					  <option value="101101" id="DADDU1">&nbsp;DADDU</option>
					  <option value="011100" id="DMULT1">&nbsp;DMULT</option>
					  <option value="100101" id="OR1">&nbsp;OR</option>
					  <option value="010100" id="DSLLV1">&nbsp;DSLLV</option>
					  <option value="101010" id="SLT1">&nbsp;SLT</option>

					 <option disabled="">&nbsp;</option>
					  <option disabled="">I Type</option>
					  <option value="000101" id="BNE1">&nbsp;BNE</option>
					  <option value="100011" id="LW1">&nbsp;LW</option>
					  <option value="100111" id="LWU1">&nbsp;LWU</option>
					  <option value="101011" id="SW1">&nbsp;SW</option>
					  <option value="011001" id="DADDIU1">&nbsp;DADDIU</option>
					  <option value="001100" id="ANDI1">&nbsp;ANDI</option>
					  <option disabled="">&nbsp;</option>
					  <option disabled="">J Type</option>
					  <option value="JUMP" id="J1">&nbsp;J</option>

					</select>
					<input type="hidden" id="type'.$val.'"/>
					</td>
					<td id="destination'.$val.'">
							<select class="form-control" name="rd'.$val.'" id="rd'.$val.'">
								<option>- Select One -</option>
							
							</select>
					</td>
						
					<td id="source'.$val.'">
							<select class="form-control" name="rs'.$val.'" id="rs'.$val.'">
								<option>- Select One -</option>
								
							</select>
							
					</td>
					<td id="othersource'.$val.'">
							<select class="form-control" name="rt'.$val.'" id="rt'.$val.'">
								<option>- Select One -</option>
								
							</select>
					</td>

					<td>
						<button class="btn btn-info" id="gen'.$val.'">Generate OpCode</button>
					</td>


					<td>
						<input class="form-control" id="opcodeBin'.$val.'" type="text" name="opcodeBin" value="" readOnly >
					</td>
					<td>
						<input class="form-control"  type="text" id="opcodeHex'.$val.'" name="opcodeHex" value="" readOnly >
					</td>
					<td class="center">
						<button id="deleteicon'.$val.'" class="btn btn-danger confirm-delete" style="outline:none;" data-id="1" type="button">
							<span class="glyphicon glyphicon-trash"></span>
						</button>
					</td>
					
					</tr>
					
					<script>
						$(document).ready(function(e){
							/**start of R-TYPE**/
							$('#DADDU'.$val.',#OR'.$val.',#DSLLV'.$val.',#SLT'.$val.'').click(function(e){
						
								var type = 'rtype';
								var data = 'type='+type+'&id=1';

								$.post('dropdown_ajax.php',data)
									.done(function( response ) {
										var jsondata	= response;
										$('#destination1').html(jsondata.destination);
										$('#source1').html(jsondata.source1);
										$('#othersource1').html(jsondata.source2);
									});
						
						
								$('#type'.$val.'').val(type);
								$('#opcodeBin'.$val.'').val('');
								$('#opcodeHex'.$val.'').val('');
								
								
							});
							
						
							$('#DMULT'.$val.'').click(function(e){
						
								var type = 'rtype';
								var data = 'type='+type;

									$.post('dropdown_ajax.php',data)
									.done(function( response ) {
										var jsondata	= response;
										$('#destination'.$val.'').html('');
										$('#rs'.$val.'').html(jsondata.source1);
										$('#rt'.$val.'').html(jsondata.source2);
									});
						
								$('#type'.$val.'').val(type);
								$('#opcodeBin'.$val.'').val('');
								$('#opcodeHex'.$val.'').val('');
							});
							
							/**end of R-TYPE**/
							/**start of I-TYPE**/
							$('#BNE'.$val.',#ANDI'.$val.',#DADDIU'.$val.'').click(function(e){
						
								var type = 'itype';
								var data = 'type='+type;

									$.post('dropdown_ajax.php',data)
									.done(function( response ) {
										var jsondata	= response;
										$('#destination'.$val.'').html(jsondata.destination);
										$('#source'.$val.'').html(jsondata.source1);
										//$('#source2').html(jsondata.source1);
									});		

								$('#type'.$val.'').val(type);
								$('#opcodeBin'.$val.'').val('');
								$('#opcodeHex'.$val.'').val('');
								$('#othersource'.$val.'').html('<input class='form-control' type='text' maxlength='4' name='input_num' id='rt1'>');
								//$('#opcode').html('<input class='form-control'  type='text' name='hexcode' readOnly >');
								
							});
							
							$('#LW'.$val.',#LWU'.$val.',#SW'.$val.'').click(function(e){
						
								var type = 'itype';
								var data = 'type='+type;

									$.post('dropdown_ajax.php',data)
									.done(function( response ) {
										var jsondata	= response;
										$('#destination'.$val.'').html(jsondata.destination);
										//$('#source1').html(jsondata.source1);
										$('#othersource'.$val.'').html(jsondata.source2);
									});		

								$('#type'.$val.'').val(type);
								$('#opcodeBin'.$val.'').val('');
								$('#opcodeHex'.$val.'').val('');
								$('#source'.$val.'').html('<input class='form-control' type='text' maxlength='4' name='input_num' id='rs1'>');
								//$('#opcode').html('<input class='form-control'  type='text' name='hexcode' readOnly >');
								
							});
		/**end of I-TYPE**/

						/* OpCode Generator*/

								$('#gen'.$val.'').click(function(e){
									var gen = $('#gen'.$val.'').val();
									var type	= $('#type'.$val.'').val();
									var operation = $('#operation'.$val.'').val();
									var rd = $('#rd'.$val.'').val();
									var rs = $('#rs'.$val.'').val();
									var rt = $('#rt'.$val.'').val();
									var data = 'type='+type+'&operation='+operation+'&rd='+rd+'&rs='+rs+'&rt='+rt;*/
									//alert(operation+"-"+rd+"-"+rs+"-"+rt);
										$.post('genopcode.php',data)
										.done(function( response ) {
											var jsondata	= response;
											$('#opcodeBin'.$val.'').val(jsondata.opcodeBin);
											$('#opcodeHex'.$val.'').val(jsondata.opcodeHex);
											$('#rt'.$val.'').html(jsondata.source1);
										});
							
									
								});
								

								$('#j'.$val.'').click(function(e){

									$('#destination'.$val.'').html('');
									$('#source'.$val.'').html('');
									$('#othersource'.$val.'').html('');
									$('#opcode'.$val.'').html('');

								});		
						});	
					
					</script>-->
					
				<?	}
				?>
				</tbody>
				<tfoot>
					<!--<tr>
			
							<td>
									<a class="btn btn-link add" style="text-decoration:none; outline:none;" onkeyup="setZero();" onmouseout="setZero();" rel=".clone" type="button"> Add a new line </a>
							</td>
					</tr>-->

				</tfoot>

			</table>
			
			

			<div>
				<br/><br/>
			</div>
		</div>	
	</div>
	<div>

	<table>
	<td>
	&nbsp;
	</td>
	<td>
	&nbsp;
	</td>
	<td>
	&nbsp;
	</td><td>
	&nbsp;
	</td><td>
	&nbsp;
	</td>
	<td>
		<button class="btn btn-info" id="gen2">RUN</button>
	</td>
	<td>
	&nbsp;
	</td>
	<td>
		<button class="btn btn-info" id="gen2">RUN 1 CYCLE</button>
	</td>
	</table>

		
	</div>
	<table  align="center">
		<tr>
			<td>
		
				<h1>Pipeline Map</h1>
					<iframe src="pipelinemap.html">
  						<p>Your browser does not support iframes.</p>
					</iframe>
			</td>

			<td width="50px">&nbsp;</td>

			<td>

				<h1>Internal Register</h1>
					<iframe src="changeregs.html">
 						 <p>Your browser does not support iframes.</p>
					</iframe>
			</td>
		</tr>
	</table>
<!--</div>-->


<script>
	/**INITIALIZE AJAX**/
	function Inint_AJAX() 
	{
		try { return new ActiveXObject("Msxml2.XMLHTTP");} catch(e) {} 
		try { return new ActiveXObject("Microsoft.XMLHTTP");} catch(e) {} 
		try { return new XMLHttpRequest();} catch(e) {} 
		alert("XMLHttpRequest not supported");
		return null;
	}
	
	/**HIGHLIGHT INPUT CONTENT**/
	function SelectAll(id)
	{
		document.getElementById(id).focus();
		document.getElementById(id).select();
	}
	
	
	/**RESET GENERATED ID FOR ROWS**/
	function resetIds()
	{
		
		var table 	= document.getElementById('itemsTable');
		var count	= table.rows.length - 6;
		x = 1;
		for(var i = 1;i<count;i++){
			var row = table.rows[i];
			
			row.cells[0].getElementsByTagName("input")[0].id 	= 'label['+x+']';
			row.cells[1].getElementsByTagName("select")[0].id 	= 'operation['+x+']';
			row.cells[2].getElementsByTagName("select")[0].id 	= 'rd['+x+']';
			row.cells[3].getElementsByTagName("select")[0].id 	= 'rs['+x+']';
			row.cells[4].getElementsByTagName("select")[0].id 	= 'rt['+x+']';
			//row.cells[4].getElementsByTagName("input")[0].id 	= 'taxrate['+x+']';
			//row.cells[4].getElementsByTagName("input")[1].id 	= 'taxamount['+x+']';
			row.cells[5].getElementsByTagName("input")[0].id 	= 'opcode['+x+']';
			
			row.cells[0].getElementsByTagName("select")[0].name = 'label['+x+']';
			row.cells[1].getElementsByTagName("input")[0].name 	= 'operation['+x+']';
			row.cells[2].getElementsByTagName("input")[0].name 	= 'rd['+x+']';
			row.cells[3].getElementsByTagName("input")[0].name 	= 'rs['+x+']';
			row.cells[4].getElementsByTagName("select")[0].name = 'rt['+x+']';
			//row.cells[4].getElementsByTagName("input")[0].name 	= 'taxrate['+x+']';
			//row.cells[4].getElementsByTagName("input")[1].name 	= 'taxamount['+x+']';
			row.cells[5].getElementsByTagName("input")[0].name 	= 'opcode['+x+']';
			
			row.cells[6].getElementsByTagName("button")[0].setAttribute('data-id',x);
			row.cells[0].getElementsByTagName("input")[0].setAttribute('data-id',x);
			
			x++;
		}
		
	}
	/**DELETE ROW**/
	function deleteItem(row)
	{
		var voucher		= document.getElementById('voucherno').value;
		var companycode	= document.getElementById('companycode').value;
		var table 		= document.getElementById('itemsTable');
		var rowCount 	= table.rows.length - 2;
		var valid		= 1;
		
		var rowindex	= table.rows[row];
		if(rowindex.cells[0].childNodes[0] != null){
			var index		= rowindex.cells[0].childNodes[0].value;
			var datatable	= 'issuancedetails';
			var condition	= " itemcode = '"+index+"' AND voucherno = '"+voucher+"' AND companycode = '"+companycode+"' AND linenum = '"+row+"' ";
		
			if(rowCount > 2){
				table.deleteRow(row);		
				
			}
		}else{
			if(rowCount > 2){
				table.deleteRow(row);	
				resetIds();
				addAmounts();
			}else{
				document.getElementById('itemcode['+row+']').value 			= '';
				document.getElementById('detailparticular['+row+']').value 	= '';
				document.getElementById('issueqty['+row+']').value 			= '1.00';
				document.getElementById('unitprice['+row+']').value 		= '';
				document.getElementById('taxcode['+row+']').value 			= '';
				document.getElementById('taxrate['+row+']').value 			= '0.00';
				document.getElementById('taxamount['+row+']').value 		= '0.00';
				document.getElementById('amount['+row+']').value 			= '';
				addAmounts();
			}
		}
	}
	
	/**SET DEFAULT VALUES FOR ADDED ROWS**/
	function setZero(){
		resetIds();
		var table 		= document.getElementById('itemsTable');
		var newid 		= table.rows.length - 7;
		
		if(document.getElementById('instruction['+newid+']')!=null && document.getElementById('instruction['+newid+']').value == '')
		{
			document.getElementById('label['+newid+']').value 			= '';
			document.getElementById('operation['+newid+']').value 	= '';
			document.getElementById('rd['+newid+']').value 	= '';
			document.getElementById('rs['+newid+']').value 		= '';
			document.getElementById('rt['+newid+']').value 		= '';
			document.getElementById('opcode['+newid+']').value 		= '';
			//document.getElementById('opcode['+newid+']').value 			= '';
		}
	}

</script>
</body>

</html> 