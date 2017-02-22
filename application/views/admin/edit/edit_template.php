	<form action="<?php echo base_url(); ?>edit/submit_template/<?php echo $main_info[0]['id']; ?>" method="post">
		<table id="template_edit">
			<tr>
				<th colspan="4">
					TEMPLATES
				</th> 
			</tr>
			<?php 
				foreach ($template_info as $value) {
					echo "<tr>";
					echo "<td width='15%'><input type='radio' name='template' value='".$value['id']."'> ".$value['name']."</td>";
					echo "<td>".$value['description']."</td>";
					echo "<td><img src='".base_url()."templates/".$value['id']."_template.jpg' width='400px'></td>";
					echo "</tr>";
				}
			 ?>
			 <tr>
				<td colspan="4"> <input type="submit" value="Submit Template"> </td>
			</tr>
		</table>
	</form>
	<br>
	<table style="width:600px; margin:auto;">
		<tr>
			<td class="lefter_light"><span class="bold">Have Fun Here!</span><br>Submit a new template then have a<span class="bold"><a href="<?php echo base_url(); ?> " target="_blank" class="not_fancy_dark">look at your page</a></span>.  You can always go back to another template if you don't like it.</td>
		</tr>
	</table>
<script type="text/javascript">
		$(document).ready(function() {
			var value = <?php echo $main_info[0]['template']; ?>;
			$("input[name=template][value=" + value + "]").prop('checked', true);
		});
	</script>


<div class="bottom_room">
	&nbsp;
</div>