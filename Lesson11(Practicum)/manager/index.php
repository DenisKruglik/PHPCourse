<?php header("Content-Type: text/html;charset=UTF-8"); ?>
<?php 
	$link=mysqli_connect("localhost","root","","shop");
	if($_POST["name"]){
		$id=mysqli_query($link, "SELECT id FROM goods ORDER BY id DESC LIMIT 1")+1;
		$imgName=time();
		$name=$_POST["name"];
		$color=$_POST["color"];
		$size=$_POST["size"];
		$price=$_POST["price"];
		$description=$_POST["description"];
		$Loc=$_FILES["picture"]["tmp_name"];
		$fileName=$_FILES["picture"]["name"];
		copy($Loc, "images/".$fileName);
		rename("images/".$fileName, "images/".$imgName.".jpg");
		$picture="/helloworldsite/manager/images/".$imgName.".jpg";
		$data=mysqli_query($link, "INSERT INTO goods VALUES(default, \"$name\", \"$size\", \"$price\", \"$color\", \"$picture\", \"$description\", 0, NOW())");
		$data=mysqli_query($link, "INSERT INTO pics VALUES(default, \"$id\", \"$picture\")");
	}
	if ($_POST["id"]) {
		$id=$_POST["id"];
		$imgName=time();
		$file=$_FILES["supPicture"]["tmp_name"];
		$pic=$_FILES["supPicture"]["name"];

		$info=pathinfo($pic);
		$type=$info["extension"];
		#echo $file. ", images/".$imgName.".".$type;
		copy($file, "images/".$imgName.".".$type);
		$picture="/helloworldsite/manager/images/".$imgName.".".$type;
		$data=mysqli_query($link, "INSERT INTO pics VALUES(default, \"$id\", \"$picture\")");
	}
	$data=mysqli_query($link, "SELECT DISTINCT size FROM goods");
	$datalistSize = array();
	while ($temp=mysqli_fetch_assoc($data)) {
		$datalistSize[]=$temp;
	}
	$listSize="";
	foreach ($datalistSize as $key => $value) {
		$listSize.="<option value='{$value['size']}'/>";
	}
	$listSize="<datalist id='sizes'>".$listSize."</datalist>";
	$data=mysqli_query($link, "SELECT DISTINCT color FROM goods");
	$datalistColors = array();
	while ($temp=mysqli_fetch_assoc($data)) {
		$datalistColors[]=$temp;
	}
	$listColors="";
	foreach ($datalistColors as $key => $value) {
		$listColors.="<option value='{$value['color']}'/>";
	}
	$listColors="<datalist id='colors'>".$listColors."</datalist>";
?>
<!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>

		<base href='../'/>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/manager.css'/>

		
	</head>

	<body>
		<header>
			<a href=''>
				<img src='img/logo.png'/>
			</a>
			<nav>
				<ul>
					<li> <a href=''> Главная </a></li>
					<li> <a href='catalog/'> Каталог </a></li>
					<li> <a href='manager/'> Управление </a></li>

				</ul>
			</nav>
		</header>

		<main>
			<form action='' method='POST' enctype='multipart/form-data'> 
				<h2> Добавить товар</h2>
				<label>
					<span> Название товара</span>
					<input type='text' name='name' value='' />
				</label>

				<label>
					<span> Цвет </span>
					<input type='text' name='color' list='colors' />
					<?php echo $listColors; ?>
				</label>

				<label>
					<span> Размер </span>
					<input type='text' name='size' list='sizes' />
					<?php echo $listSize ?>
				</label>

				<label>
					<span> Цена </span>
					<input type='number' name='price' step="0.01" />
				</label>

				<label>
					<span> Описание товара</span>
					<input type='text' name='description' value='' />
				</label>

				<label>
					<span>Изображение</span>
					<input type='file' name='picture' />
				</label>

				<input type='submit' value='Создать товар'/>
			</form>

			<form action='' method='POST' enctype='multipart/form-data'> 
				<h2> Добавить изображение товару </h2>
				
				<label>
					<span> ID товара</span>
					<input type='number' name='id'/>
				</label>

				<label>
					<span> Выберите файл..</span>
					<input type='file' name='supPicture' />
				</label>

				

				<input type='submit' value='Добавить!'/>
			</form>


			<p> <a href='excel.php' target='_blank'> Выгрузить все товары в Excel </a></p>
			<p> <a href='stats.php' target='_blank'> Выгрузить статистику в Excel </a></p>

		</main>
	</body>

</html>