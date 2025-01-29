<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main>
        <h1>Real para Dólar</h1>
        <section>

            <?php 

            //cotação com API
            $inicio = date("m-d-Y", strtotime ("-7 days"))  ;
            $fim = date("m-d-Y");

            $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio .'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

            $dados = json_decode(file_get_contents($url), true);

            //var_dump($dados);

            $cotacao = $dados["value"][0]["cotacaoCompra"];

            $real = $_GET["valor"] ?? 0.00;

            $dolar = $real / $cotacao;
            
            $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

            echo "<p>Seus " . numfmt_format_currency($padrao, $real, "BRL")." equivalem a <strong>". numfmt_format_currency($padrao, $dolar, "USD") ."</strong></p>";

            echo "<p> <strong>*Cotação fixa em R\$ $cotacao </strong> informada diretamente no código.</p>";
            ?>

            <button onclick="javascript:window.location.href='index.html'">Voltar para página anterior</button>
        </section>

    </main>
</body>
</html>