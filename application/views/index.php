<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pokemons</title>
	<style>
		body {
			background-image: url('/assets/images/pixel-sea.jpg');
			background-size: cover;
			background-repeat: no-repeat;
		}
		ul {
			width: 993px;
			height: 620px;
			overflow: scroll;
			display:inline-block;
		}
		ul li {
			list-style-type: none;
			width: 120px;
			height: 120px;
			display: inline;
		}
		div#pokedex {
			width: 300px;
			display:inline-block;
			vertical-align: top;
		}
		div#pokedex ul {
			width: 100%;
			height: 100%;
		}
		div#pokedex ul li {
			list-style-type: circle;
			display:block;
			width: 100%;
			height: 100%;
		}
	</style>
	<script type="text/javascript" src="/assets/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript">
	var attachHandler = function() 
	{
			$(document).on("click","li", function()
			{
				var id = $(this).attr('id');
				var image = $(this).children('img').attr('src');
				var types = [];
				$.get("http://pokeapi.co/api/v1/pokemon/" + id + "/", function(data) 
				{
					$.each(data.types, function(index, value) {
						types.push(value.name);
					});

                    var html_str = "";
                    html_str += "<h3>" + data.name + "</h3>";
                    html_str += "<img src='" + image + "' alt='" + data.name + "' title='" + data.name + "' />";
                    html_str += "<h4>Types</h4>"
					html_str += "<ul>";
					for(var i=0; i<types.length; i++)
					{
						html_str += "<li>" + types[i] + "</li>";
					}
					html_str += "</ul>";
					html_str += "<h4>Height</h4>";
					html_str += "<p>" + data.height + "</p>";
					html_str += "<h4>Weight</h4>";
					html_str += "<p>" + data.weight + "</p>";
					var pokedex = document.getElementById('pokedex');
					pokedex.innerHTML = html_str;

				}, "json");
			})
	}
    $(document).ready(function()
    {
    	for(var i=2; i<=250; i++){
	    	$.get("http://pokeapi.co/api/v1/sprite/" + i + "/", function(data) 
	    	{
	    		console.log(data);
	    		$('div#container ul').append("<li id='" + (data.id - 1) + "'><img src='http://pokeapi.co" + data.image +  "' alt='" + "'" + data.pokemon.name + "' title='" + data.pokemon.name + "' /></li>");
	        }, "json");
    	}
    	attachHandler();
    });
	</script>
</head>
<body>
	<div id="container">
		<ul>
		</ul>
		<div id="pokedex">
		</div>
	</div>
</body>
</html>