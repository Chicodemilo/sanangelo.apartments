
	<form action="<?php echo base_url(); ?>admin/submit_new_apt" method="post">
		<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<table>
			<tr>
				<th colspan="6">
					MAKE NEW APARTMENT
				</th> 
			</tr>
			<tr>
				<td class="righter" width="20%">Name:</td>
				<td colspan="5"><input type="text" style="width:90%" name="property_name" id="property_name" placeholder="Property Name" maxlength="35"></td>
			</tr>
			<tr>
				<td class="righter">Phone Number:</td>
				<td colspan="2"><input type="text" style="width:90%" name="property_phone" id="property_phone" placeholder="Enter The Main Phone Number. Ex: (325) 340-9310"></td>

				<td class="righter">Street Address:</td>
				<td colspan="2"><input type="text" style="width:90%" name="property_address" id="property_address" placeholder="Enter The Street Address"></td>
			</tr>
			<tr>
				<td class="righter">City:</td>
				<td><input type="text" style="width:90%" name="property_city" id="property_city" placeholder="Enter The City" value="San Angelo"> </td>
			
				<td class="righter">State:</td>
				<td><input type="text" style="width:90%" name="property_state" id="property_state" placeholder="Enter The State" maxlength="2" value="TX"></td>
			
				<td class="righter">Zip Code:</td>
				<td><input type="text" style="width:90%" name="property_zip" id="property_zip" placeholder="Enter The Zip Code" value="7690"></td>
			</tr>
			<th colspan="6"></th>
			<tr>
				<td class="righter">Contact Email Address:</td>
				<td colspan="2"><input type="email" style="width:90%" name="property_email" id="property_email" placeholder="Main Email Address"></td>
			
				<td class="righter">Website:</td>
				<td colspan="2"><input type="text" style="width:90%" name="property_website" id="property_website" placeholder="www.example.com"></td>
			</tr>
			<tr>
				<td class="righter">Slogan:</td>
				<td colspan="2"> <textarea name="property_slogan" cols="60" rows="4" id="property_slogan" maxlength='125' placeholder="Enter A Short Slogan For The Property. 125 Characters Max."></textarea></td>
			
				<td class="righter">Property Description:</td>
				<td colspan="2"><textarea name="property_description" cols="60" rows="4"  id="property_description" maxlength='800' placeholder="Enter A Short Description Of The Property. 400 Characters Max."></textarea></td>
			</tr>
			
			<th colspan="6"></th>
			
			</tr>
			<tr>
				<td class="righter">Custom Color One:</td>
				<td colspan="2"><input type="color" style="width:90%" name="property_color_1" id="property_color_1" value="#A93C01"></td>
			
				<td class="righter">Custom Color Two:</td>
				<td colspan="2"><input type="color" style="width:90%" name="property_color_2" id="property_color_2" value="#0156A9" ></td>
			</tr>
			<th colspan="6"></th>
			<tr>
				<td class="righter">Facebook Page Address:</td>
				<td colspan="5"><input type="text" style="width:90%" name="property_facebook" id="property_facebook" placeholder="www.facebook.com/example"></td>
			</tr>
			<tr>
				<td class="righter">Manangement Company Name:</td>
				<td colspan="2"><input type="text" style="width:90%" name="property_management_name" id="property_management_name" maxlength="50" placeholder="The Name Of The Property Management Company" ></td>
			
				<td class="righter">Management Company Website:</td>
				<td colspan="2"><input type="text" style="width:90%" name="property_management_url" id="property_management_url" maxlength="70" placeholder="www.example.com"></td>
			</tr>
			<tr>
				<td class="righter">Choose A User:</td>
				<td colspan="5">
					<select name="verified_user_id" id="verified_user_id">
						<?php 
							foreach ($unused_ids as $key => $value) {
								echo "<option value='".$value[0]['ID']."'>".$value[0]['username']." : ".$value[0]['email']."</option>";
							}

						 ?>
					</select>
				</td>
			</tr>
			<tr>
				<th colspan="6"><input type="submit" value="Submit Edits"></th>
			</tr>
		</table>
	</form>
<div class="bottom_room">
	&nbsp;
</div>
<script>
	jQuery(document).ready(function($) {
		 $("#property_color_1, #property_color_2").spectrum({
	        showInput: true,
	        className: "full-spectrum",
	        showInitial: true,
	        showPalette: true,
	        showSelectionPalette: true,
	        maxSelectionSize: 10,
	        preferredFormat: "hex",
	        localStorageKey: "spectrum.demo",
	        move: function (color) {
	            
	        },
	        show: function () {
	        
	        },
	        beforeShow: function () {
	        
	        },
	        hide: function () {
	        
	        },
	        change: function() {
	            
	        },
	        palette: [
	            ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
	            "rgb(204, 204, 204)", "rgb(217, 217, 217)","rgb(255, 255, 255)"],
	            ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
	            "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"], 
	            ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)", 
	            "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)", 
	            "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)", 
	            "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)", 
	            "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)", 
	            "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
	            "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
	            "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
	            "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)", 
	            "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
	        ]
	    });
	});
</script>

