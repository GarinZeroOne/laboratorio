
<html>
	<head>
		<meta charset="utf-8">
		<style type="text/css" media="screen">
			body{
				/*
				-webkit-transition: all 2s linear;
				   -moz-transition: all 2s linear;
				    -ms-transition: all 2s linear;
				     -o-transition: all 2s linear;
				        transition: all 2s linear;

				*/
			    background:url("bg0.jpg");

			}
			#contador{
			    background-color: rgba(215, 75, 75, 0.5);
			    border: 1px solid #FFFFFF;
			    color: #FFFFFF;
			    font-size: 46px;
			    font-weight: bold;

			    padding: 10px;
			    min-width: 118px;
			    top:100px;
			    left:1%;
			    position: absolute;
			}

			#record{
			    background-color: rgba(15, 215, 75, 0.5);
			    border: 1px solid #FFFFFF;
			    color: #FFFFFF;
			    font-size: 46px;
			    font-weight: bold;

			    padding: 10px;
			    min-width: 118px;
			    top:100px;
			    left:200px;
			    position: absolute;
			}

			#wrap{
			    position: absolute;
			}

		</style>
	</head>
	<body id="elbody">

	<div id="wrap">
		<h1 style="color:#fff">Particulas que se pierden por el ancho y alto en tiempo real y máximas:</h1>
		<div id="contador">
			HOLA
		</div>

		<div id="record">

		</div>
	</div>

<canvas height="228" width="1920" id="projector">Your browser does not support the Canvas element.</canvas>

		<script type="text/javascript">

	var SCREEN_WIDTH = window.innerWidth;
    var SCREEN_HEIGHT = window.innerHeight;

	var VELOCITY = 1;
	var PARTICLES = 10;
	var mouse = {x:0, y:0};
	var particles = [];
	var bgcolors = ["#FFFFFF","#030C3A","#0A29C2","#0925AE","#2b0d57",
					"#3e0a53","#57064f","#051a5e","#010413","#C5CEFC","#3D5CF5"];
    var bgwalls = ["bg.js"];
	var colors = [ "#4D1B04","#4D1B04","#292929","#333333" ,
					"#fff","#4D1B04","#FEFFEB","#FAFF70"];
	var canvas = document.getElementById('projector');

	var cuerpo = document.getElementById('elbody');
	var context;

	var texto = document.getElementById('contador');
	var texto2 = document.getElementById('record');
	var rw=0,rh=0;


	var showMeteor = false;
	var vM = 1;

	var meteor = {
				showMeteor: true,
				vM : 1,
				mx : 0,
				my : 0,
				lastx : null,
				lasty : null,
				direction: 0,
				image: "meteor.png",
				orbit: 100
				};

	var image = new Image();
	image.src = "meteor.png";

	var inicioLinea = true;


	// Escuchar los clicks para parar el meteorito
	document.addEventListener('click',function(e){
		if(meteor.showMeteor)
			meteor.showMeteor = false;
		else
			meteor.showMeteor = true;
	});

	if (canvas && canvas.getContext) {

		context = canvas.getContext('2d');



		for( var i = 0; i < PARTICLES; i++ ) {



			var pos = {
                x: Math.random()*SCREEN_WIDTH,
                y: Math.random()*SCREEN_HEIGHT
            }

            createParticles(pos);
			/*
			particles.push( {
				x: Math.random()*window.innerWidth,
				y: Math.random()*window.innerHeight,
				vx: ((Math.random()*(VELOCITY*1.3))-VELOCITY),
				vy: ((Math.random()*(VELOCITY*1.3))-VELOCITY),
				size: 1+Math.random()*2,
				opaci: Math.random(),
				color: "rgba("+r+", "+g+", "+b+",0.7)" //colors[ Math.floor( Math.random() * colors.length ) ]
			} );
			*/
		}

		Initialize();

	}


	function createParticles(pos) {

            var p = new Particle();
            p.position.x = pos.x;
            p.position.y = pos.y;
            p.shift.x = pos.x;
            p.shift.y = pos.y;

            particles.push(p);

    }

    function Particle() {
	    this.size = 0.02 + Math.random()*5;
	    this.position = {x: 0, y: 0};
	    this.shift = {x: 0, y: 0};
	    this.angle = 0;
	    this.speed = 0.0006 + Math.random()*0.002;
	    this.force = -(Math.random()*10);
	    this.orbit = 0.1;

	    //Color aleatorio
		var r = Math.floor((Math.random()*255)+190);//Math.random()*20>>0;
		var g = Math.floor((Math.random()*220)+200);//Math.random()*30>>0;
		var b = Math.floor((Math.random()*230)+210);//Math.random()*95>>0;

	    this.color = "rgba("+r+", "+g+", "+b+",0.7)";

	    this.frozen = false;
	}

	function Initialize() {

		canvas.addEventListener('mousemove', MouseMove, false);
		//window.addEventListener('mousedown', MouseDown, false);
		window.addEventListener('resize', ResizeCanvas, false);
		setInterval( TimeUpdate, 10 );
		//setInterval( cambiarFondo, 12000);
		//setInterval( meteorito, 2000);
		ResizeCanvas();
	}

	function meteorito()
	{
		//Se esta mostrando?
		if(!meteor.showMeteor)
		{
			meteor.showMeteor = true;
			meteor.direction = 1;
		}


	}
	function cambiarFondo()
	{
		var num = Math.floor((Math.random()*5)+1);
		cuerpo.style.background = 'url("bg'+num+'.jpg")';//bgcolors[Math.floor((Math.random()*10)+1)];
	}

	function TimeUpdate(e) {

		// Limpiar  el canvas cada 40milisegundos
		//context.clearRect(0, 0, window.innerWidth, window.innerHeight);

		// alternativa para limpiar pantalla
		canvas.width = canvas.width;

		// Otra alternativa de limpiar el canvas dibujandole un relleno
		//context.fillStyle = 'rgba(0,0,0,0.3)';
        //context.fillRect(0, 0, canvas.width, canvas.height);



        //Mostarr el puto meteorito?
		if(meteor.showMeteor)
		{
			meteor.mx = mouse.x  - 110;
			meteor.my = mouse.y  - 110;

			meteor.lastx = mouse.x -100;
			meteor.lasty = mouse.y -100;

			context.drawImage(image, meteor.mx+meteor.vM, meteor.my+meteor.vM);
		}
		else
		{
			context.drawImage(image, meteor.lastx, meteor.lasty);
		}



		var len = particles.length;
		var particle;
		//contadores y record
		var ow=0,oh=0;

		for( var i = 0; i < len; i++ ) {


			var desvioX=0,desvioY=0;

			particle = particles[i];

			particle.angle += particle.speed;

            particle.shift.x += ( (meteor.mx+110) - particle.shift.x) * particle.speed;
            particle.shift.y += ((meteor.my+110) - particle.shift.y) * particle.speed;


            particle.position.x = particle.shift.x + Math.sin(i + particle.angle) * (particle.orbit*particle.force);
            particle.position.y = particle.shift.y + Math.cos(i + particle.angle) * (particle.orbit*particle.force);

            particle.orbit += (meteor.orbit - particle.orbit) * 0.01;



			if (!particle.frozen) {
				/*
				//particle.position.x += particle.speed;
				//particle.position.y += particle.speed;

				if (particle.position.x > window.innerWidth) {
					particle.speed = -VELOCITY - Math.random();
					//contador particulas que se salen del ancho
					++ow;
				}
				else if (particle.position.x < 0) {
					particle.speed = VELOCITY + Math.random();
					//contador particulas que se salen del ancho
					++ow;
				}
				else {
					particle.speed *= 1 + (Math.random() * 0.005);
				}

				if (particle.position.y > window.innerHeight) {
					particle.speed = -VELOCITY - Math.random();
					//contador particulas que se salen alto
					++oh;
					if(particle.speed == 0){
						particle.speed = aleatorio(-1,1);
					}
				}
				else if (particle.position.y < 0) {
					particle.speed = VELOCITY + Math.random();
					//contador particuals que se salen bajo
					++oh;
				}
				else {
					particle.speed *= 1 + (Math.random() * 0.0000005);
				}
			*/

				//var distanceFactor = DistanceBetween( mouse, particle );
				var distanceFactor = DistanceBetween( meteor, particle );

				//console.log(distanceFactor);
				distanceFactor = Math.max( Math.min( 15 - ( distanceFactor / 10 ), 10 ), 1 );



				//Cuanto mas cerca del mouse mas grande
				particle.currentSize = particle.size;//*distanceFactor;


					// 10-> el raton encima justo de la bola
					if(distanceFactor > 6)
					{

							console.log(distanceFactor);


							//particle.vy = (particle.vy + 3.9);
							//particle.vx = 0;

							if(particle.speed > 0)
							{
								particle.speed = 0.001;
							}
							else
							{
								particle.speed = 0.001;
							}

							if(particle.speed > 0)
							{
								particle.speed = 0.001;
							}
							else
							{
								particle.speed =0.001;
							}



							particle.angle += particle.speed;

				            particle.shift.x += (meteor.mx - particle.shift.x) * particle.speed;
				            particle.shift.y += (meteor.my - particle.shift.y) * particle.speed;

				            var desvioX = particle.shift.x + Math.sin(i + particle.angle) * (particle.orbit*particle.force);
				            var desvioY = particle.shift.y + Math.cos(i + particle.angle) * (particle.orbit*particle.force);

				            particle.orbit += (meteor.orbit - particle.orbit) * 0.01;
							//particle.vy = particle.vy;
							//particle.vx = 0;


						//console.log(particle.vy);



					}




			}

			if(desvioX)
			{
				particle.position.x = desvioX;
				particle.position.y = desvioY;
			}


			context.beginPath();

			context.fillStyle = particle.color;

			context.arc(particle.position.x,particle.position.y,particle.size/2,0,Math.PI*2,true);
			//context.closePath();
			context.fill();


			/*
			context.beginPath();
            context.fillStyle = "hsl("+((particle.position.x/canvas.width + particle.position.y/canvas.height) * 180) + ", 100%, 70%)";
            context.arc(particle.position.x, particle.position.y, particle.size/2, 0, Math.PI*2, true);
            context.fill();
			*/



		}

		texto.innerHTML = ow + ' - '+oh;

		//
		if(ow>rw){
			rw = ow;
		}

		if(oh>rh){
			rh = oh;
		}

		texto2.innerHTML = rw + ' - '+rh;








	}

	function aleatorio(inferior,superior){
	   	numPosibilidades = superior - inferior
	   	aleat = Math.random() * numPosibilidades
	   	aleat = Math.round(aleat)
	   	return parseInt(inferior) + aleat
	}

	function MouseMove(e) {

		//console.log(e.layerX);
		mouse.x = e.clientX;
		mouse.y = e.clientY;

		punterox = e.clientX;
		punteroy = e.clientY;
		/*inicioLinea = true;*/

		/*
		if(context){

			context.strokeStyle="#FF0000";
			if(inicioLinea==true){
				console.log("WTF!");
				context.beginPath();
				context.moveTo(punterox,punteroy);
				inicioLinea=false;
			}

			if(inicioLinea==false){
				context.lineTo(punterox,punteroy);
				context.stroke();
			}
		}

	*/






	}

	/*
	function MouseDown(e) {

		// Limpiar  el canvas cada 40milisegundos
		//context.clearRect(0, 0, window.innerWidth, window.innerHeight);


		var len = particles.length;
		var closestIndex = 0;
		var closestDistance = 1300;

		for( var i = 0; i < len; i++ ) {
			var thisDistance = DistanceBetween( particles[i], mouse );
			if( thisDistance < closestDistance ) {
			closestDistance = thisDistance;
			closestIndex = i;
			}
			}
			if (closestDistance < particles[closestIndex].currentSize) {
				//particles[closestIndex].frozen = true;
				//particles[closestIndex].color = "#000000";
				cuerpo.style.background = bgcolors[Math.floor((Math.random()*10)+1)];
				console.log(cuerpo);
		}
	}
	*/


	function ResizeCanvas(e) {
		canvas.width = window.innerWidth-25;
		canvas.height = window.innerHeight-20;
	}



	function DistanceBetween(p1,p2) {
		// Distancia en X
		var dx = p2.position.x-p1.mx-90;

		// Distancia en Y
		var dy = p2.position.y-p1.my-90;

		return Math.sqrt(dx*dx + dy*dy);
	}









		</script>
	</body>
</html>