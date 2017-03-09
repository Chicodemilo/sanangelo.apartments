
	<form action="<?php echo base_url(); ?>admin/submit_cost" method="post">
		<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<input type="hidden" name="ID" value="1"/>
		<table>
			<tr>
				<th colspan="6">
					EDIT COST PAGE
				</th> 
			</tr>
			<tr>
				<td class="righter" width="20%">Premium Advertiser:</td>
				<td colspan="5">$<input type="number" name="premium_cost" id="premium_cost" value="<?php echo $prices[0]['premium_cost']; ?>" maxlength="5"> Per Month</td>
			</tr>
			<tr>
				<td class="righter" width="20%">Site Takeover:</td>
				<td colspan="5">$<input type="number" name="site_takeover_cost" id="site_takeover_cost" value="<?php echo $prices[0]['site_takeover_cost']; ?>" maxlength="5"> Per Day</td>
			</tr>
			<tr>
				<td class="righter" width="20%">Top 3 Advertiser:</td>
				<td colspan="5">$<input type="number" name="top_three_cost" id="top_three_cost" value="<?php echo $prices[0]['top_three_cost']; ?>" maxlength="5"> Per Month</td>
			</tr>
			
			<tr>
				<th colspan="6"><input type="submit" value="Submit Costs"></th>
			</tr>
		</table>
	</form>
<div class="bottom_room">
	&nbsp;
</div>

