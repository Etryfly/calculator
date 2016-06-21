<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<style>
		#calculator {
			margin: 100px;
			height: 50px;
			width: 400px;

		}

	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>

<body>





<div id="calculator">
	<select class="dir1" onchange="submit();"> </select><br>
	<h1>ОБЬЕМ</h1>
	<table>

		<tr>
			<td><input type="number" class="x" onkeyup="vol();usl(1);percent();"></td>
			<td><input type="number" class="y" onkeyup="vol();usl(1);percent();"></td>
			<td><input type="number" class="z" onkeyup="vol();usl(1);percent();"></td>
			<td><input type="submit" value="Рассчитать" onclick="s(1);"></td>
			<td></td>
		</tr>

	</table>


	<br>
	<br>
	<table>






		<tr>

			<td>

			</td>


			<!--td><input onkeyup="usl(1);res();percent();" onchange="usl(1);res();percent();" type="number" class="inp1"></td>

			<td><input type="submit" value="Рассчитать" onclick="submit();usl(1);percent();res();vol()"></td-->

		</tr>




	</table>


	<br><br><br>

	<h1>ВЕС</h1>
	<table>


		<tr>



			<td><input type="number" onkeyup="usl(2);" class="inp2"></td>
			<!--td><input type="number" id="result"></td-->
			<td><input type="submit" value="Рассчитать" onclick=" s(2);flag = 2 "></td>

		</tr>

	</table>


	<br>
	<p> Результат: </p>
	<div id="result"></div>
</div>
<script>
	var flag;

	function vol() {
		window.x = $('.x').val();
		window.y = $('.y').val();
		window.z = $('.z').val();
		window.v = x * y * z / 1000000;
		window.inp1 = v;
		//usl(1);
		//document.getElementById('v_result').value = '123';
		//alert(v);
		//document.getElementsByClassName("inp1").value = x * y * z;
		//$('div[id="#v_result"]').innerHTML(23);

	}



	$(document).ready(function () {
		// $('#f').click(function () {
		$.ajax({
			url: "connect.php",
			cache: false,

			success: function (responce) {
				$('.dir1').html(responce);
				//$('.dir2').html(responce);
			}
		})
	});



	function usl(type) {

		window.inp1 = v;
		var inp2 = $('.inp2').val();
		window.type = type;
		if (window.type == 2) {
			window.message = '';
		}

		if (type==1) {
			window.inp = inp1;
		} else if (type==2) {
			window.inp = inp2;
		}


		$.ajax({
			type: "POST",
			url: "action/ajax.php",
			data: { action: 'usl', inp: window.inp, type:type },
			cache: false,
			success: function(responce){window.usloviya = responce;  }
		});
	}
	function submit() {
		var direct = $('.dir1').val();




		var inp = document.getElementsByClassName("inp").value;
		var out = document.getElementById("result");

		//var id_type = $('input[name="type"]:checked').val();

		$.ajax({
			type: "POST",
			url: "action/ajax.php",
			data: { action: 'tarif', direct: direct, usloviya: usloviya },
			cache: false,
			success: function(responce){window.r = responce;res(responce);  insert(window.result) }
		});
		//percent();

	}


	$.ajax({
		type: "POST",
		url: "action/ajax.php",
		data: { action: 'min'},
		cache: false,
		success: function(responce){window.min = responce;}
	});
	function res(r) {
		//var inp = document.getElementsByClassName("inp").value;
		window.result = r * inp;
		if (flag != 2) {
			window.result = result + result * p;
		}

		//window.result = result;
		if (window.result < window.min ) {window.result = window.min;}
		window.RESULT = result;
		alert(RESULT)


	}

	function percent() {
		var max = Math.max(x,y,z) / 100;


		$.ajax({
			type: "POST",
			url: "action/ajax.php",
			data: { action: 'percent', v: window.v , max:max },
			cache: false,
			success: function(responce){window.p = (Math.round(responce * 100) / 100);  }
		});
		setInterval(q,1000);
		function q() {
			if (p != 0 ) {
				window.message = '<br><p style="color:red">Один из параметров превышает установленные. Цена увеличина на '+p * 100+' %!!!</p> '
			} else { window.message = '';}
		}


	}
	function insert(value) { //Вставляет value в #result
		document.getElementById("result").innerHTML =  value + message;


	}
	function s(type) {
		vol();
		setTimeout(usl(type),1000);percent();submit();res();
		alert(window.result);


	}

	function S() {
		setTimeout(s(1),1000);
		var a = result;
		alert(result);
		setTimeout(s(2),5000);
		var b = result;
		alert(a);
		alert(b);
	}

</script>
<button onclick="S()">123</button>
</body>
</html>



