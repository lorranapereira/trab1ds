<?php 
// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['email'];
$usuario = $_POST['usuario'];
// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
 
// A variavel $result pega as varias $login e $usuario, faz uma 
//pesquisa na tabela de usuarios
$filepath = '/home/lorrana/Desktop';
$filename = $filepath."/arquivo.txt";    
$file = fopen($filename, "a+");
ler($file);
function gravar(){
    $login = $_POST['email'];
    $usuario = $_POST['usuario'];
    $filepath = '/home/lorrana/Desktop';
    $filename = $filepath."/arquivo.txt";    
    $file = fopen($filename, "a+");
    if ($file) {
        if (fwrite($file, $login.';'.$usuario.";")) {
            echo "<br/> write successful <br/>";
            fclose($file);
            session_start();                        
            $_SESSION['login'] = $login;
            $_SESSION['usuario'] = $usuario;				
        }
    }
}

function ler($file){
    //Variável arquivo armazena o nome e extensão do arquivo.
    $filepath = '/home/lorrana/Desktop';
    $filename = $filepath."/arquivo.txt";
    //Variável $fp armazena a conexão com o arquivo e o tipo de ação.
    $fp = fopen($filename, "r");
    //Lê o conteúdo do arquivo aberto.
    $conteudo = fread($fp, filesize($filename));
    $linha = explode(";",$conteudo);

    fclose($fp);
    verifica($linha);
     
}
function verifica($linha){

    $login = $_POST['email'];
    $usuario = $_POST['usuario'];
    echo $login;
    print_r($linha);   
    $r= array_search($login,$linha);
    print_r($linha[3]);
    if (array_search($login,$linha)) {
        $ind = array_search($login,$linha);
        if ($linha[$ind+1] == $usuario) {
            session_start();            
            $_SESSION['login'] = $login;
            $_SESSION['usuario'] = $usuario;	
            echo "Já registrado";
        }
        else{
            echo "Senha incorreta";
            }       
    } 
    else {   
        gravar();   
    }
     
}



  // Fechpa arquivo aberto
/*
$result = mysql_query("SELECT * FROM `USUARIO` 
WHERE `NOME` = '$login' AND `SENHA`= '$senha'");
/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi 
bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor
será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do 
resultado ele redirecionará para a página site.php ou retornara  para a página 
do formulário inicial para que se possa tentar novamente realizar o login */
/*if(mysql_num_rows ($result) > 0 ){
    $_SESSION['login'] = $  ;
    $_SESSION['senha'] = $senha;
    header('location:site.php');
}
else{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  header('location:index.php');
   
  }*/
?>