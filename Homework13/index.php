<?php
	require_once "goods_model.php";

	header("Content-Type: text/html; charset=utf-8");

	$model = new GoodsModel();

	if (isset($_GET['title']) || isset($_GET['from']) || isset($_GET['to'])){
		$data = $model->search();
	}else{
		$data = $model->getAllGoods();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form>
		<div>
			<label>
				<span>Название</span>
				<input type="text" name="title">
			</label>
		</div>
		<div>
			<label>
				<span>Цена от</span>
				<input type="number" name="from" min="0" step="0.01">
			</label>
		</div>
		<div>
			<label>
				<span>Цена до</span>
				<input type="number" name="to" min="0" step="0.01">
			</label>
		</div><input type="submit" name="submit" value="Искать">
	</form>
	<div class="goods">
		<?php
			foreach ($data as $item) {
				echo "<div class='good'>
					<h3>{$item->getTitle()}</h3>
					<figure>
						<img src='{$item->getImage()}'>
						<figcaption>
							<p>{$item->getDescription()}</p>
							<div>Цена: {$item->getPrice()}</div>
						</figcaption>
					</figure>
				</div>";
			}
		?>
	</div>
</body>
</html>