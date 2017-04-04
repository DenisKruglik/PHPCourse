<?php
	
	class Vector2D
	{
		
		private $x;

		private $y;

		function __construct($x, $y)
		{
			$this->x = $x;
			$this->y = $y;
		}

		public function length(){
			return sqrt(pow($this->x, 2) + pow($this->y, 2));
		}

		public function angle(){
			return acos($this->x/$this->length);
		}

		public function getNorm(){
			return new Vector2D($this->y, -$this->x);
		}

		public function turn($a){
			$angle = deg2rad($a);
			$rotX = $this->x * cos($angle) - $this->y * sin($angle);
			$rotY = $this->x * sin($angle) + $this->y * cos($angle);
			$this->x = $rotX;
			$this->y = $rotY;
		}
	}

?>