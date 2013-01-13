<html>
<head>
	<title>Pruebas javascriop</title>



</head>
<body>

	<canvas id="canvas" width="500" height="500"></canvas>

<script type="text/javascript">
		//Inicializamos el canvas
		var canvas = document.getElementById("canvas");
		var ctx = canvas.getContext("2d");

		//Dimensiones del canvas
		var W = 500; var H = 500;

		// El array de particulas
		var particulas = [];

		for(var i=0; i<16; i++)
		{
			// creamos las particulas
			particulas.push(new crearParticulas());
		}


		function crearParticulas()
		{
			//Les asignamos una posición aleatoria en el canvas
			this.x = Math.random()*W;
			this.y = Math.random()*H;

			//Les asignamos una velocidad aleatoria

			this.vx = Math.random()*1-0;
			this.vy = Math.random()*4-(-1);

			//Color aleatorio
			var r = Math.random()*255>>0;
			var g = Math.random()*255>>0;
			var b = Math.random()*255>>0;


			this.color = "rgba("+r+", "+g+", "+b+",0.7)";

			//Tamaño aleatorio
			this.radio = Math.random()*20+4;


		}

		var x = 100;
		var y = 100;

		function dibujar()
		{
		 //Mover el fondo nos sirve para borrar el rastro que va dejando cada partícula
		 //Ponemos el color de fondo negro
		 //Pero el fondo no debe mezclarse con el frame anterior.

		//Más info:<a href="https://developer.mozilla.org/en/Canvas_tutorial/Compositing">https://developer.mozilla.org/en/Canvas_tutorial/Compositing</a>

		//ctx.globalCompositeOperation = "source-over";

		//También reducimos un poco la opacidad
		 ctx.fillStyle = "rgba(0, 0, 0, 0.7)";
		 ctx.fillRect(0, 0, W, H);

		 //Hacemos que las partículas se mezclen con el fondo
		 //ctx.globalCompositeOperation = "lighter";

		 //Ahora iteramos el array de partículas para pintarlas
		 for(var t = 0; t < particulas.length; t++)
		 {
		 var p = particulas[t];

		 ctx.beginPath();

		 //Damos color

		 var gradient = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.radio);
		 gradient.addColorStop(0, "white");
		 gradient.addColorStop(0.4, "white");
		 gradient.addColorStop(0.4, p.color);
		 gradient.addColorStop(1, "black");

		 ctx.fillStyle = gradient;

		 ctx.arc(p.x, p.y, p.radio, Math.PI*2, false);
		 ctx.fill();

		 //Ahora asignamos la velocidad
		 p.x += p.vx;
		 p.y += p.vy;

		 //Aquí controlamos que las partículas no se salgan del canvas
		 if(p.x < -50) p.x = W+50;
		 if(p.y < -50) p.y = H+50; if(p.x > W+50) p.x = -50;
		 if(p.y > H+50) p.y = -50;
		 }
		}


		setInterval(dibujar, 60);

	</script>

</body>
</html>