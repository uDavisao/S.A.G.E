<?php

session_start();

include("../conexao.php");

$email = $_POST["email"] ?? '';
$senha = $_POST["password"] ?? '';

if(empty($email) || empty($senha)){
    header("Location: ../login.php?erro=1");
    exit;
}

$senhaCriptografada = md5($senha);

$sql = "SELECT * FROM usuarios 
        WHERE email = ? 
        AND senha = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $email, $senhaCriptografada);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $usuario = $result->fetch_assoc();

    $_SESSION["usuario_id"] = $usuario["id"];
    $_SESSION["usuario_nome"] = $usuario["nome"];
    $_SESSION["usuario_email"] = $usuario["email"];

    header("Location: ../index.php");
    exit;

}else{

    header("Location: ../login.php?erro=2");
    exit;
}
?>