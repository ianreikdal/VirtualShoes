<?php
session_start();
include 'conexao.php';

$mensagem = "";

// Se o cliente finalizar a compra
if (isset($_POST['finalizar'])) {
    // sanitiza entradas
    $nome = $conn->real_escape_string($_POST['nome']);
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $metodo = isset($_POST['metodo_pagamento']) ? $_POST['metodo_pagamento'] : '';

    // valida básico
    if (empty($nome) || empty($endereco) || empty($metodo)) {
        $mensagem = "Preencha nome, endereço e selecione forma de pagamento.";
    } else if (empty($_SESSION['carrinho'])) {
        $mensagem = "Seu carrinho está vazio!";
    } else {
        // processa conforme método selecionado (simulado)
        if ($metodo === 'cartao') {
    // sanitiza / normaliza entradas do cartão
    $num = preg_replace('/\D/', '', $_POST['cc_number'] ?? '');
    $tit = $conn->real_escape_string(trim($_POST['cc_name'] ?? ''));
    $exp_raw = trim($_POST['cc_exp'] ?? '');
    // permite apenas MM/AA formatado
    $exp = preg_replace('/[^0-9\/]/', '', $exp_raw);
    $cvv = preg_replace('/\D/', '', $_POST['cc_cvv'] ?? '');

    // validações mais estritas
    $num_len = strlen($num);
    $cvv_valid = preg_match('/^\d{3,4}$/', $cvv);
    $exp_valid = preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $exp);

    if ($num_len < 13 || $num_len > 19 || !$cvv_valid || !$exp_valid || empty($tit)) {
        $mensagem = "Dados do cartão incompletos ou inválidos.";
    } else {
        // simula sucesso
        $mask = '**** **** **** ' . substr($num, -4);
        $mensagem = "Pagamento aprovado com cartão $mask. Pedido realizado com sucesso! Obrigado, $nome.";
        $_SESSION['carrinho'] = []; // limpa carrinho
    }
} else if ($metodo === 'pix') {
    // gera código PIX simulado
    $pix_code = strtoupper(substr(md5(time()), 0, 10));
    $mensagem = "Use a chave PIX para pagar: sua-chave@pix (código: $pix_code). Pedido registrado. Obrigado, $nome.";
    $_SESSION['carrinho'] = [];
} else if ($metodo === 'boleto') {
            // gera link/boleto simulado
            $boleto = 'boleto_' . time() . '.pdf';
            $mensagem = "Boleto gerado: <a href='#'>$boleto</a>. Pague até a data de vencimento. Pedido registrado. Obrigado, $nome.";
            $_SESSION['carrinho'] = [];
        } else {
            $mensagem = "Método de pagamento inválido.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="css/css1.css">
    <style>
        .payment-details { display: none; }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1><i class="fas fa-credit-card"></i> Checkout</h1>

    <?php if ($mensagem): ?>
        <div class="alert alert-info mt-3"><?php echo $mensagem; ?></div>
        <a href="index.php" class="btn btn-primary mt-3"><i class="fas fa-home"></i> Voltar para Loja</a>
    <?php else: ?>
        <form method="post" class="mt-3" id="checkoutForm">
            <div class="form-group">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="endereco">Endereço de entrega</label>
                <input type="text" id="endereco" name="endereco" class="form-control" required>
            </div>

            <h5 class="mt-3">Forma de pagamento</h5>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input metodo" type="radio" name="metodo_pagamento" id="met_cartao" value="cartao" required>
                    <label class="form-check-label" for="met_cartao">Cartão de Crédito</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input metodo" type="radio" name="metodo_pagamento" id="met_pix" value="pix" required>
                    <label class="form-check-label" for="met_pix">PIX</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input metodo" type="radio" name="metodo_pagamento" id="met_boleto" value="boleto" required>
                    <label class="form-check-label" for="met_boleto">Boleto Bancário</label>
                </div>
            </div>

            <div id="cartaoFields" class="payment-details">
                <h6>Dados do cartão</h6>
                <div class="form-group">
                    <label>Número do cartão</label>
                    <input
                        type="text"
                        name="cc_number"
                        class="form-control cc-number"
                        placeholder="0000 0000 0000 0000"
                        inputmode="numeric"
                        pattern="[0-9 ]{13,23}"     
                        maxlength="23"             
                        autocomplete="cc-number"
                        >
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nome no cartão</label>
                        <input
                            type="text"
                            name="cc_name"
                            class="form-control"
                            maxlength="50"
                            autocomplete="cc-name"
                        >
                    </div>
                    <div class="form-group col-md-3">
                        <label>Validade (MM/AA)</label>
                        <input
                            type="text"
                            name="cc_exp"
                            class="form-control cc-exp"
                            placeholder="MM/AA"
                            inputmode="numeric"
                            pattern="(0[1-9]|1[0-2])\/\d{2}"
                            maxlength="5"
                            autocomplete="cc-exp"
                        >
                    </div>
                    <div class="form-group col-md-3">
                        <label>CVV</label>
                        <input
                            type="text"
                            name="cc_cvv"
                            class="form-control cc-cvv"
                            placeholder="123"
                            inputmode="numeric"
                            pattern="\d{3,4}"
                            maxlength="4"
                            autocomplete="cc-csc"
                        >
                    </div>
                </div>
            </div>

            <div id="pixInfo" class="payment-details">
                <h6>PIX</h6>
                <p>Ao finalizar será exibida a chave PIX e um código para pagamento.</p>
            </div>

            <div id="boletoInfo" class="payment-details">
                <h6>Boleto</h6>
                <p>Ao finalizar será gerado um boleto para pagamento. Pague até a data de vencimento.</p>
            </div>

            <button type="submit" name="finalizar" class="btn btn-success mt-3">
                <i class="fas fa-check"></i> Finalizar Pedido
            </button>
        </form>
    <?php endif; ?>
</div>

<script>
    // mostra/oculta campos conforme método escolhido
    document.querySelectorAll('.metodo').forEach(function(el){
        el.addEventListener('change', function(){
            document.querySelectorAll('.payment-details').forEach(d => d.style.display = 'none');
            if (this.value === 'cartao') document.getElementById('cartaoFields').style.display = 'block';
            if (this.value === 'pix') document.getElementById('pixInfo').style.display = 'block';
            if (this.value === 'boleto') document.getElementById('boletoInfo').style.display = 'block';
        });
    });

    // opcional: esconde mensagem automaticamente após 3s (se existir)
    setTimeout(function(){
        var a = document.querySelector('.alert');
        if (a) a.style.display = 'none';
    }, 3000);

    // formatação e validação em tempo real (cliente)
    (function(){
        // número do cartão: apenas dígitos, max 19, agrupa em blocos de 4
        const ccNumber = document.querySelector('input[name="cc_number"]');
        if (ccNumber) {
            ccNumber.addEventListener('input', function(e){
                let v = this.value.replace(/\D/g,'').slice(0,19);
                // formata: 4 4 4 4 3 (se houver)
                this.value = v.replace(/(.{4})/g, '$1 ').trim();
            });
            // impede colar conteúdo com letras
            ccNumber.addEventListener('paste', function(e){
                e.preventDefault();
                const text = (e.clipboardData || window.clipboardData).getData('text');
                this.value = text.replace(/\D/g,'').slice(0,19).replace(/(.{4})/g,'$1 ').trim();
            });
        }

        // validade (MM/AA) -> insere barra automática
        const ccExp = document.querySelector('input[name="cc_exp"]');
        if (ccExp) {
            ccExp.addEventListener('input', function(){
                let v = this.value.replace(/\D/g,'').slice(0,4);
                if (v.length >= 3) v = v.slice(0,2) + '/' + v.slice(2);
                this.value = v;
            });
        }

        // CVV: apenas dígitos, max 4
        const ccCvv = document.querySelector('input[name="cc_cvv"]');
        if (ccCvv) {
            ccCvv.addEventListener('input', function(){
                this.value = this.value.replace(/\D/g,'').slice(0,4);
            });
        }

        // evita enviar formulário com campos inválidos pelo client-side
        const form = document.getElementById('checkoutForm');
        if (form) {
            form.addEventListener('submit', function(e){
                const metodo = document.querySelector('input[name="metodo_pagamento"]:checked');
                if (metodo && metodo.value === 'cartao') {
                    // força revalidação dos padrões HTML5
                    if (!form.reportValidity()) {
                        e.preventDefault();
                    }
                }
            });
        }
    })();
    // valida validade MM/AA e evita mensagem genérica do navegador
  (function(){
    const form = document.getElementById('checkoutForm');
    const ccExp = document.querySelector('input[name="cc_exp"]');

    function validaExp(valor){
      // aceita apenas MM/AA onde MM entre 01 e 12 e não expirado
      const m = valor.match(/^(0[1-9]|1[0-2])\/(\d{2})$/);
      if (!m) return { ok:false, msg: 'Use o formato MM/AA (ex: 08/25).' };

      const mes = parseInt(m[1], 10);
      const ano = 2000 + parseInt(m[2], 10);
      const hoje = new Date();
      // último dia do mês da validade
      const ultimoDia = new Date(ano, mes, 0, 23, 59, 59);
      if (ultimoDia < hoje) return { ok:false, msg: 'Cartão expirado.' };
      return { ok:true };
    }

    if (ccExp) {
      // formata enquanto digita (inserindo a barra)
      ccExp.addEventListener('input', function(){
        let v = this.value.replace(/\D/g,'').slice(0,4);
        if (v.length >= 3) v = v.slice(0,2) + '/' + v.slice(2);
        this.value = v;
        // limpa mensagem customizada ao digitar
        this.setCustomValidity('');
      });

      // valida ao perder o foco
      ccExp.addEventListener('blur', function(){
        const r = validaExp(this.value);
        this.setCustomValidity(r.ok ? '' : r.msg);
      });
    }

    if (form) {
      form.addEventListener('submit', function(e){
        const metodo = document.querySelector('input[name="metodo_pagamento"]:checked');
        if (metodo && metodo.value === 'cartao') {
          // valida campo de validade explicitamente
          if (ccExp) {
            const r = validaExp(ccExp.value);
            ccExp.setCustomValidity(r.ok ? '' : r.msg);
            if (!r.ok) {
              ccExp.reportValidity();
              e.preventDefault();
              return;
            }
          }
          // deixa o reportValidity padrão checar os outros patterns
          if (!form.reportValidity()) {
            e.preventDefault();
          }
        }
      });
    }
  })();
</script>
</body>
</html>