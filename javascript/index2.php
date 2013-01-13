
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
			    /*cursor: none;*/
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

MeteorRain = new function() {

    var SCREEN_WIDTH = window.innerWidth;
    var SCREEN_HEIGHT = window.innerHeight;

    var cursor, canvas, context;

    var particles = [];

    var mouseX = 0;
    var mouseY = 0;

    this.init = function() {
        canvas = document.querySelector("canvas");

        if (canvas && canvas.getContext) {
            context = canvas.getContext('2d');

            document.addEventListener('mousemove', documentMouseMoveHandler, false);
            document.addEventListener('mousedown', documentMouseDownHandler, false);
            window.addEventListener('resize', windowResizeHandler, false);

            createCursor();

            windowResizeHandler();

            setInterval(loop, 1000/100);
        }
    }

    function createCursor(position) {
        var w = 300;
        var h = 300;

        if (!position){
            var pos = {
                x: ( SCREEN_WIDTH - w ) * 0.5 + (Math.random() * w),
                y: ( SCREEN_HEIGHT - h ) * 0.5 + (Math.random() * h)
            }

            var m = new Cursor();
            m.position.x = pos.x;
            m.position.y = pos.y;

            cursor = m;

            createParticles(m.position);

        } else {
            var m = new Cursor();
            m.position.x = position.x;
            m.position.y = position.y;

            createParticles(m.position);
        }
    }

    function createParticles(pos) {
        for (var i = 0; i < 50; i++) {
            var p = new Particle();
            p.position.x = pos.x;
            p.position.y = pos.y;
            p.shift.x = pos.x;
            p.shift.y = pos.y;

            particles.push(p);
        }
    }

    function documentMouseMoveHandler(event) {
        mouseX = event.clientX;
        mouseY = event.clientY;
    }

    function documentMouseDownHandler(event) {
        createCursor({x: mouseX, y: mouseY});
    }

    function windowResizeHandler() {
        canvas.width = SCREEN_WIDTH;
        canvas.height = SCREEN_HEIGHT;

        canvas.style.position = 'absolute';

        canvas.style.left = (window.innerWidth - SCREEN_WIDTH) * 0.5 + 'px';
        canvas.style.top = (window.innerHeight - SCREEN_HEIGHT) * 0.5 + 'px';
    }

    function loop() {
        context.fillStyle = 'rgba(0,0,0,0.3)';
        context.fillRect(0, 0, canvas.width, canvas.height);

        var particle;
        var i, j, ilen, jlen;

        cursor.position.x += (mouseX - cursor.position.x)*0.1;
        cursor.position.y += (mouseY - cursor.position.y)*0.1;

        for (i = 0, ilen = particles.length; i < ilen; i++) {
            particle = particles[i];

            particle.angle += particle.speed;

            particle.shift.x += (cursor.position.x - particle.shift.x) * particle.speed;
            particle.shift.y += (cursor.position.y - particle.shift.y) * particle.speed;

            particle.position.x = particle.shift.x + Math.sin(i + particle.angle) * (particle.orbit*particle.force);
            particle.position.y = particle.shift.y + Math.cos(i + particle.angle) * (particle.orbit*particle.force);

            particle.orbit += (cursor.orbit - particle.orbit) * 0.01;

            context.beginPath();
            context.fillStyle = "hsl("+((particle.position.x/canvas.width + particle.position.y/canvas.height) * 180) + ", 100%, 70%)";
            context.arc(particle.position.x, particle.position.y, particle.size/2, 0, Math.PI*2, true);
            context.fill();
        }
    }
}

function distanceBetween(p1,p2) {
    var dx = p2.x - p1.x;
    var dy = p2.y - p1.y;
    return Math.sqrt(dx^2 + dy^2);
}

function Particle() {
    this.size = 2 + Math.random()*4;
    this.position = {x: 0, y: 0};
    this.shift = {x: 0, y: 0};
    this.angle = 0;
    this.speed = 0.01 + Math.random()*0.02;
    this.force = -(Math.random()*10);
    this.orbit = 1;
}

function Cursor() {
    this.orbit = 100;
    this.position = {x: 0, y: 0};
}

MeteorRain.init();

		</script>
	</body>
</html>