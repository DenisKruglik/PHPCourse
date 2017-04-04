<?php
	class Comment
	{
		
		function __construct($time, $text)
		{
			$this->time = $time;
			$this->text = $text;
		}

		private $time, $text;

		public function getText(){
			return $this->text;
		}

		public function getTime(){
			return $this->time;
		}
		
	}
?>