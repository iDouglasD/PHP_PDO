<?php

// ----------------- CONEXAO ---------------------

try {

    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost","root","");
    
} catch ( PDOException $e ) {
    echo "Erro com banco de dados: ".$e->getMessage();
    
}
catch(Exception $e ) {
    echo "Erro generico: ".$e->getMessage();
}


// ----------------- INSERT ---------------------

// 1 Forma:
$res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES (:n, :t, :e)");

$res->bindValue(":n","Douglas");
$res->bindValue(":t","00000000");
$res->bindValue(":e","dd@gmail.com");
$res-> execute();

$res->bindParam(':n', $nome, ":t");

// 2 Forma:
$pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES ('Douglas', '00000', 'dd@gmail.com')");


// ----------------- DELETE AND UPDATE ---------------------

$cmd = $pdo->prepare("DELETE FROM pessoa WHERE id=:id");
$id = 2;
$cmd->bindValue(":id", $id);
$cmd->execute();
// ou
$res = $pdo->query("DELETE FROM pessoa WHERE id='3'");

$cmd = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id=:id");
$cmd->bindValue(":e", "duarte@gmail.com");
$cmd->bindValue(":id", 1);
$cmd->execute();
// ou
$res = $pdo->query("UPDATE pessoa SET email = 'douglas@gmai.com' WHERE id= '4'");

// ----------------- SELECT ---------------------

$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id= :id");
$cmd->bindValue(":id",4);
$cmd->execute();

$resultado = $cmd->fetch(PDO:: FETCH_ASSOC);
// ou
$cmd->fetchAll();

foreach($resultado as $key => $value){
    echo $key.": " .$value. "<br>";
}
?>
