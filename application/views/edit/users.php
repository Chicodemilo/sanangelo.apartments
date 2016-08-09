<div class="users_box">
		<div class="hours_head">
			USER
		</div>
			<div class="users_table">
			<table>
				<tr>
					<th>Username</th>
					<th>Email 1</th>
					<th>Email 2</th>
					<th>Email 3</th>
					<th>Email 4</th>
					<th>Verified</th>
					<th>Last<br>Login</th>
					<th>Login<br>Count</th>
					<th></th>				</tr>
				<?php
					
					foreach ($users as $key => $value) {
						$last_login = $value['last_login']; 
						$phpdate = strtotime( $last_login);
						$last_login = date( 'n/j/y, g:i a', $phpdate );

						echo "<tr>";
						echo "<td>".$value['username']."</td>";
						echo "<td>".$value['email']."</td>";
						echo "<td>".$value['email_2']."</td>";
						echo "<td>".$value['email_3']."</td>";
						echo "<td>".$value['email_4']."</td>";
						echo "<td>".$value['verified']."</td>";
						echo "<td>".$last_login."</td>";
						echo "<td>".$value['login_count']."</td>";
						echo "<td><a href='".base_url()."edit/submit_users/".$value['ID']."' class='small_link'>edit</a></td>";
						echo "</tr>";

					}
			?>
			
			</table>
			<table>
				<th colspan="2">RECENT LOGINS</th>
				<tr>
					<th>DATE</th>
					<th>IP ADDRESS</th>
				</tr>
				<?php 
					foreach($recent_logins as $value){
						$last_login = $value['login_time']; 
						$phpdate = strtotime( $last_login);
						$last_login = date( 'n/j/y, g:i a', $phpdate );
						echo "<tr>";
						echo "<td>".$last_login."</td>";
						echo "<td>".$value['ip_address']."</td>";
						echo "</tr>";
					}

				 ?>
			</table>
			</div>
	</div>