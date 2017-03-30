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

	// Получение самых новых и популярных товаров из БД

	$newest = getItemsCode("SELECT * FROM goods ORDER BY added DESC LIMIT 6");
	$popular = getItemsCode("SELECT * FROM goods ORDER BY views DESC LIMIT 6");

	// Получение посещённых страниц из БД с помощью куков

	if (isset($_COOKIE['clothes_item'])) {
		$cook = explode(",", urldecode($_COOKIE['clothes_item']));
		$req = "SELECT title, id FROM goods WHERE 0";
		
		foreach ($cook as $key => $value) {
			$req .= " OR id=$value";
		}
		
		$req .= " LIMIT 20";
		$data = mysqli_query($link, $req);
		$res = array();
		
		while ($temp = mysqli_fetch_assoc($data)) {
			$res[] = $temp;
		}
		
		$recent = "<ul>";
		
		foreach ($cook as $key => $value) {
			foreach ($res as $key1 => $value1) {
				if ($value == $value1['id']) {
					$recent .= "<li> 
						<a href='item/index.php?id={$value['id']}' atomic>{$value1['title']}<a>
					</li>";
				}
			}
		}
		
		$recent .= "</ul>";
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/index.css'/>

	</head>

	<body>
		<header>
			<a href=''>
				<img atomic src='img/logo.png'/>
			</a>
			<nav>
				<ul>
					<li listed> <a href='' atomic> Главная </a></li>
					<li listed> <a href='catalog/' atomic> Каталог </a></li>
					<li listed> <a href='manager/' atomic> Управление </a></li>

				</ul>
			</nav>
		</header>

		<main>
			<section class='new'>
				<h2 atomic> Новые товары в <i atomic>Clothes Store</i></h2>
				<p atomic> Здесь вы найдете свежие поступления в нашем магазине.</p>
				<?=$newest?>
			</section>

			<section class='populars'>
				<h2 atomic> Популярное в <i atomic>Clothes Store</i></h2>
				<p atomic> В эту категорию попадают самые популярные у посетителей Clothes Store товары.</p>
				<?=$popular?>
			</section>
		</main>

		<aside>
			<section class='search'>
				<h3 atomic> Поиск по каталогу</h3>
				<form action='catalog/'>
					<input type='text' name='name' placeholder='Название или часть названия'/><input type='submit' name='search' value='Искать'/>
				</form>
			</section>

			<section>
				<h3 atomic> Вы недавно просматривали:</h3>
				<?=$recent?>
			</section>

			<section class='ads'>
				<h3 atomic> Специальные предложения от <i atomic>Clothes Store</i></h3>
				<ul>

					<li> <img atomic src='img/ads/1.jpg'/> </li>
					<li> <img atomic src='img/ads/2.jpg'/> </li>
				</ul>
			</section>

		</aside>
	</body>

</html>

<!-- <!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/index.css'/>

	</head>

	<body>
		<header>
			<a href=''>
				<img atomic src='img/logo.png'/>
			</a>
			<nav>
				<ul>
					<li listed> <a href='' atomic> Главная </a></li>
					<li listed> <a href='catalog/' atomic> Каталог </a></li>
					<li listed> <a href='manager/' atomic> Управление </a></li>

				</ul>
			</nav>
		</header>

		<main>
			<section class='new'>
				<h2 atomic> Новые товары в <i atomic>Clothes Store</i></h2>
				<p atomic> Здесь вы найдете свежие поступления в нашем магазине.</p>
				<ul class='items'>
					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>

					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
					
					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
					
					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
					
					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
				</ul>
			</section>

			<section class='populars'>
				<h2 atomic> Популярное в <i atomic>Clothes Store</i></h2>
				<p atomic> В эту категорию попадают самые популярные у посетителей Clothes Store товары.</p>
				<ul class='items'>
					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
					
					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
					
					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
					
					<li class='item' listed> 
						<a href='' atomic>
							<figure>
								<img atomic src='img/item-2/1.jpg'/>
								<figcaption>
									<h3 atomic> Футболка мужская <i>Modern</i></h3>
									<p class='color' atomic> Цвет: Зеленый </p>
									<p class='size' atomic> Размер: XL</p>
									<p class='price' atomic> 646 000 р.</p>
								</figcaption>
							</figure>
						</a>
					</li>
				</ul>
			</section>
		</main>

		<aside>
			<section class='search'>
				<h3 atomic> Поиск по каталогу</h3>
				<form action='catalog/'>
					<input type='text' name='name' placeholder='Название или часть названия'/><input type='submit' name='search' value='Искать'/>
				</form>
			</section>

			<section>
				<h3 atomic> Вы недавно просматривали:</h3>
				<ul>
					<li listed> <a href='catalog/' atomic> Футболка мужская Middle Eastern </a></li>
					<li listed> <a href='catalog/' atomic> Футболка мужская Middle Eastern </a></li>
				</ul>
			</section>

			<section class='ads'>
				<h3 atomic> Специальные предложения от <i atomic>Clothes Store</i></h3>
				<ul>

					<li> <img atomic src='img/ads/1.jpg'/> </li>
					<li> <img atomic src='img/ads/2.jpg'/> </li>
				</ul>
			</section>

		</aside>
	</body>

</html> -->