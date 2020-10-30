<?php
    require './conn.php';

    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

    
    
    if($post['cadastro'] == 1){

        if(!empty($post['nome'])){

            $nome = $post['nome'];
            $cpf = $post['cpf'];
            $sql = "INSERT INTO `cadastro` (`id`, `nome`, `cpf`) VALUES (NULL, '$nome', '$cpf');";
            
            $db->query($sql);
        }

    }


   


    if($get['edit'] == 1){
        $id = $get['id'];
        $select_edit = $db->query("SELECT * FROM cadastro WHERE id = '$id'");
        $list = $select_edit->fetch_assoc();

    }

    if($post['edit'] == 1) {

        $id = $post['id'];
        $nome = $post['nome'];
        $cpf = $post['cpf'];


        $sql_update = " UPDATE cadastro SET nome = '$nome', cpf = '$cpf' WHERE id = '$id' ";

        $db->query($sql_update);

    }


    if($get['dell'] == 1){
        $id = $get['id'];

        $sql_dell = "DELETE FROM cadastro WHERE  id = '$id'";

        $db->query($sql_dell);
    }

     $select = $db->query("SELECT * FROM cadastro");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto BD</title>
</head>
<body>
    <h1>CRUD - Dono</h1>

    <form action="" method="post">

        <?php if($get['edit'] == 1){ ?>
        
        <input type="hidden" name="edit" id="edit" value="1">
        <input type="hidden" name="id" id="id" value="<?= $list['id'] ?>">

        <?php }else { ?>

        <input type="hidden" name="cadastro" id="cadastro" value="1">

        <?php } ?>
        <label for="nome">Nome</label><br>
        <input type="text" name="nome" id="nome" value="<?= $list['nome'] ?>">
        <br>
        <label for="cpf">CPF</label><br>
        <input type="text" name="cpf" id="cpf" value="<?= $list['cpf'] ?>">
        <br>
        <br>
        <input type="submit" value="Cadastrar | Atualizar">
    </form>
    <br>
    <br>
    <hr>
    <table border='1' width="50%">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Ações</th>
        </tr>
        <?php 
            while($linhas = $select->fetch_assoc()){
        ?>
        <tr>
            <td><?= $linhas['id'] ?></td>
            <td><?= $linhas['nome'] ?></td>
            <td><?= $linhas['cpf'] ?></td>
            <td>
            <center>
                <a href="index.php?edit=1&id=<?= $linhas['id'] ?>">Editar</a>
                <a href="index.php?dell=1&id=<?= $linhas['id'] ?>">Apagar</a>
                </center>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>