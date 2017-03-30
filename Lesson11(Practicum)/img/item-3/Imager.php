<?php
	
require_once $_SERVER['DOCUMENT_ROOT']."/core/lib/system/System.php";
require_once $_SERVER['DOCUMENT_ROOT']."/core/lib/utils/Utils.php";

class Imager{

	const CATALOG_NAME = "cata_images";
	
	public static function getFolders(){
		$catalog = new RCatalog(self::CATALOG_NAME);
		$folders = $catalog->getAllByQuery(0," 1 order by id ASC");
		
		return $folders;
	}
	
	public static function removeFolder($id){
		$catalog = new RCatalog(self::CATALOG_NAME);
		$result = $catalog->remove($id, 0);
		return $result;
	}
	
	public static function addFolder($name){
		$catalog = new RCatalog(self::CATALOG_NAME);
		$res = $catalog->getAllByQuery(0, "name='$name'");	
			
		if(count($res)) return 0;
		$result = $catalog->addItem(array($name));
		if($result){
			$res = $catalog->getAllByQuery(0, "name='$name'");
			$res = $res[0]['id'];
		}
		return $res;
	}
	
	public static function getImages($id){
		$res = RImages::getImages($id);
		return $res;
	}
}