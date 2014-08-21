<div class="form_container"> 	
	<form action="" method="post"> 
		<ul > 
			<label>
				<li> Image Title*:<br>
					<input type="text" name="title" size=35 value="<?php echo $image_data['title']; ?>">  
				</li>
			</label>
			
				<li> Location (e.g. Homemade, Chipotle, etc.)*:<br>
					<input type="text" name="location" size=35 value="<?php echo $image_data['location']; ?>">  
				</li>
				
				<li> Description:<br>				
				<textarea type="text" name="description"><?php echo $image_data['description']; ?></textarea> 
				</li>
								
				<li> 
					<input type="checkbox" name="public_check" <?php if($image_data['active'] == 1 ) {  echo 'checked="checked"' ; } ?>">  Make this image public? 
				</li>
				
				<li> 
					<input type="Submit" value="Publish">  
				</li>
			
		</ul>
	</form> 
</div>
	