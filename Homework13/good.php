<?php
	class Good
	{
		
		private $img, $title, $description, $price;

		function __construct($title, $img, $description, $price)
		{
			$this->title = $title;
			$this->img = $img;
			$this->description = $description;
			$this->price = $price;
		}

		public function getTitle(){
			return $this->title;
		}

		public function getImage(){
			return $this->img;
		}

		public function getDescription(){
			return $this->description;
		}

		public function getPrice(){
			return $this->price." $";
		}
	}
?>