<?php
	include('header.inc.php');
	
	$sql = "select * from party order by name";
	$res = mysqli_query($conn,$sql);
	
	//insert vote
	if(isset($_REQUEST['submit'])){
		$vote = get_safe_value($_REQUEST['vote']);
		
		mysqli_query($conn,"update party set vote=vote+1 where name='$vote'");
		?>
		<script>
			alert('Ur Vote is Successfully Submitted');
			//Swal.fire('Any fool can use a computer');
			window.location.href='home.php';					
		</script>
		<?php
		//redirect('home.php');
	}
?>
<!-- partial -->
    <div class="container-fluid page-body-wrapper">
	<div class="container">
		<h1 class="text-capitalize text-center" style="margin-top:100px">Choose your party to vote</h1>
		<div class="d-flex justify-content-center h-100" style="">
			<div class="table-responsive">
				<form method="post">
					<table id="table" class="table table-bordered" style=" border: 1px solid black;">
						<?php if(mysqli_num_rows($res)>0){
							$i=1;
							while($row = mysqli_fetch_assoc($res)){
						?>
						<tr>
							<td><label class="text-light" for="BJP"><?php echo $row['name']?></label></td>
							<td><input type="radio" name="vote" id="vote" value="<?php echo $row['name']?>" class="form-control"/></td>
						</tr>
						<?php
							$i++;
							}}else{ ?>
							<tr>
								<td colspan="5"> No Data Found</td>
							</tr>
						<?php } ?>
					</table>
					<input type="submit" name="submit" id="pop" value="Vote Now" class="btn btn-block float-right login_btn"></td>
				</form>	
			</div>
		</div>
	</div>
<div>
	
