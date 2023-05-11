<?php 
require_once("../../../conexao.php");
@session_start();
$usuario = @$_SESSION['id'];


$funcionario = @$_POST['funcionario'];
$data = @$_POST['data'];

if($data == ""){
	$data = date('Y-m-d');
}

if($funcionario == ""){
	echo '<small>Selecione um Funcionário!</small>';
	exit();
}



echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM agendamentos where funcionario = '$funcionario' and data = '$data' ORDER BY hora asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$funcionario = $res[$i]['funcionario'];
$cliente = $res[$i]['cliente'];
$hora = $res[$i]['hora'];
$data = $res[$i]['data'];
$usuario = $res[$i]['usuario'];
$data_lanc = $res[$i]['data_lanc'];
$obs = $res[$i]['obs'];
$status = $res[$i]['status'];
$servico = $res[$i]['servico'];
$status_agendamento = $res[$i]['status_agendamento'];
$justificativa = $res[$i]['justificativa'];






$obs = mb_convert_case($obs, MB_CASE_TITLE, "UTF-8");
$funcionario = mb_convert_case($funcionario, MB_CASE_TITLE, "UTF-8");
$servico = mb_convert_case($servico, MB_CASE_TITLE, "UTF-8");


$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));



if($status == 'Concluído'){		
	$classe_linha = '';
}else{		
	$classe_linha = 'text-muted';
}



if($status == 'Agendado'){
	$imagem = 'icone-relogio1.png';
	$classe_status = '';	
}else{
	$imagem = 'icone-relogio-verde1.png';
	$classe_status = 'ocultar';
}



$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu = $res2[0]['nome'];
	$funciona_apelido = $res2[0]['apelido'];
	$nome_especializacao = $res2[0]['especialidade'];
}else{
	$nome_usu = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM registros where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu = $res2[0]['nome'];
	$funciona_apelido = $res2[0]['apelido'];
	$nome_especializacao = $res2[0]['especialidade'];
}else{
	$nome_usu = 'Sem Usuário';
}



$query2 = $pdo->query("SELECT * FROM servicos where id = '$servico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_serv = $res2[0]['nome'];
	$valor_serv = $res2[0]['valor'];
	$segun_valor_serv = $res2[0]['segun_valor_serv'];
}else{
	$nome_serv = 'Não Lançado';
	$valor_serv = '';
}

/* $query2 = $pdo->query("SELECT * FROM conf_agendamento where id = '$id' ");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	
	$nome_confirmacao = $res2[0]['nome'];

} */



$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];
	$cliente_apelido = $res2[0]['apelido'];
	$total_cartoes = $res2[0]['cartoes'];
	$telefone = $res2[0]['telefone'];
	$nome_cliente = mb_convert_case($nome_cliente, MB_CASE_TITLE, "UTF-8");
}else{
	$nome_cliente = 'Sem Cliente';
	$apelido = 'Sem Apelido';
	$total_cartoes = 0;
	$telefone = 'Sem Telefone';
}

if($total_cartoes >= $quantidade_cartoes and $status == 'Agendado'){
	$ocultar_cartoes = '';
}else{
	$ocultar_cartoes = 'ocultar';
}




if($status == 'Concluído'){
	$classe_cor_whats = 'verde';
}else{
	$classe_cor_whats = 'text-danger';
}


if($cliente_apelido = $res2[0]['apelido']){
	
}else{
	$cliente_apelido = $res2[0]['nome'];
}



$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);


//retirar aspas do texto do obs
$obs = str_replace('"', "**", $obs);

echo <<<HTML
			<div class="col-xs-12 col-md-4 widget cardTarefas">
        		<div class="r3_counter_box">     		
        		
        		

				<li class="dropdown head-dpdn2" style="list-style-type: none;">
				<a href="#" onclick="excluir('{$id}', '{$horaF}', '{$justificativa}')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		        <button type="button" class="close" title="Excluir agendamento" style="margin-top: -10px">
					<span aria-hidden="true"><big>&times;</big></span>
				</button>
				</a>

	<!-- 	<ul class="dropdown-menu" style="margin-left:-30px;">
		<li>
		<div class="notification_desc2">
		<p>Se o agendamento já estiver confirmado, apague o mesmo procedimento em <span class="texto-agend">Serviços, Comisssões,</span> caso contrário apague apenas aqui!!<br><br>Confirmar Exclusão? <a href="#" onclick="confirmarExclusao('{$id}', '{$horaF}', '{$justificativa}')"><span class="btn btn-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul> -->
		</li>



		<div class="row">
        		<div class="col-md-3">
        			 <img class="icon-rounded-vermelho" src="img/{$imagem}" width="45px" height="45px">
        		</div>
        		<div class="col-md-9">
        			<h5><strong>{$horaF}</strong> <a href="#" onclick="fecharServico('{$id}', '{$cliente}', '{$servico}', '{$valor_serv}', '{$funcionario}','{$nome_serv}')" title="Finalizar Serviço" class="{$classe_status}"> <img class="icon-rounded-vermelho" src="img/checked-box.png" width="25px" height="25px"></a></h5>
					      			
        		</div>
        		</div>
				


				
        		
        					
        		<hr style="margin-top:-2px; margin-bottom: 3px">                    
                    <div class="stats esc" align="center">

					<span>
                      
                        <small> <span class="{$ocultar_cartoes}" style=""><img class="icon-rounded-vermelho" src="img/consulta_online.png" width="30px" height="30px"></span> {$nome_cliente}<br>
						<span style="color:#337ab7; font-size:14px;font-weight: 600;">{$status_agendamento}</span><br>{$obs}<br>  
		                <big><a href="http://api.whatsapp.com/send?1=pt_BR&phone=$whats&text=  Olá, 
						{$cliente_apelido}, %0AEstou passando para avisar que você tem *{$nome_serv}*.*{$funciona_apelido}* na *{$dataF}* ás *{$horaF}* aqui na *Clinica Única* localizado na Av. Oito de Novembro, 918 - Centro, Jaguaribe - CE, 63475-000. Peço a gentileza de chegar 10 minutos antes para preencher sua ficha e realizar alguns procedimentos antes. Ah, lembre de trazer seu cartão de saúde, Identidade com foto.
						 %0APodemos confirmar? %0A*1.- Sim*  %0A*2.- Não, preciso reagendar* %0A*3.- Não poderei comparecer* "target="_blank" title="Abrir Whatsapp" ><i class="fa fa-whatsapp {$classe_cor_whats}"></i></a></big> {$telefone} <br> <i><span style="color:#ffffff; background-color:#337ab7; padding:5px 15px; text-align: center; display: table-cell; vertical-align: middle; border-radius: 4px;">{$nome_serv}  R$: {$valor_serv} </span></i>
					</small></span>
                      <!-- <span>
                      
                        <small> <span class="{$ocultar_cartoes}" style=""><img class="icon-rounded-vermelho" src="img/consulta_online.png" width="30px" height="30px"></span> {$nome_cliente}<br>
						<span style="color:#337ab7; font-size:14px;font-weight: 600;">{$status_agendamento}</span><br>{$obs}<br>  
		                <big><a href="http://api.whatsapp.com/send?1=pt_BR&phone=$whats&text=*Clinica Única*  %0AOlá, *{$cliente_apelido}*,     %0AEstou entrando em contato para confirmar sua presença na consulta ou exame de *'{$nome_serv}'* marcada para o dia *{$dataF}* ás *{$hora}* %0Aaqui na Clínica Única com o Dr(A) *{$funciona_apelido}*, {$nome_especializacao}*. %0APodemos confirmar? %0A*1.- Sim*  %0A*2.- Não, preciso reagendar* %0A*3.- Não poderei comparecer* "target="_blank" title="Abrir Whatsapp" ><i class="fa fa-whatsapp {$classe_cor_whats}"></i></a></big> {$telefone} <br> <i><span style="color:#ffffff; background-color:#337ab7; padding:5px 15px; text-align: center; display: table-cell; vertical-align: middle; border-radius: 4px;">{$nome_serv}  R$: {$valor_serv} </span></i>
					
						
					</small></span> -->

					<!-- *'{$nome_serv}'*   %0AEspecialista * -->

					<div class="col-md-12">
        			<h5><small>Confirmar Agenda</small> <a href="#" onclick="confirmarConsulta('{$id}',
					'{$status_agendamento}')" title="Confirmar Agenda" class="{$classe_status}"> <img class="icon-rounded-vermelho" src="img/consulta_confirma.png" width="25px" height="25px"></a></h5>      			
        		    </div>

					<div class="col-md-12">
        			<button class="btn btn-success btn-sm" type="submit" name="enviar_mensagem" id="botao-whatsapp">Enviar</button>     			
        		    </div>

                    </div>
                    
                </div>
        	</div>

			
HTML;
}

}else{
	echo 'Nenhum horário para essa Data!';
}

?>

<?php
// Adicione o seu token aqui
$token = "UnJybfP645d229c39049";

// Adicione o número para enviar a mensagem
$numero = "55" . preg_replace('/[^\d]/', '', $telefone);


// Capture o evento de clique no botão
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar_mensagem'])) {
    // Adicione os campos que deseja enviar na mensagem
    $nome_cliente = $_POST["nome_cliente"];
    $nome_serv = $_POST["nome_serv"];
    $valor_serv = $_POST["valor_serv"];

    // Crie a mensagem que será enviada
    $mensagem =
        "Olá, meu nome é " . $nome_cliente . ". Gostaria de agendar o serviço de " . $nome_serv . " no valor de R$ " . $valor_serv . ".";

    // Envie a mensagem via API
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.wmchatty.online/api/messages/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode(array(
            "number" => $numero,
            "body" => $mensagem
        )),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "X_TOKEN: " . $token
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "Não foi possível enviar a mensagem. Tente novamente mais tarde.";
    } else {
        echo "Mensagem enviada com sucesso!";
    }
}
?>

<!-- Envio de Mensagem API -->
<!-- <script>
// Adicione o seu token aqui
const token = "UnJybfP645d229c39049";

// Adicione o número para enviar a mensagem
const numero = "55<?php echo preg_replace('/[^\d]/', '', $telefone); ?>";

// Capture o evento de clique no botão
document.getElementById("botao-whatsapp").addEventListener("click", function() {
    // Adicione os campos que deseja enviar na mensagem
    const nome_cliente = "<?php echo $nome_cliente; ?>";
    const nome_serv = "<?php echo $nome_serv; ?>";
    const valor_serv = "<?php echo $valor_serv; ?>";

    // Crie a mensagem que será enviada
    const mensagem =
        `Olá, meu nome é ${nome_cliente}. Gostaria de confirmar o serviço de ${nome_serv} no valor de R$ ${valor_serv}.`;

    // Envie a mensagem via API
    fetch("https://api.wmchatty.online/api/messages/send", {
            method: "POST",
            headers: {
                "X_TOKEN": token,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "number": numero,
                "body": mensagem
            })
        })
        .then(response => {
            console.log(response);
            alert("Mensagem enviada com sucesso!");
        })
        .catch(error => {
            console.error(error);
            alert("Não foi possível enviar a mensagem. Tente novamente mais tarde.");
        });
});
</script> -->





<script type="text/javascript">
function fecharServico(id, aluno, servico, valor_servico, funcionario, nome_serv) {

    $('#id_agd').val(id);
    $('#cliente_agd').val(aluno);
    $('#servico_agd').val(servico);
    $('#valor_serv_agd').val(valor_servico);
    $('#funcionario_agd').val(funcionario).change();
    $('#titulo_servico').text(nome_serv);
    $('#descricao_serv_agd').val(nome_serv);

    $('#modalServico').modal('show');
}
</script>

<!-- <script type="text/javascript">
function confirmarConsulta(id, cliente, servico, valor_servico, funcionario, nome_serv, status_agendamento) {

    $('#id_agd').val(id);
    $('#cliente_agd').val(cliente);
    $('#servico_agd').val(servico);
    $('#valor_serv_agd').val(valor_servico);
    $('#status_agendamento').val(status_agendamento).change();
    $('#titulo_consulta').text(nome_serv);
    $('#descricao_serv_agd').val(nome_serv);

    $('#modalConfirmarConsulta').modal('show');
}
</script> -->

<script type="text/javascript">
function confirmarConsulta(id, status_agendamento) {

    $('#id_consulta').val(id);
    $('#status_agendamento').val(status_agendamento).change();


    $('#modalConfirmarConsulta').modal('show');
}
</script>


<script type="text/javascript">
function excluir(id, horaF, justificativa) {
    $('#id_justificativa').val(id);
    $('#justificativa').val(justificativa);

    var modal = $('#modalJustificativa');
    modal.modal('show');
}
</script>
