$(function(){
	$.get('get_all.php', {}, function(r){
		// console.log(r);
		var data = JSON.parse(r);
		console.log(data);
		var res = '';
		$.each(data, function(){
			res += '<div class="good">\
					<h3>'+this.title+'</h3>\
					<figure>\
						<img src="'+this.image+'">\
						<figcaption>\
							<p>'+this.description+'</p>\
							<div>Цена: '+this.price+'</div>\
						</figcaption>\
					</figure>\
				</div>';
		});
		$('.goods').html(res);
	});

	$('#search').click(function(e){
		$.get('search.php', {
			title: $('#title').val(),
			from: $('#from').val(),
			to: $('#to').val()
		}, function(r){
			var data = JSON.parse(r);
			var res = '';
			$.each(data, function(){
				res += '<div class="good">\
						<h3>'+this.title+'</h3>\
						<figure>\
							<img src="'+this.image+'">\
							<figcaption>\
								<p>'+this.description+'</p>\
								<div>Цена: '+this.price+'</div>\
							</figcaption>\
						</figure>\
					</div>';
			});
			$('.goods').html(res);
		});
	});
})