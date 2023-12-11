<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conversão de Moedas V2 (resultado)</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section class="card">
    <h1>Conversor de Moedas v2.0 com API (resultado)</h1>
    <?php
    $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=%2712-08-2023%27&@dataFinalCotacao=%2712-08-2023%27&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,cotacaoVenda,dataHoraCotacao';

    $response = file_get_contents($url);
    $dados = json_decode($response, true);

    $cotacao = $dados["value"][0]["cotacaoCompra"];

    $user = $_GET["num"];
    $num = str_replace(",", ".", $user);

    $res = $num / $cotacao;
    $res_ab = number_format($res, 2);

    echo "<p>Os seus R$ $user equivalem a U$ $res_ab</p>";

    if ($response === false) {
      echo "<p>Erro na aquisição</p>";
    } else if ($dados === null) {
      echo "<p>Erro ao codificar o JSON</p>";
    }
    ?>
    <button>
      <a href="javascript:history.go(-1)">Voltar</a>
    </button>
  </section>
</body>

</html>