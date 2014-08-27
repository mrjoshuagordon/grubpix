
<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;



?> 


<?php
		
		if(isset($_FILES['image_add']) === true){
				
			if(empty($_FILES['image_add']['name'])===true){
			 	echo 'Please choose a file';
			
			} else{
				$allowed = array('jpg','jpeg','gif','png');
				
				$file_name = $_FILES['image_add']['name'];
				$file_ext = strtolower(end(explode('.',$file_name)));
				$file_temp = $_FILES['image_add']['tmp_name'];
				
				if(in_array($file_ext, $allowed) === true){
					
					//change_profile_image($session_user_id, $file_temp, $file_ext);
					//make_profile_thumbs();
					header('Location: ' .$current_file);
					exit();
				} else{
				
					echo 'Incorrect file type. Allowed: ';
					echo implode(', ', $allowed);
				}
				
				
				// need to limit file size
				
				
			}
						
		}
		
			// show image
		 ?>




<p> File Upload (jpg, jpeg, gif, or png). Max Size 2MB: </p>


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
					img.setAttribute('width', '25%');
					img.setAttribute('height', '25%');
					img.src = data[x].file;
					mybr = document.createElement('br');
					anchor = document.createElement('a');
					anchor.setAttribute("target","_blank");
					anchor.href = data[x].file;
					anchor.innerText = data[x].name;	
					
					uploads.appendChild(img);
					uploads.appendChild(mybr);								 	
					uploads.appendChild(anchor);
					uploads.appendChild(p);					 	
					
				
					
				}
			
			}
			
			var upload = function(files){
				var formData = new FormData(),
					xhr = new XMLHttpRequest(),
					x;
					
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

 <form action="" method="post" enctype="multipart/form-data">
		 <input type="file" name="image_add"> <input type="submit">
 </form>
		
		</body>		 
<?php 











include 'includes/overall/overallfooter.php'; ?> 

