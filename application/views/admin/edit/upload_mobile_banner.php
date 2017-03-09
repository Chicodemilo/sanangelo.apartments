<div class="upload_window" id="upload_window">
			<table>
				<tr class='row1_edit'><td>CHOOSE A FILE TO UPLOAD: <span style='color:red; text-weight:bold;'><?php echo $error;?></span></td></tr>
				<?php echo form_open_multipart('admin/do_upload_mobile_banner/'.$apt_id);?>

				<tr class='row1_edit'><td><input  type="file" name="userfile" size="20" /></td></tr>

				<tr class='row1_edit'><td><input   type="submit" value="Upload" /></td></tr>
				<tr class='row1_edit'><td>Mobile banner size is 400px wide by 175px tall.<br><br> File types .jpg .gif and .png accepted.</td></tr>

				</form>
			</table>
</div>
