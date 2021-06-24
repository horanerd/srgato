
<?php include REQUIRE_PATH ."/inc/menu.inc.php";?>
    <!-- Titulo -->
    <div class="container">
        <div class="row justify-content-md-center mt-3">  
            <h1>CLIENTES CADASTRADOS</h1>
        </div>

        <table class="table table-bordered table-dark mt-3 text-center">
        <thead>
          <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Nome</th>
            <th scope="col">Sobrenome</th>
            <th scope="col">CPF</th>
            <th scope="col">Cidade</th>
            <th scope="col">CEP</th>
            <th scope="col">Estado</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Idade</th>
            <th scope="col">Usuario</th>
            <th scope="col">Ação</th>
            
        </tr>
        </thead>
    
    <?php $usuario = new Read(); 

      $usuario->ExeRead("clientes");
      
      foreach($usuario->getResult() as $user):

    ?>

        <tbody>
          <tr>
            <th scope="row"><?= $user["id"]?></th>
            <td><?= $user["nome"]?></td>
            <td><?= $user["sobrenome"]?></td>
            <td><?= $user["cpf"]?></td>
            <td><?= $user["cidade"]?></td>
            <td><?= $user["cep"]?></td>
            <td><?= $user["estado"]?></td>
            <td><?= $user["data_nascimento"]?></td>
            <td><?= $user["idade"]?></td>
            <td><?= $user["usuario"]?></td>
            <th scope="col"><button class="btn btn-danger"> Deletar </button></th>
            
          </tr>
 
        </tbody>

      <?php endforeach ?>
      </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 