<?php 
require_once './classes/Usuarios.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $usuario = new Usuarios();
        
        if(isset($_POST['cadastrar'])):
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            
            $usuario->setNome($nome);
            $usuario->setEmail($email);            
            if($usuario->insert()){
                echo 'Inserido com sucesso!';
            }
            
            
        endif;               
        ?>
          <?php      
           if(isset($_POST['atualizar'])):
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            
            
            $usuario->setNome($nome);
            $usuario->setEmail($email);            
            if($usuario->update($id)){
                echo 'Atualizado com sucesso!';
            }
            
            
        endif;               
        ?>
        
        <?php 
        if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
            $id = (int)$_GET['id'];
            if($usuario->delete($id)){
                echo "Deletado com Sucesso!";
            }
        endif;
        ?>
    
        <?php
            if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
            $id = (int)$_GET['id'];
            $stmt = $usuario->find($id);
        ?>
         <form method="POST" name="frmCadastrar">
            Nome:<input type="text" name="nome" value="<?php echo $stmt->nome;?>" /> <br/><br/>
            E-mail:<input type="text" name="email" value="<?php echo $stmt->email;?>" /> <br/><br/>
            <br/><br/>
            <input type="submit" name="atualizar" value="Atualizar dados" />
            <input type="hidden" name="id" value="<?php echo $stmt->id; ?>"/>
                
        </form>
        
        <?php
            }else{
        ?>
        
    <center>
        <br/>
        <form method="POST" name="frmCadastrar">
            Nome:<input type="text" name="nome" value="" /> <br/><br/>
            E-mail:<input type="text" name="email" value="" /> <br/><br/>
            <br/><br/>
            <input type="submit" name="cadastrar" value="Cadastrar" />
        </form>
        
            <?php } ?>
        <br/><br/><br/><br/>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <?php foreach ($usuario->findAll() as $key => $value): ?>
            <tbody>               
                <tr>
                    <td><?php echo $value->id; ?></td>
                    <td><?php echo $value->nome; ?></td>
                    <td><?php echo $value->email; ?></td>
                    <td>
                        <?php echo "<a href='index.php?acao=editar&id=" . $value->id . "'>Editar</a>"; ?>
                        <?php echo "<a href='index.php?acao=deletar&id=" . $value->id . "' onClick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
                    </td>
                </tr>
            </tbody>
            
            <?php endforeach; ?>
        </table>
</center>
        
      
    </body>
</html>
