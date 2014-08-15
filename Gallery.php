<?php

$user_images = find_user_images($session_user_id);

class Gallery{
	public $path;
	
	public function __construct(){
		 $this->path = __DIR__. './uploads';
	
	}
	
	public function setPath($path){
	
	if(substr($path,-1)=== '/'){
		$path = substr($path, 0, -1);
	
	}
	
	$this-> path = $path;
	
	}
	
	private function getDirectory($path){
		return scandir($path);
	
	}

	public function getImages($extensions = array('jpg', 'png','gif', 'jpeg'), $user_images){
		$images = $this->getDirectory($this->path);
		
		
		
		foreach($images as $index => $image){
			$extension = strtolower(end(explode('.',$image)));
			if(!in_array($extension, $extensions)){
				unset($images[$index]);
			}	else{
			
			
				if(in_array($image, $user_images)) {
			
					$images[$index] = array(
						'full' => $this->path. '/' . $image,
						//'thumb' => $this->path. '/' . $image
						'thumb' => $this->path. '/thumbs/' . $image
					);
				
					} //end in array if 
					else{
					unset($images[$index]);
					
					}
		
				} // end else			
		}
		
		
		return (count($images)) ? $images : false;
	}
}


?>