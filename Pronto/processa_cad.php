<?php
session_start();
ob_start();
include_once("conexao.php");

//Receber os dados do formulário
$name = $_POST["nome"];
$address =  $_POST["endereco"];
$lat =  $_POST["lat"];
$lgn = $_POST["lng"];
$type = $_POST["type"];
$disponibilidade = $_POST["disponibilidade"];



//Salvar os dados no bd
$result_markers = "INSERT INTO markers(name, address, lat, lng, type, disponibilidade) 
				VALUES (
				'$name', '$address','$lat','$lgn','$type', '$disponibilidade')";

$resultado_markers = mysqli_query($conn, $result_markers);
if(mysqli_insert_id($conn)){
	$_SESSION['msg'] = "<span style='color: green';>Endereço cadastrado com sucesso!</span>";
	header("Location: cadastrar.php");
}else{
	$_SESSION['msg'] = "<span style='color: red';>Erro: Endereço não foi cadastrado.</span>";
	header("Location: cadastrar.php");	
}
?>
