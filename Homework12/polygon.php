<?php
	class Polygon
	{
		
		private $_points = array();
		
		private $color;
		
		private $width = 1;
		
		public function addPoint($x, $y){
			array_push($this->_points, $x);
			array_push($this->_points, $y);
		}
		
		public function clear(){
			$this->_points = array();
		}
		
		public function setColor($color){
			$this->color = $color;
		}
		
		public function setWidth($n){
			$this->width = $n;
		}
		
		public function draw($img){
			imagesetthickness($img, $this->width);
			if ($color === null) {
				imagepolygon($img, $this->_points, count($this->_points)/2, 
				imagecolorallocate($img, 0, 0, 0));
			}else{
				imagepolygon($img, $this->_points, count($this->_points)/2, $this->color);
			}
		}
	
	}

?>