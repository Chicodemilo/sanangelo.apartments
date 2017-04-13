<div class="wrapper">
	 <table class="ad_table">
	 	<tr>
	 		<th colspan="15">USERS ASSOCIATED WITH AN APARTMENT</th>
	 	</tr>
	 	<tr>
	 		<th>USER ID</th>
	 		<th>USER NAME</th>
	 		<th>TEMP PW</th>
	 		<th>EMAIL</th>
	 		<th>EMAIL 2</th>
	 		<th>EMAIL 3</th>
	 		<th>EMAIL 4</th>
	 		<th>ROLE<br>
	 		<th>VERIFIED<br>
	 		<th>DATE<br>ADDED<br>
	 		<th>LAST<br>LOGIN<br>
	 		<th>LOGIN<br>COUNT<br>
	 		<th>RESET PW<br>AND EMAIL IT<br>
	 		<!-- <th>DELETE</th> -->
	 	</tr>
	 <?php 
	 	foreach ($used_users as $key => $value) {
	 		echo "<tr class='all_apts_row'>";
	 			echo "<td>";
	 				echo $value[0]['ID'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['username'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['temp_pw'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['email'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['email_2'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['email_3'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['email_4'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['role'];
	 			echo "</td>";
	 			echo "<td>";
	 				
	 				if($value[0]['verified'] == 'Y'){
	 					echo "YES : <a class='not_fancy_dark' href='".base_url()."admin/toggle_verification/".$value[0]['ID']."/".$value[0]['verified']."'>UN-VERIFY</a>";
	 				}else{
	 					echo "NO : <a class='not_fancy_dark' href='".base_url()."admin/toggle_verification/".$value[0]['ID']."/".$value[0]['verified']."'>VERIFY</a>";
	 				}
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['date_added'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['last_login'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['login_count'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo "<a href='".base_url()."admin/reset_user_pw/".$value[0]['ID']."'>RESET PW</a>";
	 			echo "</td>";
	 		echo "</tr>";
	 	}
	  ?>
	 </table>

	 <table class="ad_table">
	 	<tr>
	 		<th colspan="15">USERS NOT ASSOCIATED WITH AN APARTMENT</th>
	 	</tr>
	 	<tr>
	 		<th>USER ID</th>
	 		<th>USER NAME</th>
	 		<th>TEMP PW</th>
	 		<th>EMAIL</th>
	 		<th>EMAIL 2</th>
	 		<th>EMAIL 3</th>
	 		<th>EMAIL 4</th>
	 		<th>ROLE<br>
	 		<th>VERIFIED<br>
	 		<th>DATE<br>ADDED<br>
	 		<th>LAST<br>LOGIN<br>
	 		<th>LOGIN<br>COUNT<br>
	 		<th>RESET PW<br>AND EMAIL IT<br>
	 		<th>DELETE</th>
	 	</tr>
	 <?php 
	 	foreach ($open_users as $key => $value) {
	 		echo "<tr class='all_apts_row'>";
	 			echo "<td>";
	 				echo $value[0]['ID'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['username'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['temp_pw'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['email'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['email_2'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['email_3'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['email_4'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['role'];
	 			echo "</td>";
	 			echo "<td>";
	 				
	 				if($value[0]['verified'] == 'Y'){
	 					echo "YES : <a class='not_fancy_dark' href='".base_url()."admin/toggle_verification/".$value[0]['ID']."/".$value[0]['verified']."'>UN-VERIFY</a>";
	 				}else{
	 					echo "NO : <a class='not_fancy_dark' href='".base_url()."admin/toggle_verification/".$value[0]['ID']."/".$value[0]['verified']."'>VERIFY</a>";
	 				}
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['date_added'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['last_login'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value[0]['login_count'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo "<a href='".base_url()."admin/reset_user_pw/".$value[0]['ID']."'>RESET PW</a>";
	 			echo "</td>";
	 			echo "<td>";
	 				echo "<a href='".base_url()."admin/delete_user/".$value[0]['ID']."'>DELETE USER</a>";
	 			echo "</td>";
	 		echo "</tr>";
	 	}
	  ?>
	 </table>
 </div>