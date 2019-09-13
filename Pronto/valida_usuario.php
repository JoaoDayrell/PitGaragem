<?php 

session_start();
ob_start();
include_once("conexao.php");

//Receber os dados do formulário
$name = $_POST["nome"];
$data =  $_POST["data"];
$cpf =  $_POST["cpf"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$cripto = md5($senha);

//Salvar os dados no bd
$result_markers = "INSERT INTO cliente(Nome, Nascimento, CPF, Email, Senha) 
				VALUES (
				'$name', '$data','$cpf','$email','$cripto')";

$resultado_markers = mysqli_query($conn, $result_markers);
if(mysqli_insert_id($conn)){
	header("Location: login.php");
}else{
	header("Location: cadastrar_pessoa.php");	
}







?>