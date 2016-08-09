
	<form action="<?php echo base_url(); ?>edit/submit_metadata_edits/<?php echo $main_info[0]['id']; ?>" method="post">
		<table id="user_edit">
			<tr>
				<th colspan="2">
					METADATA KEYWORDS
				</th> 
			</tr>
			<tr>
				<td class="righter">Keyword 1 - Name:</td>
				<td><?php echo $main_info[0]['keyword_one']; ?></td>
			</tr>
			<tr>
				<td class="righter">Keyword 2 - City:</td>
				<td><?php echo $main_info[0]['keyword_two']; ?></td>
			</tr>
			<tr>
				<td class="righter">Keyword 3 - State:</td>
				<td><?php echo $main_info[0]['keyword_three']; ?></td>
			</tr>
			<tr>
				<td class="righter">Keyword 4:</td>
				<td><input type="text"  name="keyword_four" id="keyword_four" style="width:90%;"placeholder="Enter Keyword Four" maxlength="25" value="<?php echo  $main_info[0]['keyword_four']; ?>"></td>
			</tr>
			<tr>
				<td class="righter">Keyword 5:</td>
				<td><input type="text"  name="keyword_five" id="keyword_five" style="width:90%;"placeholder="Enter Keyword Five" maxlength="25" value="<?php echo  $main_info[0]['keyword_five']; ?>"></td>
			</tr>
			<tr>
				<td class="righter">Keyword 6:</td>
				<td><input type="text"  name="keyword_six" id="keyword_six" style="width:90%;"placeholder="Enter Keyword Six" maxlength="25" value="<?php echo  $main_info[0]['keyword_six']; ?>"></td>
			</tr>
			<tr>
				<td class="righter">Keyword 7:</td>
				<td><input type="text"  name="keyword_seven" id="keyword_seven" style="width:90%;"placeholder="Enter Keyword Seven" maxlength="25" value="<?php echo  $main_info[0]['keyword_seven']; ?>"></td>
			</tr>
			<tr>
				<th colspan="2"></th>
			</tr>
			<tr>
				<td colspan="2"> <input type="submit" value="Subit Edits"> </td>
			</tr>
			

		</table>

	</form>

	<table style="width:600px; margin:auto;">
		<tr>
			<td class="lefter_light"><span class="bold">Be careful here!</span><br>Please only edit your keywords if you are sure about what you are doing.</td>
		</tr>
	</table>
