

<?php 
if ($result->num_rows > 0) {
			echo "<table>";
			echo "<tr><th colspan='7'>CURRENT APARTMENTS</th></tr>";
		    while($row = $result->fetch_assoc()) {
		        echo "<tr class='all_apts_row'><td>ID: ".$row["ID"]."</td><td>".$row["property_name"]."</td><td>".$row["property_phone"]."</td><td>User ID:".$row["verified_user_id"]."</td><td><a href='".base_url()."admin/suspend_apt/".$row["ID"]."'>suspend"."</td><td><a href='".base_url()."admin/delete_apt/".$row["ID"]."'>delete"."</td><td><a href='".base_url()."admin/edit_this_apt/".$row["ID"]."/".$row["property_name"]."'>edit"."</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}

if ($suspended->num_rows > 0) {
			echo "<table>";
			echo "<tr><th colspan='7'>SUSPENDED APARTMENTS</th></tr>";
		    while($row = $suspended->fetch_assoc()) {
		        echo "<tr class='all_apts_row'><td>ID: ".$row["ID"]."</td><td>".$row["property_name"]."</td><td>".$row["property_phone"]."</td><td>User ID:".$row["verified_user_id"]."</td><td><a href='".base_url()."admin/unsuspend_apt/".$row["ID"]."'>un-suspend"."</td><td><a href='".base_url()."admin/delete_apt/".$row["ID"]."'>delete"."</td><td><a href='".base_url()."admin/edit_this_apt/".$row["ID"]."/".$row["property_name"]."'>edit"."</td></tr>";
		    }
		    echo "</table>";
		}

 ?>