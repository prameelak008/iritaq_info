<?php
	/**
	 * This Is the Kit File To Be included For Transaction Request/Response
	 */
	include 'AWLMEAPI.php';
	
	//create an Object of the above included class
	$obj = new AWLMEAPI();
	
	/* This is the response Object */
	$resMsgDTO = new ResMsgDTO();

	/* This is the request Object */
	$reqMsgDTO = new ReqMsgDTO();
	
	//This is the Merchant Key that is used for decryption also
	$enc_key = '777fb73ceab4185ec75c5773fae36e32';
	
	/* Get the Response from the WorldLine */
	$responseMerchant = $_REQUEST['merchantResponse'];
    $response = $obj->parseTrnResMsg( $responseMerchant , $enc_key );
    if ($response->getStatusCode()=="S")
    {
       
    }
   
   
    
    ?>

     <style>
	body{
	font-family:Verdana, sans-serif	;
	font-size::12px;
	}
	.wrapper{
	width:980px;
	margin:0 auto;	
	}
	table{

	}
	tr{
		padding:5px
	}
	td{
	padding:5px;	
	}
	input{
	padding:5px;	
}
</style>

<div id="">
        <form action="<?php  echo site_url('user/user/pay'); ?>" method="POST" id="submpay" />
        
        <input type="hidden" name="getTrnAmt" value="<?php echo $response->getTrnAmt();?>" />
        <input type="hidden" name="getStatusDesc" value="<?php echo $response->getStatusDesc();?>" />
        <input type="hidden" name="getTrnReqDate" value="<?php echo $response->getTrnReqDate();?>" />
        <input type="hidden" name="getResponseCode" value="<?php echo $response->getResponseCode();?>" />
        <input type="hidden" name="getAddField1" value="<?php echo $response->getAddField1();?>" />
        <input type="hidden" name="getAddField2" value="<?php echo $response->getAddField2();?>" />
        <input type="hidden" name="getAddField3" value="<?php echo $response->getAddField3();?>" />
        <input type="hidden" name="getAddField4" value="<?php echo $response->getAddField4();?>" />
        <input type="hidden" name="getAddField5" value="<?php echo $response->getAddField5();?>" />
        <input type="hidden" name="getAddField6" value="<?php echo $response->getAddField6();?>" />
        <input type="hidden" name="getAddField7" value="<?php echo $response->getAddField7();?>" />
        <input type="hidden" name="getOrderId" value="<?php echo $response->getOrderId();?>" />
        <input type="hidden" name="getStatusCode" value="<?php echo $response->getStatusCode();?>" />
        <input type="hidden" name="getPgMeTrnRefNo" value="<?php echo $response->getPgMeTrnRefNo();?>" />
    
    
    
<center> <H3>Transaction Status </H3></center>

<center>
<span> Please submit the Transaction Status </span>
<br>
	<table hidden>
		<tr><!-- PG transaction reference number-->
			<td><label for="txnRefNo">Transaction Ref No. :</label></td>
			<td><?php echo $response->getPgMeTrnRefNo();?></td>
			<!-- Merchant order number-->
			<td><label for="orderId">Order No. :</label></td>
			<td><?php echo $response->getOrderId();?> </td>
			<!-- Transaction amount-->
			<td><label for="amount">Amount :</label></td>
			<td><?php echo $response->getTrnAmt();?></td>
		</tr>
		<tr ><!-- Transaction status code-->
			<td><label for="statusCode">Status Code :</label></td>
			<td><?php echo $response->getStatusCode();?></td>
			
			<!-- Transaction status description-->
			<td><label for="statusDesc">Status Desc :</label></td>
			<td><?php echo $response->getStatusDesc();?></td>
			
			<!-- Transaction date time-->
			<td><label for="txnReqDate">Transaction Request Date :</label></td>
			<td><?php echo $response->getTrnReqDate();?></td>
		</tr>
		<tr >
			<!-- Transaction response code-->
			<td><label for="responseCode">Response Code :</label></td>
			<td><?php echo $response->getResponseCode();?></td>
			
			<!-- Bank reference number-->
			<td><label for="statusDesc">RRN :</label></td>
			<td><?php echo $response->getRrn();?></td>
			<!-- Authzcode-->
			<td><label for="authZStatus">AuthZCode :</label></td>	
			<td><?php echo $response->getAuthZCode();?></td>
		</tr>
		<tr >	<!-- Additional fields for merchant use-->
			<td><label for="addField1">Add Field 1 :</label></td>
			<td><?php echo $response->getAddField1();?></td>

			<td><label for="addField2">Add Field 2 :</label></td>
			<td><?php echo $response->getAddField2();?></td>
			
			<td><label for="addField3">Add Field 3 :</label></td>
			<td><?php echo $response->getAddField3();?></td>
		</tr>
		<tr >	
				<td><label for="addField4">Add Field 4 :</label></td>
				<td><?php echo $response->getAddField4();?></td>
				
				<td><label for="addField5">Add Field 5 :</label></td>
				<td><?php echo $response->getAddField5();?></td>
				
				<td><label for="addField6">Add Field 6 :</label></td>
				<td><?php echo $response->getAddField6();?></td>	
			</tr>
			<tr >	
				<td><label for="addField7">Add Field 7 :</label></td>
				<td><?php echo $response->getAddField7();?></td>
				
				<td><label for="addField8">Add Field 8 :</label></td>
				<td><?php echo $response->getAddField8();?></td>
			</tr>
	
	</table>
	
	<!--<button type="submit" class="btn btn-primary" type="submit">Submit  Tranasction Status</button>-->
	
	
</form>
</div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script  type="text/javascript">
        $(document).ready(function() 
        {
        $('#submpay').submit();
        });
        </script>

</center>

       

