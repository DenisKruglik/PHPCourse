<?php
	
	class SQLConnection
	{
		private $link;

		private $last_query;

		private $last_error;

		function __construct()
		{
			if (func_num_args() !== 4) {
				$this->link = mysqli_connect('localhost', 'root', '', 'random_site');
			}else{
				$this->link = mysqli_connect(func_get_arg(0), func_get_arg(1), func_get_arg(2), func_get_arg(3));
			}
		}

		public function execSQL($q){
			$this->last_query = $q;
			$this->last_error = mysqli_error($this->link);
			mysqli_query($this->link, $q);
		}

		public function getArray($q){
			$this->last_query = $q;
			$this->last_error = mysqli_error($this->link);
			$data = mysqli_query($this->link, $q);
			$res = array();
			while ($temp = mysqli_fetch_assoc($data)) {
				$res[] = $temp;
			}
			return $res;
		}

		public function getLastQuery(){
			return $this->last_query;
		}

		public function getLastError(){
			return $this->link->error;
		}

	}

?>