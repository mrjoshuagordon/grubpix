
<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;



?> 




<p> File Upload (jpg, jpeg, gif, or png). Max Size 10 files and 2MB each. <br> After uploading your files, add details and publish them by clicking!  </p>

<?php
		
		if(isset($_FILES['image_add']) === true){
				
			if(empty($_FILES['image_add']['name'])===true){
			 	echo 'Please choose a file';
			
			} else{
				$allowed = array('jpg','jpeg','gif','png');
				
				$file_name = $_FILES['image_add']['name'];
				$file_ext = strtolower(end(explode('.',$file_name)));
				$file_temp = $_FILES['image_add']['tmp_name'];
				
				if(in_array($file_ext, $allowed) === true  ){
						// need to limit file size
						
						
						if($_FILES['image_add']['size'] <= 2100000){
						
						non_drag_add_image($session_user_id, $file_temp, $file_ext,$file_name);
						make_thumbs();
						//header('Location: ' .$current_file);
						//exit();
						
						} else{
						
						echo 'File too big. Max size 2MB!';
						}
						
					
				} else{
				
					echo 'Incorrect file type. Allowed: ';
					echo implode(', ', $allowed);
				}
				
				
			
				
				
			}
						
		}
		
	/*	
		function non_drag_add_image($user_id, $file_temp, $file_ext){
	$file_name = 'images/profile/'.substr(md5(time()),0, 10). '.' .$file_ext ;
	move_uploaded_file($file_temp, $file_name);
	mysql_query("UPDATE `users` SET `profile` = '".$file_name."' WHERE `user_id` = ".(int)$user_id );	
		
}
 
	*/	
		
			// show image
		 ?>



	<body>
	<div id="uploads"> </div>
	<div class="dropzone" id="dropzone">  Drop files here to upload</div>
	
	<script> 
		(function(){
			var dropzone = document.getElementById('dropzone');
			
			var displayUploads = function(data){
				var uploads = document.getElementById('uploads'),
				anchor,mybr,img,
				x;
				
		
   			
			
			  				
				for(x = 0; x< data.length; x = x+1 ){
					img = document.createElement('img');
					p = document.createElement('p');
					
					img_anchor = document.createElement('a');
					img_anchor.setAttribute("target","_blank");
					img_anchor.href = data[x].link;
					
					
					
						
					img.setAttribute('width', '25%');
					img.setAttribute('height', '25%');
					img.src = data[x].file;
				
					img_anchor.appendChild(img);
										
					
					mybr = document.createElement('br');
					anchor = document.createElement('a');
					anchor.setAttribute("target","_blank");
					anchor.href = data[x].link;
					anchor.innerText = data[x].name;	
				
				
					uploads.appendChild(img_anchor);
					uploads.appendChild(mybr);								 	
					uploads.appendChild(anchor);
					uploads.appendChild(p);					 	
					
				
					
				}
				
				
			
				
			
			}
			
			var upload = function(files){
				var formData = new FormData(),
					xhr = new XMLHttpRequest(),
					x;
					
					
					if(files.length<11) {
					
				for(x =0; x	< files.length; x = x + 1) {
					formData.append('file[]',files[x]);
									
				}
				
				xhr.onload = function() {
				//	console.log(this.responseText);
					var data = JSON.parse(this.responseText);
					
					displayUploads(data);
					
				}
				
				xhr.open('post', 'upload.php');
				xhr.send(formData);
			
			
			} else{
			  			
    	
    			alert("Please upload 10 or fewer files");
  
  			
			}
			
			
			
			};
			
			
			dropzone.ondrop = function(e){
				e.preventDefault();				
				this.className = 'dropzone';
				upload(e.dataTransfer.files);
			};
			
			dropzone.ondragover = function(){
				this.className = 'dropzone dragover';
				return false;
			};
			
			dropzone.ondragleave = function(){
				this.className = 'dropzone';
				return false;
			};
			
			
			
		}());
	</script>
	

	 <br/ >

<div id="add-form">
 <form action="" method="post" enctype="multipart/form-data">
		 <input  type="file" name="image_add"> <input id="add-submit" type="submit">
 </form>
		
</div>
		</body>		 
<?php 











include 'includes/overall/overallfooter.php'; ?> 

