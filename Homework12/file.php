<?php
	
	class File
	{
		
		private $path;

		private $info;

		public function getSize(){
			return filesize($this->path);
		}

		public function getExtension(){
			return $this->info['extension'];
		}

		public function getLastModified(){
			return date("F d Y H:i:s", filemtime($this->path));
		}

		public function getPath(){
			return $this->path;
		}

		public function putContent($c){
			file_put_contents($this->path, $c);
		}

		public function getContent(){
			return file_get_contents($this->path);
		}

		public function remove(){
			unlink($this->path);
			unset($this);
		}

		public function move($path){
			rename($this->path, $path);
			$this->path = $path;
		}

		public function copy($path){
			copy($this->path, $path);
		}

		function __construct($path)
		{
			$this->path = $path;
			$this->info = pathinfo($path);
		}
	}

?>