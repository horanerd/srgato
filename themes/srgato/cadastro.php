   <?php

    include REQUIRE_PATH . "/inc/menu.inc.php";

    ?>

   <!-- TITULO -->
   <div class="container">
     <div class="row justify-content-md-center mt-3">
       <h1>CADASTRO DE CLIENTES</h1>
     </div>
     <form enctype="multipart/form-data" method="post">
       <div class="form-row mt-3">
         <div class="col-md-4 mb-3">
           <label for="nome">Nome</label>
           <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
         </div>
         <div class="col-md-4 mb-3">
           <label for="Sobrenome">Sobrenome</label>
           <input type="text" class="form-control" id="Sobrenome" placeholder="Sobrenome" name="sobrenome" required>
         </div>
         <div class="col-md-3 mb-3">
           <label for="CPF">CPF</label>
           <input type="text" class="form-control" id="validationDefault05" placeholder="CPF" name="cpf" required>
         </div>
       </div>
       <div class="form-row mt-3">
         <div class="col-md-4 mb-3">
           <label for="validationDefault03">Cidade</label>
           <input type="text" class="form-control" id="validationDefault03" placeholder="Cidade" name="cidade" required>
         </div>
         <div class="col-md-3 mb-3">
           <label for="validationDefault05">CEP</label>
           <input type="text" class="form-control" id="validationDefault05" placeholder="CEP" name="cep" required>
         </div>
         <div class="col-md-3 mb-3">
           <label for="validationDefault04">Estado</label>
           <select class="form-control" id="exampleFormControlSelect1" placeholder="UF" name="estado" required>
             <option>AC</option>
             <option>AL</option>
             <option>AP</option>
             <option>AM</option>
             <option>BA</option>
             <option>CE</option>
             <option>DF</option>
             <option>ES</option>
             <option>GO</option>
             <option>MA</option>
             <option>MT</option>
             <option>MS</option>
             <option>MG</option>
             <option>PA</option>
             <option>PB</option>
             <option>PR</option>
             <option>PE</option>
             <option>PI</option>
             <option>RJ</option>
             <option>RN</option>
             <option>RS</option>
             <option>RO</option>
             <option>RR</option>
             <option>SC</option>
             <option>SP</option>
             <option>SE</option>
             <option>TO</option>
           </select>
         </div>
       </div>
       <div class="form-row mt-3">
         <div class="col-md-3 mb-3">
           <label for="validationDefaultUsername">Usuário</label>
           <div class="input-group">
             <div class="input-group-prepend">
               <span class="input-group-text" id="inputGroupPrepend2">@</span>
             </div>
             <input type="text" class="form-control" id="validationDefaultUsername" name="usuario" placeholder="Usuário" aria-describedby="inputGroupPrepend2" required>
           </div>
         </div>
         <div class="col-md-3 mb-3">
           <label for="validationDefault04">Data de nascimento</label>
           <input type="date" class="form-control" name="datanascimento" id="validationDefault04" required>
         </div>
         <div class="col-md-3 mb-3">
           <label for="validationDefault04">Idade</label>
           <input type="text" class="form-control" id="validationDefault04" name="idade" placeholder="Anos" required>
         </div>
       </div>
       <button class="btn btn-dark" type="submit">Enviar</button>
     </form>
   </div>
   </div>

   <?php
    $dados = [
      "nome" => filter_input(INPUT_POST, "nome"),
      "sobrenome" => filter_input(INPUT_POST, "sobrenome"),
      "cpf" => filter_input(INPUT_POST, "cpf"),
      "cidade" => filter_input(INPUT_POST, "cidade"),
      "cep" => filter_input(INPUT_POST, "cep"),
      "estado" => filter_input(INPUT_POST, "estado"),
      "usuario" => filter_input(INPUT_POST, "usuario"),
      "data_nascimento" => filter_input(INPUT_POST, "datanascimento"),
      "idade" => filter_input(INPUT_POST, "idade")

    ];
    $incluir = new Create();
    $incluir->ExeCreate("clientes", $dados);

    //var_dump($dados)

    ?>