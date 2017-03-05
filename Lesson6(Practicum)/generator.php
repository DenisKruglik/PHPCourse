<?php
	header("Content-Type: text/html;charset=utf-8");
	$main_page = file_get_contents("http://www.album-info.ru/albumlist.aspx");
	$genres = file_get_contents("genres.txt");
	$genres = explode("\r\n", $genres);
	$genres_len = count($genres);
	foreach ($genres as $key => $value) {
		$genres[$key] = array();
		$genres[$key]["name"] = $value;
	}
	$matches = array();


	for ($i=0; $i < $genres_len; $i++) { 
		$page = file_get_contents("http://www.album-info.ru/albumlist.aspx?genre=".($i+1));
		$exp = '/<a id="ctl00_CPH_pgr_btnLast" href="\?genre='.($i+1).'&amp;page=([^\"]*)">/';
		preg_match_all($exp, $page, $matches);
		$pages_amount = $matches[1][0];


		for ($j=1; $j <= $pages_amount; $j++) { 
			$temp = file_get_contents("http://www.album-info.ru/albumlist.aspx?genre=".($i+1)."&page=".$j);
			$exp = "/<b>([^<>]*)<\/b><p>([^<>]*)<\/p><span>([^<>]*)<\/span>/ms";
			preg_match_all($exp, $temp, $matches);


			foreach ($matches[1] as $key => $value) {
				


				if (array_key_exists("artists", $genres[$i])) {
				 	if (array_key_exists($matches[1][$key], $genres[$i]["artists"])) {
				 		$genres[$i]["artists"][$matches[1][$key]]["releases"][] = array(
				 			"name" => $matches[2][$key],
				 			"type" => $matches[3][$key]
				 		);
				 	}else{
				 		$artist = array(
							"releases" => array()
						);
						$artist["releases"][] = array(
				 			"name" => $matches[2][$key],
				 			"type" => $matches[3][$key]
				 		);
						$genres[$i]["artists"][$matches[1][$key]] = $artist;
				 	}
				} else {
					$artist = array(
						"releases" => array()
					);
					$artist["releases"][] = array(
						"name" => $matches[2][$key],
				 		"type" => $matches[3][$key]
					);
					$genres[$i]["artists"] = array();
					$genres[$i]["artists"][$matches[1][$key]] = $artist;
				}
			}
		}
	}

	file_put_contents("data",json_encode($genres));
?>