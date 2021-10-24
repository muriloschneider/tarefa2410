<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Listas";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";
   $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
   $id = isset($_POST["id"]) ? $_POST["id"] : "";
   $cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : "";
   $pontos = isset($_POST["pontos"]) ? $_POST["pontos"] : "";
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
                <input type="radio" name="procura" id="pro1" value="pro1"/>Nome
                <input type="radio" name="procura" id="pro2" value="pro2"/> Id
                <input type="radio" name="procura" id="pro3" value="pro3"/>cidade
                <input type="radio" name="procura" id="pro4" value="pro4"/>pontos
            </p>
            
    <fieldset>
        <legend>Procurar time</legend>
        <input type="text"   name="procurar" id="procurar"  value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table>
	    <tr><td><b>id  </b></td>
        <td><b>nome </b></td>
        <td><b> pontos  </b></td>
        <td><b> cidade </b></td>
        </tr>
<?php
    $pdo = Conexao::getInstance(); 
    
    if($procura==""){
        $consulta = $pdo->query("SELECT * FROM  time 
                                 WHERE nome LIKE '$procurar%' 
                                 ORDER BY nome");
}

else if($procura=="pro1"){
    $consulta = $pdo->query("SELECT * FROM time 
                             WHERE nome LIKE '$procurar%' 
                             ORDER BY nome");
}

else if($procura=="pro2"){
    $consulta = $pdo->query("SELECT * FROM time 
                             WHERE id = '$procurar%' 
                             ORDER BY id");
}

else if($procura=="pro3"){
    $consulta = $pdo->query("SELECT * FROM time 
                             WHERE cidade <= '$procurar%' 
                             ORDER BY cidade");
}
else if($procura=="pro4"){
    $consulta = $pdo->query("SELECT * FROM time 
                             WHERE pontos <= '$procurar%' 
                             ORDER BY pontos");
}


?>
<?php while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
	    <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo $linha['pontos'];?></td>
            <td><?php echo $linha['cidade'];?></td>
</tr>



<?php } ?>
        
                 
        </table>
    </fieldset>
    </form>
</body>
</html>