<?php


define( 'PG_HOST', 'localhost' );
define( 'PG_DBNAME', 'estoque' );
define( 'PG_PORT', '5432' );
define( 'PG_USER', 'postgres' );
define( 'PG_PASSWORD', 'admin10' );

class Crud_Pessoa extends PDO
{
    public function __construct(){

    }
    private function conexao(){
        try{
            $PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
            $PDO->exec("set names utf8");
            return $PDO;
        }
        catch ( PDOException $e ){
            echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
        }
    }

    //PESSOA
    function servidor_select_all(){
        $bd = Crud_Pessoa::conexao();
        $sql = "SELECT * FROM pessoa";
        $result = $bd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    function servidor_select($id){
        $this->id = $id;
        $bd = Crud_Pessoa::conexao();
        $sql = "SELECT * FROM pessoa where id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
        $result = $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function servidor_select_ultimo(){
        $bd = Crud_Pessoa::conexao();
        $sql = "SELECT id FROM pessoa ORDER BY id DESC LIMIT 1";
        $stmt = $bd->prepare( $sql );
        $result = $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function servidor_select_table(){
        //$this->id = $id;
        $bd = Crud_Pessoa::conexao();
        $sql = "SELECT p.id, p.nome, p.telefone, p.cpf, p.email, p.tipopessoa, p.idsetor, p.login, p.senha, s.nome as nomesetor
        FROM pessoa p
        INNER JOIN setor s on p.idsetor = s.id
        WHERE tipopessoa != 3 order by id desc"; 
        $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function select_servidor_combo(){
        $bd = Crud_Pessoa::conexao();
        $sql = "SELECT * FROM pessoa order by nome";
        $stmt = $bd->prepare( $sql );
        $result = $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
       //USUÁRIO E SERVIDOR
    function servidor_insert($nome,$telefone,$cpf,$email,$login,$senha,$tipopessoa,$idsetor){
        try{
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->cpf = $cpf;
            $this->email = $email;
            $this->login = $login;
            $this->senha = $senha;
            $this->tipopessoa = $tipopessoa;
            $this->idsetor = $idsetor;
            
            $bd = Crud_Pessoa::conexao();
            $sql = "INSERT INTO pessoa(nome, telefone, cpf, email, login, senha, tipopessoa,idsetor) VALUES (:nome,:telefone,:cpf,:email,:login,:senha,:tipopessoa,:idsetor)";
            $stmt = $bd->prepare( $sql );
            $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
            $stmt->bindParam(':telefone',$this->telefone,PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
            $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
            $stmt->bindParam(':login', $this->login, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $stmt->bindParam(':tipopessoa', $this->tipopessoa, PDO::PARAM_INT);
            $stmt->bindParam(':idsetor', $this->idsetor, PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result == TRUE)
            {
             $url='../listar_servidores.php?cad';
             echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
             exit();
         }

     }
     catch ( PDOException $e ){
        echo 'Erro ao inserir: ' . $e->getMessage();
    }    
}
function servidor_update($id,$nome,$telefone,$cpf,$email,$login,$senha,$tipopessoa,$idsetor){
    try{
        $this->id = $id;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->login = $login;
        $this->senha = $senha;
        $this->tipopessoa = $tipopessoa;
        $this->idsetor = $idsetor;
        $bd = Crud_Pessoa::conexao();
        $sql = "UPDATE pessoa set nome = :nome, telefone = :telefone, cpf = :cpf, email = :email, login = :login, senha = :senha, tipopessoa = :tipopessoa, idsetor = :idsetor WHERE id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':telefone',$this->telefone,PDO::PARAM_STR);
        $stmt->bindParam(':cpf',$this->cpf,PDO::PARAM_STR);
        $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $stmt->bindParam(':login',$this->login,PDO::PARAM_STR);
        $stmt->bindParam(':senha',$this->senha,PDO::PARAM_STR);
        $stmt->bindParam(':tipopessoa', $this->tipopessoa, PDO::PARAM_INT);
        $stmt->bindParam(':idsetor', $this->idsetor,PDO::PARAM_INT);

        $result = $stmt->execute();
        if($result == TRUE)
        {
            $url='../listar_servidores.php?alt';
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        } 
    }          

    catch ( PDOException $e ){
        echo 'Erro ao alterar: ' . $e->getMessage();
    }   
}

function servidor_delete($id){
    $bd = Crud_Pessoa::conexao();

    $sql = "DELETE FROM pessoa WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);

    $result = $stmt->execute();
    if($result == TRUE){

        $url='../listar_servidores.php?excluir';

        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}  

//Empresa
function empresa_insert($razaosocial,$nomefantasia,$telefone,$cnpj,$email){

    try{
     $this->razaosocial = $razaosocial;
     $this->nomefantasia = $nomefantasia;
     $this->telefone = $telefone;
     $this->cnpj = $cnpj;
     $this->email = $email;
           $tipopessoa = 3; //empresa 3

           $bd = Crud_Pessoa::conexao();
           $sql = "INSERT INTO pessoa(razaosocial, nomefantasia, telefone, cnpj, email, tipopessoa) VALUES (:razaosocial,:nomefantasia,:telefone,:cnpj,:email,$tipopessoa)";
           $stmt = $bd->prepare( $sql );
           $stmt->bindParam(':razaosocial',$this->razaosocial,PDO::PARAM_STR);
           $stmt->bindParam(':nomefantasia',$this->nomefantasia,PDO::PARAM_STR);
           $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
           $stmt->bindParam(':cnpj',$this->cnpj,PDO::PARAM_STR);
           $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);

           $result = $stmt->execute();
           if($result == TRUE)
           {
            $url='../listar_empresas.php?cad';
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        }

    }
    catch ( PDOException $e ){
        echo 'Erro ao inserir: ' . $e->getMessage();
    }    
}
function empresa_update($id,$razaosocial,$nomefantasia,$telefone,$cnpj,$email){
    try{
        $this->id = $id;
        $this->razaosocial = $razaosocial;
        $this->nomefantasia = $nomefantasia;
        $this->telefone = $telefone;
        $this->cnpj = $cnpj;
        $this->email = $email;

        $bd = Crud_Pessoa::conexao();
        $sql = "UPDATE pessoa set razaosocial = :razaosocial, nomefantasia = :nomefantasia, telefone = :telefone, cnpj = :cnpj, email = :email WHERE id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $stmt->bindParam(':razaosocial',$this->razaosocial,PDO::PARAM_STR);
        $stmt->bindParam(':nomefantasia',$this->nomefantasia,PDO::PARAM_STR);
        $stmt->bindParam(':telefone',$this->telefone,PDO::PARAM_STR);
        $stmt->bindParam(':cnpj',$this->cnpj,PDO::PARAM_STR);
        $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);

        $result = $stmt->execute();
        if($result == TRUE)
        {
            $url='../listar_empresas.php?alt';
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        } 
    }          

    catch ( PDOException $e ){
        echo 'Erro ao alterar: ' . $e->getMessage();
    }   
}

function empresa_delete($id){
    $bd = Crud_Pessoa::conexao();
    $sql = "DELETE FROM pessoa WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result == TRUE)
    {
        $url='../listar_empresas.php?excluir';
        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}

function empresa_select_table(){
        //$this->id = $id;
    $bd = Crud_Pessoa::conexao();
    $sql = "SELECT * FROM pessoa where tipopessoa = 3 order by id desc"; 
    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function empresa_select_ultimo(){
    $bd = Crud_Pessoa::conexao();
    $sql = "SELECT id FROM pessoa WHERE tipopessoa = 3 ORDER BY id DESC LIMIT 1";
    $stmt = $bd->prepare( $sql );
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}


class Crud_Produto extends PDO{
    public function __construct(){

    }
    private function conexao(){
        try{
            $PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
            $PDO->exec("set names utf8");
            return $PDO;
        }
        catch ( PDOException $e ){
            echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
        }
    }

    function produto_insert($nome,$descricao,$estoqueminimo,$idunidademedida,$idtipoproduto){
        try{
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->estoqueminimo = $estoqueminimo;
            $this->idunidademedida = $idunidademedida;
            $this->idtipoproduto = $idtipoproduto;
            

            $bd = Crud_Produto::conexao();
            $sql = "INSERT INTO produto(nome, descricao, estoqueminimo,idunidademedida,idtipoproduto) VALUES (:nome,:descricao,:estoqueminimo,:idunidademedida,:idtipoproduto)";
            $stmt = $bd->prepare( $sql );
            $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
            $stmt->bindParam(':descricao',$this->descricao,PDO::PARAM_STR);
            $stmt->bindParam(':estoqueminimo', $this->estoqueminimo, PDO::PARAM_INT);
            $stmt->bindParam(':idunidademedida', $this->idunidademedida, PDO::PARAM_INT);
            $stmt->bindParam(':idtipoproduto', $this->idtipoproduto, PDO::PARAM_INT);
            

            $result = $stmt->execute();
            if($result == TRUE)
            {
             $url='../listar_produtos.php?cad';
             echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
             exit();
         }

     }
     catch ( PDOException $e ){
        echo 'Erro ao inserir: ' . $e->getMessage();
    }    
}
function produto_update($id,$nome,$descricao,$estoqueminimo,$idunidademedida,$idtipoproduto){
    try{
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->idunidademedida = $idunidademedida;
        $this->idtipoproduto = $idtipoproduto;
        $this->estoqueminimo = $estoqueminimo;
        $bd = Crud_Produto::conexao();
        $sql = "UPDATE produto set nome = :nome, descricao = :descricao, idunidademedida = :idunidademedida, idtipoproduto = :idtipoproduto, estoqueminimo = :estoqueminimo WHERE id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':descricao',$this->descricao,PDO::PARAM_STR);
        $stmt->bindParam(':idunidademedida',$this->idunidademedida,PDO::PARAM_INT);
        $stmt->bindParam(':idtipoproduto',$this->idtipoproduto,PDO::PARAM_INT);
        $stmt->bindParam(':estoqueminimo',$this->estoqueminimo,PDO::PARAM_INT);

        $result = $stmt->execute();
        if($result == TRUE)
        {
            $url='../listar_produtos.php?alt';
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        } 
    }          

    catch ( PDOException $e ){
        echo 'Erro ao alterar: ' . $e->getMessage();
    }   
}

function produto_delete($id){
    $bd = Crud_Produto::conexao();

    $sql = "DELETE FROM produto WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);

    $result = $stmt->execute();
    if($result == TRUE){

        $url='../listar_produtos.php?excluir';

        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}  

function produto_select_table(){
        //$this->id = $id;
    $bd = Crud_Produto::conexao();
    $sql = " SELECT p.id, p.nome, p.descricao, p.idunidademedida, p.idtipoproduto, u.nome as nomeunidademedida, tp.nome as nometipoproduto FROM produto p
    inner join unidademedida u on p.idunidademedida = u.id
    inner join tipoproduto tp on p.idtipoproduto = tp.id
    order by id desc"; 

    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function produto_select_ultimo(){
    $bd = Crud_Produto::conexao();
    $sql = "SELECT id FROM produto ORDER BY id DESC LIMIT 1";
    $stmt = $bd->prepare( $sql );
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function produto_select($id){
    $this->id = $id;
    $bd = Crud_Produto::conexao();
    $sql = "SELECT * from produto where id = :id";

    $stmt = $bd->prepare( $sql );
    $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function select_produto_combo(){
    $bd = Crud_Produto::conexao();
    $sql = "SELECT * FROM produto order by nome";
    $stmt = $bd->prepare( $sql );
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function produto_select_table_estoque_baixo($idtipoproduto){
    $this->idtipoproduto = $idtipoproduto;
    $bd = Crud_Produto::conexao();
    $sql = " SELECT p.id, p.nome, p.descricao, p.idunidademedida, p.idtipoproduto, u.nome as nomeunidademedida, tp.nome as nometipoproduto FROM produto p
    inner join unidademedida u on p.idunidademedida = u.id
    inner join tipoproduto tp on p.idtipoproduto = tp.id
    where p.idtipoproduto = :idtipoproduto 
    order by id desc"; 

    $stmt = $bd->prepare( $sql );
    $stmt->bindParam(':idtipoproduto',$this->idtipoproduto, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

class Crud_Entrada extends PDO{
    public function __construct(){

    }
    private function conexao(){
        try{
            $PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
            $PDO->exec("set names utf8");
            return $PDO;
        }
        catch ( PDOException $e ){
            echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
        }
    }


    function entrada_insert($nfe,$linksei,$data,$observacao){
        try{
            $this->nfe = $nfe;
            $this->linksei = $linksei;
            $this->data = $data;
            $this->observacao = $observacao;

            $bd = Crud_Entrada::conexao();
            $sql = "INSERT INTO entrada(nfe, linksei, data, observacao) VALUES (:nfe,:linksei,:data,:observacao)";
            $stmt = $bd->prepare( $sql );
            $stmt->bindParam(':nfe',$this->nfe,PDO::PARAM_STR);
            $stmt->bindParam(':linksei',$this->linksei,PDO::PARAM_STR);
            $stmt->bindParam(':data', $this->data, PDO::PARAM_STR);
            $stmt->bindParam(':observacao', $this->observacao, PDO::PARAM_STR);

            $result = $stmt->execute();
            //pega id que foi inserido no banco


            if($result == TRUE)
            {
              $id = $bd->lastInsertId();
              $url="../cadastrar_entrada_produto.php?id=$id";


              echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
              exit();

          }

      }
      catch ( PDOException $e ){
        echo 'Erro ao inserir: ' . $e->getMessage();
    }    
}
function entrada_produto_insert($identrada,$idproduto,$quantidade){
    try{
        $this->identrada = $identrada;
        $this->idproduto = $idproduto;
        $this->quantidade = $quantidade;

        $bd = Crud_Entrada::conexao();
        $sql = "INSERT INTO entradaproduto(identrada,idproduto,quantidade) VALUES (:identrada,:idproduto,:quantidade)";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':identrada',$this->identrada,PDO::PARAM_STR);
        $stmt->bindParam(':idproduto',$this->idproduto,PDO::PARAM_STR);
        $stmt->bindParam(':quantidade',$this->quantidade,PDO::PARAM_STR);

        $sql2 = "UPDATE produto set quantidade = quantidade + $quantidade WHERE idproduto = $idproduto";
        $stmt2 = $bd->prepare( $sql2 );


        $result = $stmt->execute();
        $result2 = $stmt2->execute();
        if($result == TRUE)
        {
           $url="../cadastrar_entrada_produto.php?id=$identrada";
           echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
           exit();

       }



   }
   catch ( PDOException $e ){
    echo 'Erro ao inserir: ' . $e->getMessage();
}    
}
function entrada_update($id,$nfe,$linksei,$data,$observacao){
    try{
        $this->id = $id;
        $this->nfe = $nfe;
        $this->linksei = $linksei;
        $this->data = $data;
        $this->observacao = $observacao;
        $bd = Crud_Entrada::conexao();
        $sql = "UPDATE entrada set nfe = :nfe, linksei = :linksei, data = :data, observacao = :observacao WHERE id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $stmt->bindParam(':nfe',$this->nfe,PDO::PARAM_STR);
        $stmt->bindParam(':linksei',$this->linksei,PDO::PARAM_STR);
        $stmt->bindParam(':data', $this->data, PDO::PARAM_STR);
        $stmt->bindParam(':observacao', $this->observacao, PDO::PARAM_STR);
        $result = $stmt->execute();
        if($result == TRUE)
        {
            $url="../cadastrar_entrada_produto.php?id=$id";
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        } 
    }          

    catch ( PDOException $e ){
        echo 'Erro ao alterar: ' . $e->getMessage();
    }   
}

function entrada_delete($id){
    $bd = Crud_Entrada::conexao();

    $sql = "DELETE FROM entrada WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);

    $result = $stmt->execute();
    if($result == TRUE){

        $url='../listar_entradas.php?excluir';

        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}  

function entrada_produto_delete($id){
    $bd = Crud_Entrada::conexao();

    $sql = "DELETE FROM entradaproduto WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);

    $result = $stmt->execute();
    if($result == TRUE){

        $url='../cadastrar_entrada_produto.php?id=$id';

        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}  

function entrada_select_table(){
        //$this->id = $id;
    $bd = Crud_Entrada::conexao();
    $sql = " SELECT * from entrada
    order by id desc"; 

    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function entrada_produto_select_table($id){
    $this->id = $id;
    $bd = Crud_Entrada::conexao();
    $sql = " SELECT ep.id, ep.identrada, ep.idproduto, ep.quantidade, p.id as idproduto, p.nome as nomeproduto, 
    p.descricao as descricaoproduto,
    p.idunidademedida, u.id as idu, u.nome as nomeunidademedida
    from entradaproduto ep 
    inner join produto p on ep.idproduto = p.id
    inner join unidademedida u on p.idunidademedida = u.id

    where ep.identrada = $id
    order by ep.id desc"; 

    $stmt = $bd->prepare( $sql );
    $stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function entrada_select_ultimo(){
    $bd = Crud_Entrada::conexao();
    $sql = "SELECT id FROM entrada ORDER BY id DESC LIMIT 1";
    $stmt = $bd->prepare( $sql );
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function entrada_select($id){
    $this->id = $id;
    $bd = Crud_Entrada::conexao();
    $sql = "SELECT * from entrada where id = :id";

    $stmt = $bd->prepare( $sql );
    $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

class Crud_Saida extends PDO{
    public function __construct(){

    }
    private function conexao(){
        try{
            $PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
            $PDO->exec("set names utf8");
            return $PDO;
        }
        catch ( PDOException $e ){
            echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
        }
    }


    function saida_insert($idproduto,$quantidade,$data,$idservidor){
        try{
            $this->idproduto = $idproduto;
            $this->quantidade = $quantidade;
            $this->data = $data;
            $this->idservidor = $idservidor;

            $bd = Crud_Saida::conexao();
            $sql = "INSERT INTO saida(idproduto,quantidade,data,idservidor) VALUES (:idproduto,:quantidade,:data,:idservidor)";
            $stmt = $bd->prepare( $sql );
            $stmt->bindParam(':idproduto',$this->idproduto,PDO::PARAM_STR);
            $stmt->bindParam(':quantidade',$this->quantidade,PDO::PARAM_STR);
            $stmt->bindParam(':data', $this->data, PDO::PARAM_STR);
            $stmt->bindParam(':idservidor', $this->idservidor, PDO::PARAM_INT);
            
            $sql2 = "UPDATE produto set quantidade = quantidade - $quantidade WHERE idproduto = $idproduto";
            $stmt2 = $bd->prepare( $sql2 );

            $result = $stmt->execute();
            $result2 = $stmt2->execute();;
            //pega id que foi inserido no banco


            if($result == TRUE)
            {
              $id = $bd->lastInsertId();
              $url="../cadastrar_saida.php?id=$id";


              echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
              exit();

          }

      }
      catch ( PDOException $e ){
        echo 'Erro ao inserir: ' . $e->getMessage();
    }    
}

function saida_update($id,$idproduto,$quantidade,$data,$idservidor){
    try{
        $this->id = $id;
        $this->idproduto = $idproduto;
        $this->quantidade = $quantidade;
        $this->data = $data;
        $this->idservidor = $idservidor;

        $bd = Crud_Saida::conexao();
        $sql = "UPDATE saida set idproduto = :idproduto, quantidade = :quantidade, data = :data, idservidor = :idservidor WHERE id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $stmt->bindParam(':idproduto',$this->idproduto,PDO::PARAM_STR);
        $stmt->bindParam(':quantidade',$this->quantidade,PDO::PARAM_STR);
        $stmt->bindParam(':data', $this->data, PDO::PARAM_STR);
        $stmt->bindParam(':idservidor', $this->idservidor, PDO::PARAM_INT);

        $result = $stmt->execute();
        if($result == TRUE)
        {
            $url='../listar_saidas.php?alt';
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        } 
    }          

    catch ( PDOException $e ){
        echo 'Erro ao alterar: ' . $e->getMessage();
    }   
}

function saida_delete($id){
    $bd = Crud_Saida::conexao();

    $sql = "DELETE FROM saida WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);

    $result = $stmt->execute();
    if($result == TRUE){

        $url='../listar_saidas.php?excluir';

        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}  

function saida_select_table(){
        //$this->id = $id;
    $bd = Crud_Saida::conexao();
    $sql = " SELECT s.id, s.idproduto, s.quantidade, s.data, s.idservidor, p.nome as nomeproduto, pes.nome as nomeservidor from saida s
    inner join produto p on s.idproduto = p.id
    inner join pessoa pes on s.idservidor = pes.id
    
    group by pes.nome
    order by id desc"; 

    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function saida_select_ultimo(){
    $bd = Crud_Saida::conexao();
    $sql = "SELECT id FROM saida ORDER BY id DESC LIMIT 1";
    $stmt = $bd->prepare( $sql );
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function saida_select($id){
    $this->id = $id;
    $bd = Crud_Saida::conexao();
    $sql = "SELECT * from saida where id = :id";

    $stmt = $bd->prepare( $sql );
    $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

class Crud_Unidademedida extends PDO{
    public function __construct(){

    }
    private function conexao(){
        try{
            $PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
            $PDO->exec("set names utf8");
            return $PDO;
        }
        catch ( PDOException $e ){
            echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
        }
    }

    function unidademedida_insert($nome){
        try{
            $this->nome = $nome;

            $bd = Crud_Unidademedida::conexao();
            $sql = "INSERT INTO unidademedida(nome) VALUES (:nome)";
            $stmt = $bd->prepare( $sql );
            $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);

            $result = $stmt->execute();
            if($result == TRUE)
            {
             $url='../listar_unidadesmedida.php?cad';
             echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
             exit();
         }

     }
     catch ( PDOException $e ){
        echo 'Erro ao inserir: ' . $e->getMessage();
    }    
}
function unidademedida_update($id,$nome){
    try{
        $this->id = $id;
        $this->nome = $nome;
        $bd = Crud_Unidademedida::conexao();
        $sql = "UPDATE unidademedida set nome = :nome WHERE id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);

        $result = $stmt->execute();
        if($result == TRUE)
        {
            $url='../listar_unidadesmedida.php?alt';
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        } 
    }          

    catch ( PDOException $e ){
        echo 'Erro ao alterar: ' . $e->getMessage();
    }   
}

function unidademedida_delete($id){
    $bd = Crud_Unidademedida::conexao();

    $sql = "DELETE FROM unidademedida WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);

    $result = $stmt->execute();
    if($result == TRUE){

        $url='../listar_unidadesmedida.php?excluir';

        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}  

function unidademedida_select_table(){
        //$this->id = $id;
    $bd = Crud_Unidademedida::conexao();
    $sql = " SELECT * from unidademedida
    order by id desc"; 

    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function unidademedida_select_ultimo(){
    $bd = Crud_Unidademedida::conexao();
    $sql = "SELECT id FROM unidademedida ORDER BY id DESC LIMIT 1";
    $stmt = $bd->prepare( $sql );
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function unidademedida_select($id){
    $this->id = $id;
    $bd = Crud_Unidademedida::conexao();
    $sql = "SELECT * from unidademedida where id = :id";

    $stmt = $bd->prepare( $sql );
    $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function select_unidademedida_combo(){
    $bd = Crud_Unidademedida::conexao();
    $sql = "SELECT * FROM unidademedida order by nome";
    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
}

class Crud_Setor extends PDO{
    public function __construct(){

    }
    private function conexao(){
        try{
            $PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
            $PDO->exec("set names utf8");
            return $PDO;
        }
        catch ( PDOException $e ){
            echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
        }
    }

    function setor_insert($nome){
        try{
            $this->nome = $nome;

            $bd = Crud_Setor::conexao();
            $sql = "INSERT INTO setor(nome) VALUES (:nome)";
            $stmt = $bd->prepare( $sql );
            $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);

            $result = $stmt->execute();
            if($result == TRUE)
            {
             $url='../listar_setor.php?cad';
             echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
             exit();
         }

     }
     catch ( PDOException $e ){
        echo 'Erro ao inserir: ' . $e->getMessage();
    }    
}
function setor_update($id,$nome){
    try{
        $this->id = $id;
        $this->nome = $nome;
        $bd = Crud_Setor::conexao();
        $sql = "UPDATE setor set nome = :nome WHERE id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);

        $result = $stmt->execute();
        if($result == TRUE)
        {
            $url='../listar_setor.php?alt';
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        } 
    }          

    catch ( PDOException $e ){
        echo 'Erro ao alterar: ' . $e->getMessage();
    }   
}

function setor_delete($id){
    $bd = Crud_Setor::conexao();

    $sql = "DELETE FROM setor WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);

    $result = $stmt->execute();
    if($result == TRUE){

        $url='../listar_setor.php?excluir';

        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}  

function setor_select_table(){
        //$this->id = $id;
    $bd = Crud_Setor::conexao();
    $sql = " SELECT * from setor
    order by id desc"; 

    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function setor_select_ultimo(){
    $bd = Crud_Setor::conexao();
    $sql = "SELECT id FROM setor ORDER BY id DESC LIMIT 1";
    $stmt = $bd->prepare( $sql );
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function setor_select($id){
    $this->id = $id;
    $bd = Crud_Setor::conexao();
    $sql = "SELECT * from setor where id = :id";

    $stmt = $bd->prepare( $sql );
    $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function select_setor_combo(){
    $bd = Crud_Setor::conexao();
    $sql = "SELECT * FROM setor order by nome";
    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

}


}

class Crud_Tipoproduto extends PDO{
    public function __construct(){

    }
    private function conexao(){
        try{
            $PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
            $PDO->exec("set names utf8");
            return $PDO;
        }
        catch ( PDOException $e ){
            echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
        }
    }

    function tipoproduto_insert($nome){
        try{
            $this->nome = $nome;

            $bd = Crud_Tipoproduto::conexao();
            $sql = "INSERT INTO tipoproduto(nome) VALUES (:nome)";
            $stmt = $bd->prepare( $sql );
            $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);

            $result = $stmt->execute();
            if($result == TRUE)
            {
             $url='../listar_tipoproduto.php?cad';
             echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
             exit();
         }

     }
     catch ( PDOException $e ){
        echo 'Erro ao inserir: ' . $e->getMessage();
    }    
}
function tipoproduto_update($id,$nome){
    try{
        $this->id = $id;
        $this->nome = $nome;
        $bd = Crud_Tipoproduto::conexao();
        $sql = "UPDATE tipoproduto set nome = :nome WHERE id = :id";
        $stmt = $bd->prepare( $sql );
        $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);

        $result = $stmt->execute();
        if($result == TRUE)
        {
            $url='../listar_tipoproduto.php?alt';
            echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
            exit();
        } 
    }          

    catch ( PDOException $e ){
        echo 'Erro ao alterar: ' . $e->getMessage();
    }   
}

function tipoproduto_delete($id){
    $bd = Crud_Tipoproduto::conexao();

    $sql = "DELETE FROM tipoproduto WHERE id = :id ";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);

    $result = $stmt->execute();
    if($result == TRUE){

        $url='../listar_tipoproduto.php?excluir';

        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();
    } 
}  

function tipoproduto_select_table(){
        //$this->id = $id;
    $bd = Crud_Tipoproduto::conexao();
    $sql = " SELECT * from tipoproduto
    order by id desc"; 

    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function tipoproduto_select_ultimo(){
    $bd = Crud_Tipoproduto::conexao();
    $sql = "SELECT id FROM tipoproduto ORDER BY id DESC LIMIT 1";
    $stmt = $bd->prepare( $sql );
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function tipoproduto_select($id){
    $this->id = $id;
    $bd = Crud_Tipoproduto::conexao();
    $sql = "SELECT * from tipoproduto where id = :id";

    $stmt = $bd->prepare( $sql );
    $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function select_tipoproduto_combo(){
    $bd = Crud_Tipoproduto::conexao();
    $sql = "SELECT * FROM tipoproduto order by nome";
    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function tipoproduto_select_menu(){
        //$this->id = $id;
    $bd = Crud_Tipoproduto::conexao();
    $sql = "SELECT p.id, p.nome, p.descricao, p.idunidademedida, p.idtipoproduto, p.quantidade, p.estoqueminimo, u.nome as nomeunidademedida, tp.nome as nometipoproduto FROM produto p
    inner join unidademedida u on p.idunidademedida = u.id
    inner join tipoproduto tp on p.idtipoproduto = tp.id
    group by u.nome, p.id, tp.id"; 

    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function tipoproduto_select_menu_lista(){
        //$this->id = $id;
    $bd = Crud_Tipoproduto::conexao();
    $sql = "SELECT * FROM tipoproduto"; 

    $stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
    $result = $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

?>