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
	<select class="dir" > </select><br>
	<h1>ОБЬЕМ</h1>
	<table>
		<tr>
			<th>x</th>
			<th>y</th>
			<th>z</th>
		</tr>

		<tr>
			<td><input type="number" class="x"></td>
			<td><input type="number" class="y"></td>
			<td><input type="number" class="z"></td>
			<td><input type="submit" value="Рассчитать" onclick="submit()"></td>
			<td></td>
		</tr>

	</table>


	<br>
    <button onclick="$('.y').val('');$('.z').val('');$('.inp2').val('');$('.x').val(''); ">Очистить</button>
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



			<td><input type="number" class="inp2"></td>


		</tr>

	</table>


	<br>
	<p> Результат: </p>
	<div id="result"></div>
</div>
<script>
	var DB = {
		getTarif: function(direct, usloviya) { //0 - договорная цена
			$.ajax({
				type: "POST",
				url: "action/ajax.php",
				data: { action: 'tarif', direct: direct, usloviya: usloviya },
				async: false ,
				cache: false,
				success: function(responce){DB.tarif = responce; }
			});
		},

		getUsloviya: function(vol, type,direct) {
			$.ajax({
				type: "POST",
				url: "action/ajax.php",
				async: false ,
				data: { action: 'usl', inp: vol, type:type, direct:direct },
				cache: false,
				success: function(responce){DB.usloviya = responce; }
			});

		},

		getMinValue: function(direct) {



			$.ajax({
				type: "POST",
				url: "action/ajax.php",
				async: false ,
				data: { action: 'min', direct:direct},
				cache: false,
				success: function(responce){DB.min = responce}
			});

		},

		getFirstList: function() {
				$.ajax({
					url: "connect.php",
					cache: false,
					success: function (responce) {$('.dir').html(responce);}
				});
			},

		getPercent: function (v,max) {
			$.ajax({
				type: "POST",
				url: "action/ajax.php",
				async: false ,
				data: { action: 'percent', v: v , max:max },
				cache: false,
				success: function(responce){DB.percent = (Math.round(responce * 100) / 100);  }
			});
		}
	};





	DB.getMinValue();
	DB.getFirstList();


	function getMass() {
		return $('.inp2').val();

	}

	function submitMass() {
		window.m= s(2, getMass());
	}

	function submitVol() {
		window.v = s(1, getVol());
	}

	var flag;
	function submit() {
		submitVol();
		submitMass();
		insertMax();
		window.f = false;
	}
	function s(type, val) {

			window.flag = false;
			var direct = getDirect();
			DB.getUsloviya(val, type, direct);
			DB.getTarif(direct, DB.usloviya);
			DB.getMinValue(direct);
			if (DB.tarif == 0) {
				window.flag = true;
				window.f = true;
				insert('', 'Цена договорная');
				return;
			}
			var result = calculation(type, val, DB.tarif);
			//insert(result);
			return result;

		//setMessage(percent);
	}

    function clear() {
        $('.x').val('');
        document.getElementsByClassName('y').value = '';
        $('.y').val('');
        $('.z').val('');
        $('.inp2').val('');
    }

	function insertMax() {
		if (!window.flag) {


			if (v > m) {
				insert(v, message);

			} else {
				insert(m);
			}
		} else {insert('','Цена договорная')}
	}

	function calculation(flag, val, tarif) {
		var percen = percent();
        window.message = setMessage(percen);
		var result = tarif * val;
		if (flag != 2) {
			result = result + result * percen;
		}
		//if (!window.flag) {

			if (result < DB.min) {
				result = DB.min;
			}
		//}
		return result;

	}

	function percent() {
		var max = maxVol();
        DB.getPercent(getVol(), max);
        return DB.percent;
	}

	function setMessage(percent) {
		if (percent != 0 ) {
			return '<br><p style="color:red">Один из параметров превышает установленные. Цена увеличина на '+ percent * 100+' %!!!</p> '
		} else { return '';}
	}

	function insert(value,message) { //Вставляет value в #result
        message = message || '';
		if (window.flag || value == 0 || window.f){document.getElementById("result").innerHTML =  'Цена договорная' ;} else {
			document.getElementById("result").innerHTML = value + message;
		}

	}
	function maxVol() {
		var x = $('.x').val();
		var y = $('.y').val();
		var z = $('.z').val();
		return (Math.max(x,y,z) / 100);
	}
	function getVol() {
		var x = $('.x').val();
		var y = $('.y').val();
		var z = $('.z').val();
		return  x * y * z / 1000000; //считает обьем
	}

	function getDirect() {
		return $('.dir').val();
	}

</script>
</body>
</html>



