<?php
	header("Content-Type: text/html; charset=utf-8");
	
	$link = mysqli_connect("localhost", "root", "", "shop");
	function getItemsCode($req){
		global $link;
		$data = mysqli_query($link, $req);
		$res = array();
		while ($temp = mysqli_fetch_assoc($data)) {
			$res[] = $temp;
		}
		$list = "<ul class='items'>";
		foreach ($res as $key => $value) {
			$title = $value['title'];
			$matches = array();
			preg_match_all("/([^A-Za-z]*)([A-Za-z]*)/", $title, $matches);
			$title = "{$matches[1][0]}<i>{$matches[2][0]}</i>";
			$price = number_format($value['price'], 2, ".", " ");
			$list .= "<li class='item' listed> 
						<a href='item/index.php?id={$value['id']}' atomic>
							<figure>
								<img atomic src='{$value['img']}'/>
								<figcaption>
									<h3 atomic> $title </h3>
									<p class='color' atomic> Цвет: {$value['color']} </p>
									<p class='size' atomic> Размер: {$value['size']}</p>
									<p class='price' atomic> $price р.</p>
								</figcaption>
							</figure>
						</a>
					</li>";
		}
		$list .= "</ul>";
		return $list;
	}

	// Запоминаем куки

	if (isset($_COOKIE['clothes_item'])) {
		$cook = explode(",", urldecode($_COOKIE['clothes_item']));
		if (!in_array($_GET['id'], $cook)) {
			setcookie('clothes_item', urldecode($_COOKIE['clothes_item']).",".$_GET['id'], time() + (60 * 60 * 24 * 30), "/");
		}
	}else{
		setcookie('clothes_item', $_GET['id'], time() + (60 * 60 * 24 * 30), "/");
	}
	

	// Получаем информацию о товаре

	$link = mysqli_connect("localhost", "root", "", "shop");
	$data = mysqli_query($link, "SELECT * FROM goods WHERE id=".intval($_GET['id']));
	$res = array();
	while ($temp = mysqli_fetch_assoc($data)) {
		$res[] = $temp;
	}

	// Получаем название и стоимость в нужном формате

	$title = $res[0]['title'];
	$matches = array();
	preg_match_all("/([^A-Za-z]*)([A-Za-z]*)/", $title, $matches);
	$title = "{$matches[1][0]}<i>{$matches[2][0]}</i>";
	$price = number_format($res[0]['price'], 2, ".", " ");

	// Получаем адреса картинок из галереи

	$data2 = mysqli_query($link, "SELECT src FROM pics WHERE good_id=".intval($_GET['id']));
	$res2 = array();
	while ($temp = mysqli_fetch_assoc($data2)) {
		$res2[] = $temp;
	}
	$list = "<ul>";
	foreach ($res2 as $key => $value) {
		$list .= "<li><img src='{$value['src']}'></li>";
	}
	$list .= "</ul>";

	// Получаем рекомендованные товары

	$recommended = getItemsCode("SELECT * FROM goods WHERE id != ".intval($_GET['id'])." ORDER BY RAND() LIMIT 4");
?>

<!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>
		
		<base href='../'/>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/item.css'/>

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
			<section class='main'>
				<figure>
					<img src='<?=$res[0]['img']?>'/>
					<figcaption>
						<h2> <?=$title?></i></h2>
						<p class='size'> Размер: <?=$res[0]['size']?></p>
						<p class='color'> Цвет: <?=$res[0]['color']?> </p>
						<div class='price'> <?=$price?> р.</div>

						<form action='add.php'>
							<input type='hidden' name='id' value='-Вставить сюда id товара-'/>
							<input type='number' min=0 max=10  value=1 name='amount'/>
							<input type='submit' name='add' value='Добавить'/>
						</form>

						<p class='description'> <?=$res[0]['description']?> </p>
					</figcaption>
				</figure>
			</section>

			<section class='gallery'>
				<h2> Фотогалерея этого товара: </h2>
				<?=$list?>
			</section>

			<section class='others'>
				<h2> Возможно, Вас заинтересуют:</h2>
				<?=$recommended?>
			</section>
		</main>

	</body>

</html>

<!-- <!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>
		
		<base href='../'/>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/item.css'/>

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
			<section class='main'>
				<figure>
					<img src='img/item.jpg'/>
					<figcaption>
						<h2> Футболка мужская <i>Modern</i></h2>
						<p class='size'> Размер: XL</p>
						<p class='color'> Цвет: Синий </p>
						<div class='price'> 736 000 р.</div>

						<form action='add.php'>
							<input type='hidden' name='id' value='-Вставить сюда id товара-'/>
							<input type='number' min=0 max=10  value=1 name='amount'/>
							<input type='submit' name='add' value='Добавить'/>
						</form>

						<p class='description'> Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. </p>
					</figcaption>
				</figure>
			</section>

			<section class='gallery'>
				<h2> Фотогалерея этого товара: </h2>
				<ul>
					<li> <img src='img/item.jpg'/> </li>
					<li> <img src='img/item2.jpg'/> </li>
					<li> <img src='img/item3.jpg'/> </li>
					<li> <img src='img/item1.jpg'/> </li>
					<li> <img src='img/item.jpg'/> </li>
					<li> <img src='img/item3.jpg'/> </li>
					<li> <img src='img/item2.jpg'/> </li>
				
					
				</ul>
			</section>

			<section class='others'>
				<h2> Возможно, Вас заинтересуют:</h2>
				<ul class='items'>
					<li class='item'> 
						<a href=''>
							<figure>
								<img src='img/item-2/1.jpg'/>
								<figcaption>
									<h3> Футболка мужская <i>Modern</i></h3>
									<p class='color'> Цвет: Зеленый </p>
									<p class='size'> Размер: XL</p>
									<p class='price'> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>

					<li class='item'> 
						<a href=''>
							<figure>
								<img src='img/item-3/1.jpg'/>
								<figcaption>
									<h3> Футболка мужская <i>Modern</i></h3>
									<p class='color'> Цвет: Зеленый </p>
									<p class='size'> Размер: XL</p>
									<p class='price'> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>

					<li class='item'> 
						<a href=''>
							<figure>
								<img src='img/item-4/1.jpg'/>
								<figcaption>
									<h3> Футболка мужская <i>Modern</i></h3>
									<p class='color'> Цвет: Зеленый </p>
									<p class='size'> Размер: XL</p>
									<p class='price'> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>

					<li class='item'> 
						<a href=''>
							<figure>
								<img src='img/item-6/1.jpg'/>
								<figcaption>
									<h3> Футболка мужская <i>Modern</i></h3>
									<p class='color'> Цвет: Зеленый </p>
									<p class='size'> Размер: XL</p>
									<p class='price'> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
				</ul>
			</section>
		</main>

	</body>

</html> -->