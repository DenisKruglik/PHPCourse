<?php
	require_once "comment.php";

	class CommentsModel
	{
		
		public function getAllComments(){
			$raw = file_get_contents(self::FILENAME);
			$d = explode("\n", $raw);
			$result = array();
			foreach ($d as $value) {
				$r = explode(";", $value);
				$result[] = new Comment($r[0], $r[1]);
			}
			return $result;
		}

		public function putComment($c){
			$r = file_get_contents(self::FILENAME);
			$text = $c->getTime().";".$c->getText();
			file_put_contents(self::FILENAME, $r."\n".$text);
		}

		const FILENAME = "comments.txt";

	}
?>