<?php 
include('connection.php');
extract($_POST);

	
if($_POST['getData']=='viewInwards'){
	$dataID	=	$_POST['dataID'];
	
	if(!empty($dataID)){
		$check = $conn->query("SELECT inwards_item.*, meel.name as mname from `inwards_item` left join `meel` ON `meel`.id = `inwards_item`.meel  where inwards_item.`inwards_id`  =  $dataID");
		$sfd = "";
		while($fetch=mysqli_fetch_array($check)){
			$sfd .= '<tr>
				<td>'.$fetch['reel_number'].'</td>
				<td>'.$fetch['gsm'].'</td>
				<td>'.$fetch['size'].'</td>
				<td>'.$fetch['quantity'].'</td>
				<td>'.$fetch['weight'].'</td>
				<td>'.$fetch['mname'].'</td>
				<td>'.$fetch['reel_ream'].'</td>
			</tr>';
		}
		
		$status = "success";
		$result = $sfd;
	}else{
		$status = "error";
		$result = "Something went wrong";
	}

	echo json_encode(array("status"=>$status,"data"=>$result));
}


	
if($_POST['getData']=='getReelDetails'){
	$value	=	$_POST['value'];
	$panel	=	$_POST['panel'];
	
	if(!empty($value)){
		$check = $conn->query("SELECT inwards_item.*, meel.name as mname from `inwards_item` left join `meel` ON `meel`.id = `inwards_item`.meel  where inwards_item.`reel_number` = '$value'");
		$fetch=mysqli_fetch_assoc($check);
		
		if($panel==1){
			$new = '<div class="col pt-3">
						<label>Reel / Ream</label>
						<input type="text" name="reel_ream" value="'.$fetch['reel_ream'].'" class="form-control" placeholder="Reel / Ream"/>
					</div>';
		}else if($panel==2){
			$new = '<div class="col pt-3">
						<label>Meel</label>
						<input type="text" name="meel" value="'.$fetch['mname'].'" class="form-control" placeholder="Meel">
					</div>
					<div class="col pt-3">
						<label>Quantity</label>
						<input type="text" name="qty" value="'.$fetch['quantity'].'" class="form-control" placeholder="Quantity">
					</div>';
		}
		
		$sfd = '<div class="row mx-0">
					<div class="col pt-3">
						<label>GSM</label>
						<input type="text" name="gsm" value="'.$fetch['gsm'].'" class="form-control" placeholder="GSM">
					</div>
					<div class="col pt-3">
						<label>Size</label>
						<input type="text" name="size" value="'.$fetch['size'].'" class="form-control" placeholder="Size">
					</div>
					
					<div class="col pt-3">
						<label>Weight</label>
						<input type="text" name="weight" value="'.$fetch['weight'].'" class="form-control" placeholder="Weight">
					</div>
					'.$new.'
					
				</div>';
				
				
		
		$status = "success";
		$result = $sfd;
	}else{
		$status = "error";
		$result = "Something went wrong";
	}

	echo json_encode(array("status"=>$status,"data"=>$result));
}



if($_POST['getData']=='viewOutwards'){
	$dataID	=	$_POST['dataID'];
	
	if(!empty($dataID)){
		$check = $conn->query("SELECT * from `outwards` where `id`  =  $dataID");
		$sfd = "";
		while($fetch=mysqli_fetch_array($check)){
			$sfd .= '<tr>
				<td>'.$fetch['reel_number'].'</td>
				<td>'.$fetch['gsm'].'</td>
				<td>'.$fetch['size'].'</td>
				<td>'.$fetch['weight'].'</td>
				<td>'.$fetch['reel_ream'].'</td>
			</tr>';
		}
		
		$status = "success";
		$result = $sfd;
	}else{
		$status = "error";
		$result = "Something went wrong";
	}

	echo json_encode(array("status"=>$status,"data"=>$result));
}
?>