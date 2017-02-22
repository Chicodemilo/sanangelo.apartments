
	<form action="<?php echo base_url(); ?>admin/submit_picture_edits/<?php echo $apt_id; ?>/<?php echo $picture[0]['id']; ?>" method="post">
		<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<input type="hidden" name="id" id="id" value="<?php echo $picture[0]['id'] ?>">
		<table id="user_edit">
			<tr>
				<th colspan="2">
					PICTURE INFORMATION :: <?php echo $picture[0]['name']; ?> :: <?php echo $apt_name; ?>
				</th> 
			</tr>
			<tr>
				<td colspan="2"><img src="<?php echo base_url(); ?>images/pictures/<?php echo $apt_id.'/'.$picture[0]['id']; ?>/<?php echo $picture[0]['name']; ?>" alt="<?php echo $picture[0]['caption']; ?>" width="100%"></td>
			</tr>
			<tr>
				<td class="righter">Descripton:</td>
				<td><textarea  name="caption" id="caption" style="width:90%;"placeholder="Enter A Picture Caption. 120 Character Max " maxlength="120" rows="3"><?php echo $picture[0]['caption'] ?></textarea></td>
			</tr>
			<tr><th colspan="2"></th></tr>

		</table>
		<table style="width:600px; margin:auto;">
			<tr>
				<td class="righter_light">Active:</td>
				<td colspan="2">
					<select name="active" id="active">
						<option value="Y">Yes</option>
						<option value="N">No</option>
					</select>
				</td>
				<td class="righter_light">Cover Pic:</td>
				<td>
					<select name="cover_pic" id="cover_pic">
						<option value="Y">Yes</option>
						<option value="N">No</option>
					</select>
				</td>
				<td class="righter_light">Order:</td>
				<td colspan="2">
					<select name="pic_order" id="pic_order">
						<?php 
						for ($i=1; $i <= $count ; $i++) { 
							echo "<option value='".$i."'>".$i."</option>";
						}
						?>
					</select>
					<span class='lefter_light'>of <?php echo $count; ?></span>
				</td>
			</tr>
			<tr>
				<th colspan="7"></th>
			</tr>
			<tr>
				<td colspan="7"><input type="submit" value="Submit Edits"></td>
			</tr>
		</table>
	</form>


	<script type="text/javascript">
		$(document).ready(function() {
			$('#cover_pic option[value="<?php echo $picture[0]["cover_pic"]; ?>"]').prop('selected',true);
			$('#active option[value="<?php echo $picture[0]["active"]; ?>"]').prop('selected',true);
			$('#pic_order option[value="<?php echo $picture[0]["pic_order"]; ?>"]').prop('selected',true);
		});
	</script>