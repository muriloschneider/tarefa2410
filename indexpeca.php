<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Listas";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";
   $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
   $id = isset($_POST["id"]) ? $_POST["id"] : "";
   $valor = isset($_POST["valor"]) ? $_POST["valor"] : "";
   $fornecedor = isset($_POST["fornecedor"]) ? $_POST["fornecedor"] : "";
?>

<html>
<head>
<link rel="stylesheet" href="conf../teste.css">

    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>


</head>
<body>
<?php include "menuprova1.php"; ?>
    <form method="post">

    <p>
                <input type="radio" name="procura" id="pro1" value="pro1"/>descricao
                <input type="radio" name="procura" id="pro2" value="pro2"/> Id
                <input type="radio" name="procura" id="pro3" value="pro3"/>valor
                <input type="radio" name="procura" id="pro4" value="pro4"/>fornecedor
            </p>
            
    <fieldset>
        <legend>Procurar peças</legend>
        <input type="text"   name="procurar" id="procurar"  value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table>
	    <tr><td><b>id  </b></td>
        <td><b>descricao </b></td>
        <td><b> fornecedor  </b></td>
        <td><b> valor </b></td>
        </tr>
<?php
    $pdo = Conexao::getInstance(); 
    
    if($procura==""){
        $consulta = $pdo->query("SELECT * FROM  peca 
                                 WHERE descricao LIKE '$procurar%' 
                                 ORDER BY descricao");
}

else if($procura=="pro1"){
    $consulta = $pdo->query("SELECT * FROM peca 
                             WHERE descricao LIKE '$procurar%' 
                             ORDER BY descricao");
}

else if($procura=="pro2"){
    $consulta = $pdo->query("SELECT * FROM peca 
                             WHERE id = '$procurar%' 
                             ORDER BY id");
}

else if($procura=="pro3"){
    $consulta = $pdo->query("SELECT * FROM peca 
                             WHERE valor <= '$procurar%' 
                             ORDER BY valor");
}
else if($procura=="pro4"){
    $consulta = $pdo->query("SELECT * FROM peca 
                             WHERE fornecedor LIKE '$procurar%' 
                             ORDER BY fornecedor");
}


?>
<?php while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
	    <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['descricao'];?></td>
            <td><?php echo $linha['fornecedor'];?></td>
            <td><?php echo $linha['valor'];?></td>
</tr>



<?php } ?>
        
                 
        </table>
    </fieldset>
    </form>
</body>
</html>