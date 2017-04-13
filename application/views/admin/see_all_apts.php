

<?php 			
echo "<table>";
echo "<tr><th colspan='8'>CURRENT APARTMENTS</th></tr>";
foreach ($result as $key => $value) {
	    
	        echo "<tr class='all_apts_row'><td>ID: ".$value["ID"]."</td><td>".$value["property_name"]."</td><td>".$value["property_phone"]."</td><td>User ID:".$value["verified_user_id"]."</td><td><a href='".base_url()."admin/suspend_apt/".$value["ID"]."'>suspend</a>"."</td><td><a href='".base_url()."admin/delete_apt/".$value["ID"]."'>delete</a>"."</td><td><a href='".base_url()."admin/edit_this_apt/".$value["ID"]."/".$value["property_name"]."'>edit</a>"."</td><td><a href='".base_url()."admin/edit_advertising/".$value["ID"]."'>advertising"."</a></td></tr>";
		}
echo "</table>";

echo "<table>";
echo "<tr><th colspan='7'>SUSPENDED APARTMENTS</th></tr>";
foreach ($suspended as $key => $value) {
			
		        echo "<tr class='all_apts_row'><td>ID: ".$value["ID"]."</td><td>".$value["property_name"]."</td><td>".$value["property_phone"]."</td><td>User ID:".$value["verified_user_id"]."</td><td><a href='".base_url()."admin/unsuspend_apt/".$value["ID"]."'>un-suspend</a>"."</td><td><a href='".base_url()."admin/delete_apt/".$value["ID"]."'>delete</a>"."</td><td><a href='".base_url()."admin/edit_this_apt/".$value["ID"]."/".$value["property_name"]."'>edit</a>"."</td></tr>";
		}
echo "</table>";
 ?>