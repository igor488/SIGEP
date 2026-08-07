<?php

session_start();

include("config/conexao.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $sql = $pdo->prepare("
    SELECT *
    FROM usuarios
    WHERE email = ?
    AND ativo = 1
    ");

    $sql->execute([$email]);

    if($sql->rowCount() == 1){

        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        if(password_verify($senha,$usuario['senha'])){

            $_SESSION['usuario'] = $usuario['nome'];
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nivel'] = $usuario['nivel'];

            header("Location:index.php");
            exit;

        }

    }

    $erro = "E-mail ou senha inválidos.";

}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Login SIGEP</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-4">

<div class="card">

<div class="card-header">

<h3>Login SIGEP</h3>

</div>

<div class="card-body">

<?php if(isset($erro)){ ?>

<div class="alert alert-danger">

<?= $erro ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>E-mail</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Senha</label>

<input
type="password"
name="senha"
class="form-control"
required>

</div>

<button class="btn btn-primary w-100">

Entrar

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>