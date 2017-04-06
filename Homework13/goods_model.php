<?php
	require_once "good.php";

	class GoodsModel
	{
		
		public function getAllGoods(){
			$data = mysqli_query($this->link, "SELECT * FROM goods");
			$res = array();
			while ($temp = mysqli_fetch_assoc($data)) {
				$res[] = new Good($temp['title'], $temp['img'], $temp['description'], $temp['price']);
			}
			return $res;
		}

		public function search(){
			$q = "SELECT * FROM goods WHERE 1";

			if ($_GET['title'] != "") {
				$title = $_GET['title'];
				$q .= " AND title LIKE '%{$title}%'";
			}
			if ($_GET['from'] != "") {
				$from = $_GET['from'];
				$q .= " AND price >= $from";
			}
			if ($_GET['to'] != "") {
				$to = $_GET['to'];
				$q .= " AND price <= $to";
			}

			$data = mysqli_query($this->link, $q);
			$res = array();

			if ($data != false) {
				
				while ($temp = mysqli_fetch_assoc($data)) {
					$res[] = new Good($temp['title'], $temp['img'], $temp['description'], $temp['price']);
				}
				
			}
			
			return $res;
		}

		function __construct(){
			$this->link = mysqli_connect('localhost', 'root', '', 'random_site');
		}

		private $link;
	}
?>