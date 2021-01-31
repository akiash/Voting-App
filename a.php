<form>
	<input type="submit" name="submit" value="reset"/>
</form>

<?php
	include('database.inc.php');
	

		$sql = "select * from party";
		$res=mysqli_query($conn,$sql);
		
			echo'<pre>';
			print_r($res);
		
		
		if(isset($_REQUEST['submit'])){
			echo $sql = "update party set vote=0 where vote>=1";
		}
?>