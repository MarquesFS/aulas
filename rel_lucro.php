<?php
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


$data_hoje = mb_convert_encoding(strftime('%A, %d de %B de %Y', strtotime('today')), 'UTF-8');


$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));

if ($dataInicial == $dataFinal) {
    $texto_apuracao = 'APURADO EM ' . $dataInicialF;
} else if ($dataInicial == '1980-01-01') {
    $texto_apuracao = 'APURADO EM TODO O PERÍODO';
} else {
    $texto_apuracao = 'APURAÇÃO DE ' . $dataInicialF . ' ATÉ ' . $dataFinalF;
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Demonstrativo de Lucro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


    <style>
        @page {
            margin: 0px;

        }

        body {
            margin-top: 5px;
            font-family: TimesNewRoman, Geneva, sans-serif;
        }

        .footer {
            margin-top: 20px;
            width: 100%;
            background-color: #ebebeb;
            padding: 5px;
            position: relative;
            display: inline-block;
            bottom: 0;
        }



        .cabecalho {
            padding: 10px;
            margin-bottom: 30px;
            width: 100%;
            font-family: TimesNewRoman, Geneva, sans-serif;
        }

        .titulo_cab {
            color: #0340a3;
            font-size: 20px;
        }



        .titulo {
            margin: 0;
            font-size: 28px;
            font-family: TimesNewRoman, Geneva, sans-serif;
            color: #6e6d6d;

        }

        .subtitulo {
            margin: 0;
            font-size: 12px;
            font-family: TimesNewRoman, Geneva, sans-serif;
            color: #6e6d6d;
        }



        hr {
            margin: 8px;
            padding: 0px;
        }



        .area-cab {

            display: block;
            width: 100%;
            height: 10px;

        }


        .coluna {
            margin: 0px;
            float: left;
            height: 30px;
        }

        .area-tab {

            display: block;
            width: 100%;
            height: 30px;

        }


        .imagem {
            width: 150px;
            position: absolute;
            right: 20px;
            top: 10px;
        }

        .titulo_img {
            position: absolute;
            margin-top: 10px;
            margin-left: 10px;

        }

        .data_img {
            position: absolute;
            margin-top: 40px;
            margin-left: 10px;
            border-bottom: 1px solid #000;
            font-size: 10px;
        }

        .endereco {
            position: absolute;
            margin-top: 50px;
            margin-left: 10px;
            border-bottom: 1px solid #000;
            font-size: 10px;
        }

        .verde {
            color: green;
        }

        .textotachado {
            text-decoration: line-through;
            color: #ff4c4c;
        }

        table.borda {
            border-collapse: collapse;
            /* CSS2 */
            background: #FFF;
            font-size: 12px;
            vertical-align: middle;
        }

        table.borda td {
            border: 1px solid #dbdbdb;
        }

        table.borda th {
            border: 1px solid #dbdbdb;
            background: #ededed;
            font-size: 13px;
        }
    </style>


</head>

<body>

    <div class="titulo_cab titulo_img"><u>Demonstrativo de Lucro </u></div>
    <div class="data_img"><?php echo mb_strtoupper($data_hoje) ?></div>

    <img class="imagem" src="<?php echo $url_sistema ?>/sistema/img/logo_rel.jpg" width="150px">


    <br><br><br>
    <div class="cabecalho" style="border-bottom: solid 1px #0340a3">
    </div>

    <div class="mx-2">

        <section class="area-cab">

            <div>
                <small><small><small><u><?php echo $texto_apuracao ?></u></small></small></small>
            </div>


        </section>

        <br>

        <?php
        $total_servicos = 0;
        $total_pix = 0;
        $total_crtcredito = 0;
        $total_crtdebito = 0;
        $total_transfe = 0;
        $total_caixa = 0;
        $total_servicos_receber_conta = 0;
        $total_receber = 0;
        $total_pagar = 0;
        $total_compras = 0;
        $total_comissoes = 0;
        $total_servicos_pix = 0;
        $total_servico_cartao_creditoF = 0;
        $total_servicos_cartao_credito = 0;
        $totalcartao_credito_debito = 0;
        $total_servicos_cartao_debito = 0;
        $totalservicos_transferencia = 0;
        $total_transferencia = 0;
        $totalrecepcao_caixa = 0;
        $totalcaixa_recep = 0;
        $abertura_caixa = 0;
        $total_servicos_segundo = 0;


        $total_entradas = 0;
        $total_saidas = 0;

        $saldo_total = 0;

        ?>

        <table class="table table-striped borda" cellpadding="6">
            <thead>
                <tr align="center">
                    <th scope="col" class="text-primary">Clínica</th>
                    <th scope="col" class="text-primary">PGTO Pix</th>
                    <th scope="col" class="text-primary">PGTO Cartão de Crédito</th>
                    <th scope="col" class="text-primary">PGTO Cartão de Débito</th>
                    <th scope="col" class="text-primary">PGTO Transferência</th>
                    <th scope="col" class="text-primary">PGTO Dinheiro</th>
                    <th scope="col" class="text-primary">Bem Estar</th>
                    <th scope="col" class="text-primary">Saídas Dinheiro</th>
                    <th scope="col" class="text-primary">Saídas Pix</th>

                </tr>
            </thead>
            <tbody>

                <?php
                //totalizar os serviços 
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos += $res[$i]['valor'];
                    $total_servicos_segundo += $res[$i]['segun_valor_serv'];
                }


                //totalizar os serviços pagamento pix  contas a receber
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and forma_pagamentos = 'Pix' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_pix += $res[$i]['valor'];
                }

                //totalizar os serviços pagamento pix  contas a receber (tipo conta)
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Pix' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_conta_pix += $res[$i]['valor'];
                }



                //totalizar os serviços contas a receber
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_receber_conta += $res[$i]['valor'];
                }
                $total_soma_servico = $total_servicos + $total_servicos_receber_conta  + $total_servicos_segundo;


                //totalizar os serviços pagamento pix segunda forma
                $total_servicos_pix_segun = 0;
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and segun_forma_pgto = 'Pix' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_pix_segun += $res[$i]['segun_valor_serv'];
                }


                //totalizar os pix tabela receber 
                $query = $pdo->query("SELECT * FROM receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Pix' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_pix += $res[$i]['valor'];
                }
                $total_servico_receber = $total_servicos_pix + $total_pix + $total_servicos_pix_segun + $total_conta_pix;

                //totalizar os cartão de crédito tabela receber 
                $query = $pdo->query("SELECT * FROM receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Cartão de Crédito' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_crtcredito += $res[$i]['valor'];
                }

                //totalizar os serviços pagamento cartão de crédito segunda forma
                $total_servicos_cartao_credito_segun = 0;
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and segun_forma_pgto = 'Cartão de Crédito' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_cartao_credito_segun += $res[$i]['segun_valor_serv'];
                }

                //totalizar os serviços pagamento cartão de crédito ( Tipo Conta)
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Cartão de Crédito' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_cartao_credito_conta += $res[$i]['valor'];
                }

                //totalizar os serviços pagamento cartão de crédito
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and forma_pagamentos = 'Cartão de Crédito' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_cartao_credito += $res[$i]['valor'];
                }

                $total_servico_cartao_creditoF = $total_servicos_cartao_credito + $total_crtcredito + $total_servicos_cartao_credito_segun + $total_servicos_cartao_credito_conta;

                //totalizar os cartão de débito tabela receber 
                $query = $pdo->query("SELECT * FROM receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Cartão de Débito' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_crtdebito += $res[$i]['valor'];
                }

                //totalizar os serviços pagamento cartão de débito segunda forma
                $total_servicos_cartao_debito_segun = 0;
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and segun_forma_pgto = 'Cartão de Débito' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_cartao_debito_segun += $res[$i]['segun_valor_serv'];
                }

                //totalizar os serviços pagamento cartão de débito (tipo conta)
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Cartão de Débito' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_cartao_debito_conta += $res[$i]['valor'];
                }


                //totalizar os serviços pagamento cartão de débito
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and forma_pagamentos = 'Cartão de Débito' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_servicos_cartao_debito += $res[$i]['valor'];
                }
                $totalcartao_credito_debito = $total_servicos_cartao_debito + $total_crtdebito + $total_servicos_cartao_debito_segun + $total_servicos_cartao_debito_conta;


                //totalizar as transferência tabela receber 
                $query = $pdo->query("SELECT * FROM receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Transferência' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_transfe += $res[$i]['valor'];
                }

                //totalizar os serviços pagamento transferência segunda forma
                $totalservicos_transferencia_segun = 0;
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and segun_forma_pgto = 'Transferência' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $totalservicos_transferencia_segun += $res[$i]['segun_valor_serv'];
                }

                //totalizar os serviços pagamento transferência (tipo conta)
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Transferência' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $totalservicos_transferencia_conta += $res[$i]['valor'];
                }

                //totalizar os serviços pagamento transferência
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and forma_pagamentos = 'Transferência' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $totalservicos_transferencia += $res[$i]['valor'];
                }
                $total_transferencia = $totalservicos_transferencia + $total_transfe + $totalservicos_transferencia_segun + $totalservicos_transferencia_conta;

                //totalizar as caixa recepção tabela receber 
                $query = $pdo->query("SELECT * FROM receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Dinheiro' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_caixa += $res[$i]['valor'];
                }


                //totalizar os serviços pagamento caixa recepção segunda forma
                $totalcaixa_recep_segun = 0;
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and segun_forma_pgto = 'Dinheiro' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $totalcaixa_recep_segun += $res[$i]['segun_valor_serv'];
                }

                //totalizar os serviços pagamento caixa recepção
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Serviço' and pago = 'Sim' and forma_pagamentos = 'Dinheiro' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $totalcaixa_recep += $res[$i]['valor'];
                }

                //totalizar os serviços pagamento caixa recepção (tipo conta)
                $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' and forma_pagamentos = 'Dinheiro' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $totalcaixa_conta += $res[$i]['valor'];
                }


                // Calcular abertura caixa
                $query = $pdo->query("SELECT * FROM caixa where data_abertura >= '$dataInicial' and data_abertura <= '$dataFinal'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                if (@count($res) > 0) {
                    for ($i = 0; $i < @count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }
                        $abertura_caixa += $res[$i]['valor'];
                        $vlt_sangria_dia += $res[$i]['valor_sangria'];
                    }
                }
                $caixavtl = $abertura_caixa - $vlt_sangria_dia;

                $totalrecepcao_caixa = $totalcaixa_recep + $total_caixa + $caixavtl + $totalcaixa_recep_segun + $totalcaixa_conta;

                //totalizar contas recebidas alunos
                $query = $pdo->query("SELECT * FROM receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_receber += $res[$i]['valor'];
                }

                //totalizar contas despesas
                $query = $pdo->query("SELECT * FROM pagar where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Conta' and pago = 'Sim' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_pagar += $res[$i]['valor'];
                }

                //totalizar contas despesas    and tipo = 'Conta'
                $query = $pdo->query("SELECT * FROM pagar where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal'  and pago = 'Sim' and forma_pagamentos = 'Dinheiro' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_dinheiro_forma += $res[$i]['valor'];
                }

                //totalizar contas despesas  and tipo = 'Conta'
                $query = $pdo->query("SELECT * FROM pagar where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal'  and pago = 'Sim' and forma_pagamentos = 'Pix' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_pix_forma += $res[$i]['valor'];
                }

                //totalizar contas compras
                $query = $pdo->query("SELECT * FROM pagar where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Compra' and pago = 'Sim' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $total_compras += $res[$i]['valor'];
                }


                //totalizar contas despesas
                $query = $pdo->query("SELECT * FROM pagar where  data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and tipo = 'Comissão' and pago = 'Sim' ORDER BY data_pgto asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                for ($i = 0; $i < $total_reg; $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $total_comissoes += $res[$i]['valor'];
                    $segun_valorComissoes += $res[$i]['segun_valor'];
                    $primeiro_valorComissoes += $res[$i]['prime_valor'];
                }

                $totalComissoesValores = $total_comissoes;

                /* variavies total comissões */
                /* $totalComissoesValores = $total_comissoes = $segun_valorComissoes = $primeiro_valorComissoes; */


                $total_servicosF = number_format($total_soma_servico, 2, ',', '.');
                $total_pixF = number_format($total_servico_receber, 2, ',', '.');
                $total_crtcreditoF = number_format($total_servico_cartao_creditoF, 2, ',', '.');
                $total_crtdebitoF = number_format($totalcartao_credito_debito, 2, ',', '.');
                $total_transfeF = number_format($total_transferencia, 2, ',', '.');
                $total_caixaF = number_format($totalrecepcao_caixa, 2, ',', '.');
                $total_receberF = number_format($total_receber, 2, ',', '.');
                $total_pagarF = number_format($total_pagar, 2, ',', '.');
                $total_comprasF = number_format($total_compras, 2, ',', '.');
                $total_comissoesF = number_format($primeiro_valorComissoes, 2, ',', '.');
                $total_comissoespixF = number_format($segun_valorComissoes, 2, ',', '.');
                $total_dinheiro_formaF = number_format($total_dinheiro_forma, 2, ',', '.');
                $total_pix_formaF = number_format($total_pix_forma, 2, ',', '.');


                $total_entradas = $total_soma_servico  + $total_receber + $caixavtl;

                $total_saidas = $total_pagar + $total_compras + $totalComissoesValores;

                $total_entradasF = number_format($total_entradas, 2, ',', '.');
                $total_saidasF = number_format($total_saidas, 2, ',', '.');

                $saldo_total = $total_entradas - $total_saidas;

                $saldo_totalF = number_format($saldo_total, 2, ',', '.');

                if ($saldo_total < 0) {
                    $classe_saldo = 'text-danger';
                    $classe_img = 'grafico_negativo.png';
                } else {
                    $classe_saldo = 'text-success';
                    $classe_img = 'grafico_positivo.png';
                }

                ?>

                <tr align="center" class="">

                    <td class="text-success">R$ <?php echo $total_servicosF ?></td>
                    <td class="text-success">R$ <?php echo $total_pixF ?></td>
                    <td class="text-success">R$ <?php echo $total_crtcreditoF ?></td>
                    <td class="text-success">R$ <?php echo $total_crtdebitoF ?></td>
                    <td class="text-success">R$ <?php echo $total_transfeF ?></td>
                    <td class="text-success">R$ <?php echo $total_caixaF ?></td>
                    <td class="text-success">R$ <?php echo $total_receberF ?></td>
                    <td class="text-danger">R$ <?php echo $total_dinheiro_formaF ?></td>
                    <td class="text-danger">R$ <?php echo $total_pix_formaF ?></td>


                </tr>


                <tr align="center" class="">
                    <td style="background: #e6ffe8" colspan="7" scope="col">Total de Entradas / Ganhos</td>
                    <td style="background: #ffe7e6" colspan="3" scope="col">Total de Saídas / Despesas</td>
                </tr>

                <tr align="center" class="">
                    <td colspan="3" class="text-success"> R$ <?php echo $total_entradasF ?></td>
                    <td colspan="3" class="text-danger"> R$ <?php echo $total_saidasF ?></td>
                </tr>

            </tbody>
        </table>
    </div>


    <div class="col-md-12 p-2">
        <div class="" align="center" style="margin-right: 20px">

            <img src="<?php echo $url_sistema ?>/sistema/img/<?php echo $classe_img ?>" width="100px">
            <span class="<?php echo $classe_saldo ?>">R$ <?php echo $saldo_totalF ?></span>


        </div>
    </div>


    <?php
    $query = $pdo->query("SELECT * FROM caixa where data_abertura >= '$dataInicial' and data_abertura <= '$dataFinal'  ORDER BY data_abertura asc ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {

        echo <<<HTML
	<small>
	<table class="table  table-striped" id="tabela" style="margin-top:30px;">
	<thead> 
	<tr> 
	<th class="text-primary">Movimentações Caixa</th>	
	<th class="text-primary">Funcionario</th>		
	<th class="text-primary">Data Abertura / Fechamento</th>
    <th class="text-primary">Horário</th>
    <th class="text-primary">Valor</th>
    <th class="text-primary">Sangria</th>
    <th class="text-primary">Obs</th>
    
	</tr> 
	</thead> 
	<tbody>	
HTML;

        for ($i = 0; $i < $total_reg; $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $id = $res[$i]['id'];
            $descricao = $res[$i]['descricao'];
            $data_abertura = $res[$i]['data_abertura'];
            $valor_fechamento = $res[$i]['valor_fechamento	'];
            $funcionario = $res[$i]['funcionario'];
            $valor_caixa = $res[$i]['valor'];
            $sangria_caixa = $res[$i]['sangria'];
            $valor_sangria = $res[$i]['valor_sangria'];
            $obs_caixa = $res[$i]['obs'];
            $horario_caixa = $res[$i]['horario'];

            $data_aberturaF = implode('/', array_reverse(explode('-', $data_abertura)));

            $valor_sangriaF = number_format($valor_sangria, 2, ',', '.');
            $valor_caixaF = number_format($valor_caixa, 2, ',', '.');


            $query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_baixa_total'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $nome_usuario_pgto = $res2[0]['nome'];
                $nome_usuario_pgto = mb_convert_case($nome_usuario_pgto, MB_CASE_TITLE, "UTF-8");
            } else {
                $nome_usuario_pgto = 'Nenhum!';
            }


            $query2 = $pdo->query("SELECT * FROM caixa where id = '$id' and descricao = 'Abertura Caixa'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $valor_entrada_caixa = $res2[0]['valor'];
            }



            $query2 = $pdo->query("SELECT * FROM caixa where id = '$id' and descricao = 'Fechamento Caixa'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $fechamento_caixa = $res2[0]['valor_fechamento'];
            }

            if ($descricao == 'Abertura Caixa') {
                $total_entrada = $valor_entrada_caixa;
            } else {
                $total_entrada = $fechamento_caixa;
                $ocultar_sangria_fecha = 'textotachado';
            }



            $total_entradaF = number_format($total_entrada, 2, ',', '.');

            echo <<<HTML
<tr class="">
<td>{$descricao}</td>
<td>{$funcionario}</td>
<td>{$data_aberturaF}</td>
<td>{$horario_caixa}</td>
<td>R$: {$total_entradaF}</td>
<td class="text-danger {$ocultar_sangria_fecha}">R$: {$valor_sangriaF}</td>
<td>{$obs_caixa}</td>

<td>
		
</td>
</tr>
HTML;
        }

        echo <<<HTML
</tbody>
</table>
</small>
HTML;
    }

    ?>

    <?php
    $query = $pdo->query("SELECT * FROM pagar where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal'  ORDER BY data_pgto asc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {

        echo <<<HTML
	<small>
	<table class="table table-striped" id="tabela" style="margin-top:120px;">
	<thead> 
	<tr> 
	<th class="text-primary">Movimentações Saídas</th>	
	<th class="text-primary">Tipo</th>		
	<th class="text-primary">Data PGTO</th>
    <th class="text-primary">Horário</th>
    <th class="text-primary">Usuario Baixa</th>
    <th class="text-primary">Pago</th>
    <th class="text-primary">Valor</th>
    <th class="text-primary">Forma PGTO</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

        for ($i = 0; $i < $total_reg; $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $id = $res[$i]['id'];
            $usuario_baixa_total = $res[$i]['usuario_baixa'];
            $total_descricao = $res[$i]['descricao'];
            $total_pago = $res[$i]['pago'];
            $total_tipo = $res[$i]['tipo'];
            $valor = $res[$i]['valor'];
            $total_data_pagar = $res[$i]['data_pgto'];
            $forma_pagamentos = $res[$i]['forma_pagamentos'];
            $horario = $res[$i]['horario'];

            $prime_valor_tb_pagar += $res[$i]['prime_valor'];


            $total_data_pagarF = implode('/', array_reverse(explode('-', $total_data_pagar)));

            $valorF = number_format($valor, 2, ',', '.');


            //Dinheiro
            $query2 = $pdo->query("SELECT * FROM  pagar where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Dinheiro'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_pagar_dinheiro += $res2[$i]['valor'];
            }
            $total_pagar_dinheiroF = number_format($total_pagar_dinheiro, 2, ',', '.');

            //Pix
            $query2 = $pdo->query("SELECT * FROM  pagar where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Pix' and pago = 'Sim'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_pagar_pix += $res2[$i]['valor'];
            }
            $total_pagar_pixF = number_format($total_pagar_pix, 2, ',', '.');


            $query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_baixa_total'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $nome_usuario_pgto = $res2[0]['nome'];
                $nome_usuario_pgto = mb_convert_case($nome_usuario_pgto, MB_CASE_TITLE, "UTF-8");
            } else {
                $nome_usuario_pgto = 'Nenhum!';
            }

            echo <<<HTML
<tr class="">
<td>{$total_descricao}</td>
<td>{$total_tipo}</td>
<td>{$total_data_pagarF}</td>
<td>{$horario}</td>
<td>{$nome_usuario_pgto}</td>
<td>{$total_pago}</td>
<td>R$: {$valorF}</td>
<td>{$forma_pagamentos}</td>
<td>
		
</td>
</tr>
HTML;
        }

        echo <<<HTML
</tbody>
</table>
<br>	
<div align="right" style="margin-right:20px;" class="font-rodape text-success">Total Dinheiro: <span class="font-rodape">R$ {$total_pagar_dinheiroF}</span> </div>
<div align="right" style="margin-right:20px;" class="font-rodape text-warning">Total Pix: <span class="font-rodape">R$ {$total_pagar_pixF}</span> </div>

<br>
</small>
HTML;
    }

    ?>

    <?php
    $query = $pdo->query("SELECT * FROM receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal'  ORDER BY data_pgto asc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {

        echo <<<HTML
	<small>
	<table class="table table-striped" id="tabela" style="margin-top:120px;">
	<thead> 
	<tr> 
	<th class="text-primary">Movimentações Entradas</th>	
	<th class="text-primary">Tipo</th>		
	<th class="text-primary">Data PGTO</th>
    <th class="text-primary">Horário</th>
    <th class="text-primary">Usuario Baixa</th>
    <th class="text-primary">Pago</th>
    <th class="text-primary">Valor</th>
    <th class="text-primary">Forma PGTO</th>
    <th class="text-primary">Forma PGTO Laboratório Paciente</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

        for ($i = 0; $i < $total_reg; $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $id = $res[$i]['id'];
            $usuario_baixa_total = $res[$i]['usuario_baixa'];
            $total_descricao = $res[$i]['descricao'];
            $total_pago = $res[$i]['pago'];
            $total_tipo = $res[$i]['tipo'];
            $total_data_pagar = $res[$i]['data_pgto'];
            $valor = $res[$i]['valor'];
            $forma_pagamentos = $res[$i]['forma_pagamentos'];
            $forma_pgto_labor = $res[$i]['forma_pgto_labor'];
            $horario = $res[$i]['horario'];


            $total_data_pagarF = implode('/', array_reverse(explode('-', $total_data_pagar)));

            $valorF = number_format($valor, 2, ',', '.');


            //Dinheiro
            $query2 = $pdo->query("SELECT * FROM  receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Dinheiro'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_valor_dinheiro += $res2[$i]['valor'];
            }
            $total_valor_dinheiroF = number_format($total_valor_dinheiro, 2, ',', '.');

            //Pix
            $query2 = $pdo->query("SELECT * FROM  receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Pix' and pago = 'Sim'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_valor_pix += $res2[$i]['valor'];
            }
            $total_valor_pixF = number_format($total_valor_pix, 2, ',', '.');


            //Cartão de Débito
            $query2 = $pdo->query("SELECT * FROM  receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Cartão de Débito' and pago = 'Sim'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_valor_debito += $res2[$i]['valor'];
            }
            $total_valor_debitoF = number_format($total_valor_debito, 2, ',', '.');

            //Cartão de Crédito
            $query2 = $pdo->query("SELECT * FROM  receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Cartão de Crédito' and pago = 'Sim'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_valor_credito += $res2[$i]['valor'];
            }
            $total_valor_creditoF = number_format($total_valor_credito, 2, ',', '.');


            //Cheque
            $query2 = $pdo->query("SELECT * FROM  receber_contas where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Cheque'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_valor_cheque += $res2[$i]['valor'];
            }
            $total_valor_chequeF = number_format($total_valor_cheque, 2, ',', '.');



            $query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_baixa_total'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $nome_usuario_pgto = $res2[0]['nome'];
                $nome_usuario_pgto = mb_convert_case($nome_usuario_pgto, MB_CASE_TITLE, "UTF-8");
            } else {
                $nome_usuario_pgto = 'Nenhum!';
            }


            if ($forma_pgto_labor = $forma_pgto_labor) {
                $nome_forma_pgto = $forma_pgto_labor;
            } else {
                $nome_forma_pgto = 'Nenhum Registro!';
            }



            echo <<<HTML
<tr class="">
<td>{$total_descricao}</td>
<td>{$total_tipo}</td>
<td>{$total_data_pagarF}</td>
<td>{$horario}</td>
<td>{$nome_usuario_pgto}</td>
<td>{$total_pago}</td>
<td>R$: {$valorF}</td>
<td>{$forma_pagamentos}</td>
<td>{$nome_forma_pgto}</td>
<td>
		
</td>
</tr>
HTML;
        }

        echo <<<HTML
</tbody>
</table>
<br>	
<div align="right" style="margin-right:20px;" class="font-rodape text-success">Total Dinheiro: <span class="font-rodape">R$ {$total_valor_dinheiroF}</span> </div>
<div align="right"style="margin-right:20px;"  class="font-rodape text-warning">Total Pix: <span class="font-rodape">R$ {$total_valor_pixF}</span> </div>
<div align="right" style="margin-right:20px;" class="font-rodape text-primary">Total Cartão de Débito: <span class="font-rodape">R$ {$total_valor_debitoF}</span> </div>
<div align="right" style="margin-right:20px;" class="font-rodape text-dark">Total Cartão de Crédito: <span class="font-rodape">R$ {$total_valor_creditoF}</span> </div>
<div align="right" style="margin-right:20px;" class="font-rodape text-success">Total Cheque: <span class="font-rodape">R$ {$total_valor_chequeF}</span> </div>

<br>
</small>
HTML;
    }

    ?>

    <!-- LIMIT 20 - codigo pra listar limite -->
    <?php
    $query = $pdo->query("SELECT * FROM receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal'  ORDER BY data_pgto asc ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {

        echo <<<HTML
	<small>
	<table class="table table-striped" id="tabela" style="margin-top:120px;">
	<thead> 
	<tr> 
	<th class="text-primary">Movimentações Bem Estar</th>	
	<th class="text-primary">Tipo</th>	
    <th class="text-primary">Data Vencimento</th>	
	<th class="text-primary">Data PGTO</th>
    <th class="text-primary">Horário</th>
    <th class="text-primary">Usuario Baixa</th>
    <th class="text-primary">Pago</th>
    <th class="text-primary">Valor</th>
    <th class="text-primary">Forma PGTO</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

        for ($i = 0; $i < $total_reg; $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $id = $res[$i]['id'];
            $usuario_baixa_total = $res[$i]['usuario_baixa'];
            $total_descricao = $res[$i]['descricao'];
            $total_pago = $res[$i]['pago'];
            $total_tipo = $res[$i]['tipo'];
            $total_data_pagar = $res[$i]['data_pgto'];
            $data_venc = $res[$i]['data_venc'];
            $valor = $res[$i]['valor'];
            $forma_pagamentos = $res[$i]['forma_pagamentos'];
            $horario = $res[$i]['horario'];


            $total_data_pagarF = implode('/', array_reverse(explode('-', $total_data_pagar)));
            $data_vencF = implode('/', array_reverse(explode('-', $data_venc)));

            $valorF = number_format($valor, 2, ',', '.');


            //Dinheiro
            $query2 = $pdo->query("SELECT * FROM  receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Dinheiro'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_receber_dinheiro += $res2[$i]['valor'];
            }
            $total_receber_dinheiroF = number_format($total_receber_dinheiro, 2, ',', '.');


            //Pix
            $query2 = $pdo->query("SELECT * FROM  receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Pix'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_receber_pix += $res2[$i]['valor'];
            }
            $total_receber_pixF = number_format($total_receber_pix, 2, ',', '.');


            //Cartão de Débito
            $query2 = $pdo->query("SELECT * FROM  receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Cartão de Débito'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_receber_debito += $res2[$i]['valor'];
            }
            $total_receber_debitoF = number_format($total_receber_debito, 2, ',', '.');


            //Cartão de Crédito
            $query2 = $pdo->query("SELECT * FROM  receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Cartão de Crédito'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_receber_credito += $res2[$i]['valor'];
            }
            $total_receber_creditoF = number_format($total_receber_credito, 2, ',', '.');

            //Cheque
            $query2 = $pdo->query("SELECT * FROM  receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and forma_pagamentos = 'Cheque'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $total_receber_cheque += $res2[$i]['valor'];
            }
            $total_receber_chequeF = number_format($total_receber_cheque, 2, ',', '.');


            $query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_baixa_total'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
            if ($total_reg2 > 0) {
                $nome_usuario_pgto = $res2[0]['nome'];
                $nome_usuario_pgto = mb_convert_case($nome_usuario_pgto, MB_CASE_TITLE, "UTF-8");
            } else {
                $nome_usuario_pgto = 'Nenhum!';
            }

            echo <<<HTML
<tr class="">
<td>{$total_descricao}</td>
<td>{$total_tipo}</td>
<td>{$data_vencF}</td>
<td>{$total_data_pagarF}</td>
<td>{$horario}</td>
<td>{$nome_usuario_pgto}</td>
<td>{$total_pago}</td>
<td>R$: {$valorF}</td>
<td>{$forma_pagamentos}</td>
<td>
		
</td>
</tr>
HTML;
        }

        echo <<<HTML
</tbody>
</table>
<br>	
<div align="right" style="margin-right:20px;" class="font-rodape text-success">Total Dinheiro: <span class="font-rodape">R$ {$total_receber_dinheiroF}</span> </div>
<div align="right" style="margin-right:20px;" class="font-rodape text-warning">Total Pix: <span class="font-rodape">R$ {$total_receber_pixF}</span> </div>
<div align="right" style="margin-right:20px;" class="font-rodape text-primary">Total Cartão de Débito: <span class="font-rodape">R$ {$total_receber_debitoF}</span> </div>
<div align="right" style="margin-right:20px;" class="font-rodape text-dark">Total Cartão de Crédito: <span class="font-rodape">R$ {$total_receber_creditoF}</span> </div>
<div align="right" style="margin-right:20px;" class="font-rodape text-success">Total Cheque: <span class="font-rodape">R$ {$total_receber_chequeF}</span> </div>

<br>
</small>
HTML;
    }

    ?>
    <div class="footer" align="center">
        <span style="font-size:10px;"><?php echo $nome_sistema ?> Whatsapp:
            <?php echo $whatsapp_sistema ?></span>
    </div>

</body>

</html>
