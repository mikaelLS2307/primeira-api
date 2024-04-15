<?php

include "Clientes.php";

header("Content-Type: application/json");
$data = [];

$fn = $_REQUEST["fn"]?? null;
$id = $_REQUEST["id"]?? 0;
$name = $_REQUEST["name"]?? null;
$cpf = $_REQUEST["cpf"]?? null;
$email = $_REQUEST["email"]?? null;
$end = $_REQUEST["end"]?? null;
$tel = $_REQUEST["tel"]?? null;

$clientes = new Clientes;
$clientes->setId($id);


if ($fn === "create" && $name !== null && $cpf !== null && $email !== null && $end !== null && $tel !== null){
    $clientes->setName($name);
    $clientes->setcpf($cpf);
    $clientes->setemail($email);
    $clientes->setend($end);
    $clientes->settel($tel);

    $data["clientes"] = $clientes->create();
}

if ($fn === "read"){

    $data["clientes"] = $clientes->read();
}

if ($fn === "update" && $id > 0 && $name !== null && $cpf !== null && $email !== null && $end !== null && $tel !== null){
    $clientes->setName($name);
    $clientes->setcpf($cpf);
    $clientes->setemail($email);
    $clientes->setend($end);
    $clientes->settel($tel);

    $data["clientes"] = $clientes->update();
}

if ($fn === "delete" && $id > 0){

    $data["clientes"] = $clientes->delete();
}




die(json_encode($data));