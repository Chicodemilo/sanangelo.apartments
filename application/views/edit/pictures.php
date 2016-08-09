<?php 
foreach ($pictures as $key => $value) {
	echo "<div id='".$value['name']."' class='picture_box'>";
	echo "<img src='".base_url()."images/pictures/".$this->session->userdata('apt_id')."/".$value['id']."/".$value['name']."' alt='".$value['caption']."'>";
	echo "<hr>";
	echo $value['caption'];
	echo "<hr>";
	echo "<table>
			<tr>
				<td width='32%'>Active: <span class='bold'>".$value['active']."</span></td>
				<td width='32%'>Cover Pic: <span class='bold'>".$value['cover_pic']."</span></td>
				<td width='32%'>Order: <span class='bold'>".$value['pic_order']."</span></td>
			</tr>
			<tr>
				
			</tr>
		</table>";
	echo "<hr>";
	echo "<a href='".base_url()."edit/picture_edit/".$value['id']."' class='not_fancy_dark'>EDIT</a><br><br>";
	echo "<a href='".base_url()."edit/picture_delete/".$value['id']."' class='not_fancy_dark'>DELETE</a>";
	echo "</div>";
}

foreach ($logo as $key => $value) {
	echo "<div id='".$value['name']."' class='logo_box'>";
	echo "PROPERTY LOGO<hr>";
	echo "<img src='".base_url()."images/logos/property/".$this->session->userdata('apt_id')."/".$value['name']."' alt='".$value['caption']."'>";
	echo "<hr>";
	echo "<a href='".base_url()."edit/logo_delete/".$value['id']."' class='not_fancy_dark'>DELETE</a>";
	echo "<hr>";
	echo "The best file format to use for a logo is a PNG.<br><br>To look the best it needs to be high resolution - around 12 inches wide at 72dpi. It should also have a transparent background - which you can have with a PNG but not a JPG.<br><br>If you need help please contact us.";
	echo "</div>";
}

 ?>

<table>
	<tr>
		<td width="33%"><a href="<?php echo base_url(); ?>edit/picture_upload">Upload A Property Picture</a></td>
		<td width="33%"><a href="<?php echo base_url(); ?>edit/logo_upload">Upload A Property Logo</a></td>
	</tr>
</table>

<div class="bottom_room">
	&nbsp;
</div>