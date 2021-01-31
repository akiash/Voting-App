<?php
	include('header.inc.php');
	
	$msg="";
	
	//insert party name
	if(isset($_REQUEST['save'])){
		$new_party = get_safe_value($_REQUEST['new_party']);
		// echo '<pre>';
		// print_r($new_party);
		//die();
		if(mysqli_num_rows(mysqli_query($conn,"select * from party where name='$new_party'"))>0){
			$msg = "Party name already added in our database";
		}else{
			mysqli_query($conn,"insert into party(name,vote) values ('$new_party',0)");
			?>
				<script>
					window.location.href='admin.php';
					alert("New Record Added Successfully");
					//swal("Good job!","you clicked","success");
				</script>
			<?php
		}
	}
	
	//delete records
	if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
		$type=get_safe_value($_GET['type']);
		$id=get_safe_value($_GET['id']);
		if($type=='delete'){
			mysqli_query($conn,"delete from party where id='$id'");
			redirect('admin.php');
		}
	}
	
	//add voters
	
	$msgs="";
	
	if(isset($_REQUEST['submit'])){
		$email = get_safe_value($_REQUEST['email']);
		$name = get_safe_value($_REQUEST['name']);
		//$add = get_safe_value($_REQUEST['add']);
	   // $remove = get_safe_value($_REQUEST['remove']);
	   $password = rand(11111,99999);
		
		if(isset($_REQUEST['add'])){
			if(mysqli_num_rows(mysqli_query($conn,"select * from voters where email='$email'"))>0){
				$msgs = "Email already exists";
			}else{
				mysqli_query($conn,"insert into voters(email,name,password) values ('$email','$name',$password)");
				$msgs="Voter Add Successfully!!. Password is $password";
			}
		}
		
		if(isset($_REQUEST['remove'])){
			mysqli_query($conn,"delete from voters where email='$email' and name='$name'");
			?>
				<script>
					window.location.href='admin.php';
					alert("Record Deleted successfully");
				</script>
			<?php		
		}
	}
	
	//winner party
	$sql = "select name from party order by vote desc";
	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){
		$row = mysqli_fetch_assoc($res);
		$party=$row['name'];
	}else{
		$party="";
	}

		
	$sql = "select * from party order by name";
	$res = mysqli_query($conn,$sql);

?>

		<div class="row">
			<div class="col-md-4" style=" height:400px">
				<div class="Wnr_party" class="height:400px"> 
					<h1 class="text-white text-center">Winner Party</h1><br/>
					<h1 class="text-white text-center"><?php echo $party;?></h1>
				</div>
			</div>
			
			<div class="col-md-4" style="height:400px">
				<div class="add_new_party" style="height:220px;">
				
					<h5 class="text-dark text-center"><b>Add New Party</b></h5></br><br/>
					<form method="post">
						<div class="form-group">
							<input type="text" name="new_party" class="form-control" Placeholder="<?php echo $msg?>" required/>	
						</div><br/>	
						
						<div class="form-group">
							<input type="submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" value="ADD NOW" name="save">
						</div>
					</form>
				</div>
			</div>
			
			<div class="col-md-4" style="height:400px">
				<div class="add_rm_voter" style=" height:368px;">
				
					<h5 class="text-dark text-center"><b>Add or Remove Voter</b></h5></br><br/>
					<form method="post">
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control" id="" Placeholder="Email" required>
					</div><br/>
					<div class="form-group">
						<input type="text" name="name" id="name" class="form-control" id="" placeholder="Name" required>
					</div><br/>
					<div class="form-group">
						Add<input type="radio" name="add" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Remove<input type="radio" name="remove" >
					</div>
					
					<div class="form-group">
						<input type="submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" value="ADD NOW" name="submit">
						<div class="text-danger"><?php echo $msgs?></div>
					</div>
					
				</div>
			</div> 
		</div>
		
		<div class="row">
			<div class="col-md-5 party_list" style="height:auto">
				<div class="card-body">
				  <h4 class="card-title">All Parties</h4>
				  <div class="row">
					<div class="col-12"style="padding-left:0px; padding-right:0px; padding-top:0px">
					  <div class="table-responsive">
						<table id="order-listing" class="table table-bordered">
						  <thead class="thead-light">
							<tr>
								<th>S.no</th>
								<th>Name</th>
								<th>Vote</th>
								<th>Action</th>
							</tr>
						  </thead>
						 <tbody>
							<?php if(mysqli_num_rows($res)>0){
							$i=1;
							while($row = mysqli_fetch_assoc($res)){
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row['name']?></td>
								<td><?php echo $row['vote']?></td>
								<td>
								  <a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger">Delete</label></a>
								</td>
							</tr>
							<?php
							$i++;
							}}else{ ?>
							<tr>
								<td colspan="5"> No Data Found</td>
							</tr>
							<?php } ?>

						  </tbody>
						</table>
					  </div>
					</div>
				  </div>
				</div>
			</div>
		</div>
		
<?php include('footer.inc.php');?>