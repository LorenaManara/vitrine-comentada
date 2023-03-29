<?php 
    require "config.php";

    // config.php - é onde possui as configurações para fazer  conexão com o banco de dados MySQL.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- tag meta define o tipo de codificação da pagina -->
    <!-- tamanho da tela, compatibilidade com o navegador, e o titulo da pagina -->

    <title>Vitrine da Adidas</title>
    <base href="http://localhost:8888/vitrine/">
    <link rel="shortcut icon" href="imagens/icone.png">
    <link rel="stylesheet" href="./estilo.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/lightbox.min.css">
    <!-- os link servem para referenciam arquivos CSS e JavaScript. -->
</head>
<body>
    <header>
        <a href="index.php" title="Home">
            <img src="./imagens/logo.png" alt="Adidas">
            <!-- aqui vai inserir a logo do site -->
        </a>

        <!-- aqui começa o menu de navegação dinamico -->
        
        <nav>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <?php
                //selecionar todas as categorias

                
                // <!-- a nav é preenchida com produtos que são buscadas no banco de dados MySQL usando o objeto PDO  -->

                // <!-- é armazenado em um objeto PDOStatement, que é percorrido com um loop while para gerar as opções do menu.
                //  Cada opção é um link para uma página de categoria. -->
                $sql = "select * from categoria
                order by nome";
                //preparar o sql para execução
                $consulta = $pdo->prepare($sql);
                //executar
                $consulta->execute();

                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                    //separar os dados
                    $id = $dados->id;
                    $nome = $dados->nome;
                    ?>
                    <li>
                        <a href="categoria/<?=$id?>">
                            <?=$nome?>
                        </a>
                    </li>
                    <?php
                }

                ?>
                <li>
                    <a href="contato">Contato</a>
                </li>
            </ul>
        </nav>
    </header>

    <?php
        //print_r ( $_GET );
        $pagina = "home";
        //verificar se esta enviando o $_GET["param"]

        // dependendo do valor do parâmetro "param" na URL. 
         // O valor desse parâmetro é lido usando a variável $_GET e usado para carregar uma página PHP

        // é incluída no arquivo principal usando a função require(). 
        // Se a página não existe, o usuário é redirecionado para uma página de erro.
        if ( isset($_GET["param"]) ) {
            $pagina = $_GET["param"];
            $p = explode("/", $pagina);
            $pagina = $p[0];
        }
        //caminho da página para inclusão
        // aqui seria a pagina de erro, que se n existe ela vai ser redirecionada para cá.
        $pagina = "paginas/{$pagina}.php";
        //verificar se o arquivo existe
        if ( file_exists($pagina) ) {
            require $pagina;
        } else {
            require "paginas/erro.php";
        }
    ?>
    
    <footer>
        <p>Desenvolvido por Maycon Yorrahn Palmeiras</p>
    </footer>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/lightbox.min.js"></script>
</body>
</html>