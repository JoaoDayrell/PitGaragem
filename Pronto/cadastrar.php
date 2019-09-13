
<?php
session_start();
include_once("conexao.php");
?>
<!DOCTYPE html>
<meta charset="UTF-8">
  <head>
  	<?php include 'inc/header.php'; ?>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<style>

			input[type=button], input[type=submit], input[type=reset] {
  			background-color: #4CAF50;
  			border: none;
  			color: white;
  			padding: 16px 32px;
  			text-decoration: none;
  			margin: 4px 2px;
  			cursor: pointer;
  			border-radius: 12px;
			}

			input[type=text]{

			}

			a{
				background-color: #fff000;
  			border: none;
  			color: black;
  			padding: 16px 32px;
  			text-decoration: none;
  			margin: 4px 2px;
  			cursor: pointer;
  			border-radius: 12px;
			}


			button{
				border-radius: 12px;
			}

			label{
				font-family: Poppins-Regular;
			}

			textarea{
				overflow: auto;
				resize: none;

			}

			input {color:black;
			outline: none;
  			border: none;
  			}

			label {color:white;

			}





		</style>

		<title>PITstop</title>
	</head>
	<body>
		<a href="index.php">PITstop</a><br><br>
		<?php
		
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		
?>
<br><br><br><br><br>
		<form method="POST" action="processa_cad.php">
			<label>Nome: </label>
			<input class="form-control" type="text" name="nome" placeholder="Nome da empresa"><br><br>

			<label>Endereço: </label>
			<textarea class="form-control" name="endereco"  cols=40 rows=2><?php echo $_SESSION['endereco']; ?></textarea><br><br>
			
			<label>Latitude: </label><br><br>
			<textarea class="form-control" name="lat" ><?php echo $_SESSION['latitude']; ?></textarea><br><br>

			
			<label>Longitude: </label><br><br>
			<textarea class="form-control" name="lng" ><?php echo $_SESSION['longitude']; ?></textarea><br><br>				
			
			<label>Tipo da Empresa: </label>
			<input class="form-control" type="text" name="type" placeholder="Educação, Restaurante..."><br><br>

			<label>Disponibilidade: </label>
			<select name = "disponibilidade" class="form-control" size="1px">
			<option>Selecione:</option>
			<option>Disponível</option>
			<option>Indisponível</option>
			</select><br>

				





<input type="submit" value="Cadastrar">
<br>
<br>
	</form>
	<a href="http://localhost/PITstop/PITstop/Pronto/mapa.php"><button>Visualisar</button></a><br><br>
	</body>
	<?php include 'inc/footer.php'; ?>
</html>