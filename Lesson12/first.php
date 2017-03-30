<?php
	#namespace First;
	
	class ComplexFloat{
		
		private $real;
		
		private $imaginary;
		
		public function getReal(){
			return $this->real;
		}
		
		public function getImaginary(){
			return $this->imaginary;
		}
		
		public function ComplexFloat($r, $i){
			$this->real = $r;
			$this->imaginary = $i;
		}
		
		public function addComplex($x){
			$this->real += $x->getReal();
			$this->imaginary += $x->getImaginary();
		}
		
		public function abs(){
			return sqrt(pow($this->real, 2) + pow($this->imaginary, 2));
		}
		
	}
?>