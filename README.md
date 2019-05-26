# PicPay PHP Simple

Simple PHP para a API de E-Commerce do PicPay

### Efetuando Pagamento (payment.php)
```php
<?php
 require_once 'src/paymentPicPay.php';
 $picpay = new PicPay;
 
  //Dados do produto
 
  // Número randomico + ID do produto
   $prod['id']    = rand(1000,99999).159;			
   $prod['nome']  = "Trono de ferro";
   $prod['valor'] = 100.00;
   
   // Dados do cliente
   $cli['nome']      = "Daenerys";
   $cli['sobreNome'] = "Targaryen";
   $cli['cpf']       = "000.000.000-00";
   $cli['email']     = "email@provedor.com";
   $cli['telefone']  = "11999999999";
   
   $produto = (object)$prod;
   $cliente = (object)$cli;
   
   $payment = $picpay->requestPayment($produto,$cliente);
  
	if(isset($payment->message)):
		echo $payment->message;
	else:
 	   $link   = $payment->paymentUrl;
	   $qrCode = $payment->qrcode->base64;
	 
	   echo '<a href="'.$link.'">Pagar com PicPay</a>';
	   echo '<br />';
	   echo '<img src="'.$qrCode.'" />';
	   
    endif;
 ?>
```

### Recebendo Notificação do PicPay (notification.php)
```php
<?php
  require_once 'src/paymentPicPay.php'; 
  $picpay = new PicPay;
  
  // função que verifica a requisição do PicPay
  $notification = $picpay->notificationPayment();
  
	  if($notification){
		  
		  $status	   = $notification->status;
		  $authorizationId = $notification->authorizationId;
		  $referenceId     = $notification->referenceId;
		  
		  
		  /* -- Tratar dados -- */
	  }
 ?>
```
#### A função notificationPayment retorna com os seguintes dados:
- referenceId (Referencia do pedido no seu sistema)
- status      (Confira as respostas de status na documentação do picpay)
- authorizationId (Usado para estornar o pedido)




Documentação PicPay API: https://ecommerce.picpay.com/doc/
