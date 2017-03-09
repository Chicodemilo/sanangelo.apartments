<div class="wrapper">
	 <table class="ad_table">
	 	<tr>
	 		<th colspan="5">INVOICING</th>

	 	</tr>
	 	<form action="<?php echo base_url(); ?>admin/make_invoices/" method="POST">
			<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		 <tr>
		 	<td>
		 		<span class="bold">Make Invoices For All Advertisers</span> 
		 	</td>
		 	<td>
		 		Start Date:<input type="text" name="start_date"  class="date-picker" id="adv_start_date" value="
					<?php 
						$start_of_month = date('Y-m-'.'01');
						$start_of_last_month = date('Y-m-d', strtotime('-1 month', strtotime($start_of_month)));
						echo $start_of_last_month;

					 ?>
		 		" 
		 		required>
		 	</td>
		 	<td>
		 		End Date:<input type="text" name="end_date" class="date-picker" id="adv_end_date" value="
					<?php 
						$start_of_month = date('Y-m-d');
						$start_of_last_month = date('Y-m-t', strtotime('-1 month', strtotime($start_of_month)));
						echo $start_of_last_month;

					 ?>
		 		" 

		 		required>
		 	</td>
		 	<td>
		 		<input type="submit" value="MAKE INVOICES">
		 	</td>
		 </tr>
		 </form>
	 </table>
 </div>

 <script>
	
	var start_picker = new Pikaday({ field: document.getElementById('adv_start_date') });
	var end_picker = new Pikaday({ field: document.getElementById('adv_end_date') });

</script>