<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Listas";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";
   $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
   $id = isset($_POST["id"]) ? $_POST["id"] : "";
   $peso = isset($_POST["peso"]) ? $_POST["peso"] : "";
   $altura = isset($_POST["altura"]) ? $_POST["altura"] : "";
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
                <input type="radio" name="procura" id="pro3" value="pro3"/>peso
                <input type="radio" name="procura" id="pro4" value="pro4"/>altura
            </p>
            
    <fieldset>
        <legend>Procurar vendedor</legend>
        <input type="text"   name="procurar" id="procurar"  value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table>
	    <tr><td><b>id  </b></td>
        <td><b>nome </b></td>
        <td><b> altura  </b></td>
        <td><b> peso </b></td>
        </tr>
<?php
    $pdo = Conexao::getInstance(); 
    
    if($procura==""){
        $consulta = $pdo->query("SELECT * FROM atleta 
                                 WHERE nome LIKE '$procurar%' 
                                 ORDER BY nome");
}

else if($procura=="pro1"){
    $consulta = $pdo->query("SELECT * FROM atleta 
                             WHERE nome LIKE '$procurar%' 
                             ORDER BY nome");
}

else if($procura=="pro2"){
    $consulta = $pdo->query("SELECT * FROM atleta 
                             WHERE id = '$procurar%' 
                             ORDER BY id");
}

else if($procura=="pro3"){
    $consulta = $pdo->query("SELECT * FROM atleta 
                             WHERE peso <= '$procurar%' 
                             ORDER BY peso");
}
else if($procura=="pro4"){
    $consulta = $pdo->query("SELECT * FROM atleta 
                             WHERE altura <= '$procurar%' 
                             ORDER BY altura");
}


?>
<?php while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
	    <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo number_format( $linha['altura'], 1, ".", ",");?></td>
            <td><?php echo number_format( $linha['peso'], 1, ".", ",");?></td>
</tr>



<?php } ?>
        
                 
        </table>
    </fieldset>
    </form>
</body>
</html>