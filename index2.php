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
	<script src="reCopy.js"></script>

</head>

<body>

<table align="center">
	<tr>
		<td>
		
			<h1>Registers</h1>
				<iframe src="registers.php">
  					<p>Your browser does not support iframes.</p>
				</iframe>
				



		</td>
		<td width="50px">&nbsp;</td>

		<td  >
				<h1> Data</h1>
				<iframe src="datavalue.html">
  					<p>Your browser does not support iframes.</p>
				</iframe>
			
		</td>
	</tr>

	<tr>
		<td>
					<input type="submit" value="Submit">
			
		</td>
		<td width="50px">&nbsp;</td>
		<td>
			<button type="button" onclick="alert('Wait lang din')">Change Data Value</button>
		</td>

	</tr>

</table>




<h1  id="codes" align="center">Enter MIPS Codes Here</h1>

<div class="row"><br/><br/></div>
<div class="container">
<div class="row">
	<div class="well well-lg">
	<div  class="table-responsive"  >
		<!--<table>
    <tr> 
         <td><input type="text" id="txtTitle" name="txtTitle"></td> 
         <td><input type="text" id="txtLink" name="txtLink"></td> 
    </tr>
</table>
<button>Add Row</button>-->
		<table id="itemsTable" class="table table-hover">
				<thead>
					<tr>
						<th>Label(Optional)</th>
						<th >Operation</th>
						<th >Register Destination</th>
						<th >Register Source</th>
						<th >Register Another Source</th>
						<th >OpCode(Hex)</th>
						<th >Task</th>
					</tr>
				</thead>

				<tbody >
					<tr class="clone">
					<td>
					<input id="label" class="form-control" type="text" onclick="SelectAll(this.id);" name="label" value="" />
					</td>

					<td>
					<select class="form-control" id="operation" name= "operation">
					<option disabled="">&nbsp;</option>
					  <option disabled="">R Type</option>
					
					  <option value="DADDU" id="DADDU">&nbsp;DADDU</option>
					  <option value="DMULT" id="DMULT">&nbsp;DMULT</option>
					  <option value="OR" id="OR">&nbsp;OR</option>
					  <option value="DSLLV" id="DSLLV">&nbsp;DSLLV</option>
					  <option value="SLT" id="SLT">&nbsp;SLT</option>

					 <option disabled="">&nbsp;</option>
					  <option disabled="">I Type</option>
					  <option value="BNE" id="6">&nbsp;BNE</option>
					  <option value="LW" id="7">&nbsp;LW</option>
					  <option value="LWU" id="8">&nbsp;LWU</option>
					  <option value="SW" id="9">&nbsp;SW</option>
					  <option value="DADDU" id="10">&nbsp;DADDIU</option>
					  <option value="ANDI" id="11">&nbsp;ANDI</option>
					  <option disabled="">&nbsp;</option>
					  <option disabled="">J Type</option>
					  <option value="JUMP" id="12">&nbsp;J</option>

					</select>

					</td>
					<td id="destination">
							<select class="form-control" name="rd" id="rd">
								<option>- Select One -</option>
								<option>R0</option>
								<option>R1</option>
								<option>R2</option>
								<option>R3</option>
								<option>R4</option>
								<option>R5</option>
								<option>R6</option>
								<option>R7</option>
								<option>R8</option>
								<option>R9</option>
								<option>R10</option>
								<option>R11</option>
								<option>R12</option>
								<option>R13</option>
								<option>R14</option>
								<option>R15</option>
								<option>R16</option>
								<option>R17</option>
								<option>R18</option>
								<option>R19</option>
								<option>R20</option>
								<option>R21</option>
								<option>R22</option>
								<option>R23</option>
								<option>R24</option>
								<option>R25</option>
								<option>R26</option>
								<option>R27</option>
								<option>R28</option>
								<option>R29</option>
								<option>R30</option>
								<option>R31</option>
							</select>
					</td>
						
					<td id="rs">
							<select class="form-control" name="rs" id="rs">
								<option>- Select One -</option>
								<option>R0</option>
								<option>R1</option>
								<option>R2</option>
								<option>R3</option>
								<option>R4</option>
								<option>R5</option>
								<option>R6</option>
								<option>R7</option>
								<option>R8</option>
								<option>R9</option>
								<option>R10</option>
								<option>R11</option>
								<option>R12</option>
								<option>R13</option>
								<option>R14</option>
								<option>R15</option>
								<option>R16</option>
								<option>R17</option>
								<option>R18</option>
								<option>R19</option>
								<option>R20</option>
								<option>R21</option>
								<option>R22</option>
								<option>R23</option>
								<option>R24</option>
								<option>R25</option>
								<option>R26</option>
								<option>R27</option>
								<option>R28</option>
								<option>R29</option>
								<option>R30</option>
								<option>R31</option>
							</select>
							
					</td>
					<td id="rt">
							<select class="form-control" name="rt" id="rt">
								<option>- Select One -</option>
								<option>R0</option>
								<option>R1</option>
								<option>R2</option>
								<option>R3</option>
								<option>R4</option>
								<option>R5</option>
								<option>R6</option>
								<option>R7</option>
								<option>R8</option>
								<option>R9</option>
								<option>R10</option>
								<option>R11</option>
								<option>R12</option>
								<option>R13</option>
								<option>R14</option>
								<option>R15</option>
								<option>R16</option>
								<option>R17</option>
								<option>R18</option>
								<option>R19</option>
								<option>R20</option>
								<option>R21</option>
								<option>R22</option>
								<option>R23</option>
								<option>R24</option>
								<option>R25</option>
								<option>R26</option>
								<option>R27</option>
								<option>R28</option>
								<option>R29</option>
								<option>R30</option>
								<option>R31</option>
							</select>
					</td>
					<td>
						<input class='form-control'  type='text' id='opcode' name='opcode' onclick="SelectAll(this.id);" value="" readOnly >
					</td>
					<td class="center">
						<button id="deleteicon" class="btn btn-danger confirm-delete" style="outline:none;" data-id="1" type="button">
							<span class="glyphicon glyphicon-trash"></span>
						</button>
					</td>
					
					</tr>
					
				</tbody>
				<tfoot>
					<tr>
					<td>
					<div id="addnew_button" style="padding:3px;">
							<!--<a class="btn btn-link add" style="text-decoration:none; outline:none;" onkeyup="setZero();" onmouseout="setZero();" rel=".clone" type="button"> Add a new line </a>-->
							<button>Add Row</button>

					</div>
					</td>
					<td> </td>
					<td> </td>
					<td> </td>
					<td class="left"> </td>
					<td class="right" colspan="2"> </td>
					<td> </td>
					</tr>
				</tfoot>

			</table>
			<div>
			
				<!--<div id="myForm1">
    <input type="text" />
    <input type="text" />
    <select>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
</div>
<div id="newForm1">
</div>
<a href="#" id="clone1">Go</a>
			</div>-->
			<br/><br/>
		</div>
	</div>
	
</div>
</div>



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
		var rowCount 	= table.rows.length - 6;
		var valid		= 1;
		
		var rowindex	= table.rows[row];
		if(rowindex.cells[0].childNodes[0] != null){
			var index		= rowindex.cells[0].childNodes[0].value;
			var datatable	= 'issuancedetails';
			var condition	= " itemcode = '"+index+"' AND voucherno = '"+voucher+"' AND companycode = '"+companycode+"' AND linenum = '"+row+"' ";
		
			if(rowCount > 2){
				var req = Inint_AJAX();
				req.onreadystatechange = function () {
					if (req.readyState==4) {
						if (req.status==200) {
							response = req.responseText.trim();
							if(response == 1){
								table.deleteRow(row);	
								resetIds();
								addAmounts();
							}
							return false;
						}
					}
				}
				req.open("POST", "ajax/delete_row.php"); //make connection				
				req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1"); 
				req.send("table="+datatable+"&condition="+condition);
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
	
	
    
	$(document).ready(function(e){
		/*var i = 1;
		$("#clone").click(function() {
			$(".cloneRow").clone().find("input").each(function() {
				$(this).attr({
					'id': function(_, id) { return id + i },
					'name': function(_, name) { return name + i },
					'value': ''               
				});
			}).end().appendTo("table");
		i++;
		});
		$(".tr_clone_add").click(function() {
			var $tr    = $(this).closest('.tr_clone');
			var $clone = $tr.clone();
			$clone.find(':text').val('');
			$tr.after($clone);
		});*/

		var i = 1;
		$("button").click(function() {
			

			$("tbody tr:first").clone().find("option").each(function() {
				$(this).val('').attr('id', function(_, id) { return id + i });
			}).end().appendTo("tbody");
			i++;
			
			if(i!=''){
				$('#DMULT'+i+',#OR'+i+',#DSLLV'+i+',#SLT'+i).click(function(e){
	
			var type = 'rtype';
			var data = 'type='+type;
			
			
			$.post("dropdown_ajax.php",data)
	    		.done(function( response ) {
	    			var jsondata	= response;
					$('#destination'+i).html(jsondata.destination);
					$('#rs'+i).html(jsondata.source1);
					$('#rt'+i).html(jsondata.source1);
	    		});
	
	
		
			/*$('#destination').html("<select class='form-control'><option>1</option></select>");
			$('#source1').html("<select class='form-control'><option>2</option></select>");
			$('#source2').html("<select class='form-control'><option>3</option></select>");*/
			$('#opcode').html("<input class='form-control'  type='text' name='hexcode' readOnly >");
			
		});
			}
		});
		
		//$('a.add').relCopy();
		
		$('#1,#3,#4,#5').click(function(e){
	
			var type = 'rtype';
			var data = 'type='+type;
			
			
			$.post("dropdown_ajax.php",data)
	    		.done(function( response ) {
	    			var jsondata	= response;
					$('#destination').html(jsondata.destination);
					$('#source1').html(jsondata.source1);
					$('#source2').html(jsondata.source1);
	    		});
	
	
		
			/*$('#destination').html("<select class='form-control'><option>1</option></select>");
			$('#source1').html("<select class='form-control'><option>2</option></select>");
			$('#source2').html("<select class='form-control'><option>3</option></select>");*/
			$('#opcode').html("<input class='form-control'  type='text' name='hexcode' readOnly >");
			
		});
		
		$('#2').click(function(e){
	
			var type = 'rtype';
			var data = 'type='+type;

				$.post("dropdown_ajax.php",data)
	    		.done(function( response ) {
	    			var jsondata	= response;
					$('#destination').html("");
					$('#source1').html(jsondata.source1);
					$('#source2').html(jsondata.source1);
	    		});
	
			$('#opcode').html("<input class='form-control'  type='text' name='hexcode' readOnly >");
		});
		
		$('#6,#7,#8,#9,#10,#11').click(function(e){
	
			var type = 'itype';
			var data = 'type='+type;

				$.post("dropdown_ajax.php",data)
	    		.done(function( response ) {
	    			var jsondata	= response;
					$('#destination').html(jsondata.destination);
					$('#source1').html(jsondata.source1);
					//$('#source2').html(jsondata.source1);
	    		});		

			
			$('#source2').html("<input class='form-control' type='text' maxlength='5' name='input_num'>");
			$('#opcode').html("<input class='form-control'  type='text' name='hexcode' readOnly >");
			
		});


		$('#12').click(function(e){

			$('#destination').html("");
			$('#source1').html("");
			$('#source2').html("");
			$('#opcode').html("");

		});
		
	});



</script>


<!--
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
				<h1>Register Changes</h1>
					<iframe src="changeregs.html">
 						 <p>Your browser does not support iframes.</p>
					</iframe>


			
		</td>
	</tr>



</table>


-->
</body>

</html> 
