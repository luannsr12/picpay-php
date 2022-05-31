# PicPay PHP Simple

[![](https://img.shields.io/github/contributors/luannsr12/picpay-php.svg?style=flat-square)](https://github.com/luannsr12/picpay-php/)
[![](https://img.shields.io/github/issues/luannsr12/picpay-php.svg?style=flat-square)](https://github.com/luannsr12/picpay-php/issues)
[![](https://badges.pufler.dev/updated/luannsr12/picpay-php?v=1)](https://github.com/luannsr12/picpay-php)
[![](https://badges.pufler.dev/visits/luannsr12/picpay-php)](https://github.com/luannsr12/picpay-php)


### Efetuando Pagamento (payment.php)
#### Adicione seu `x-picpay-token` e `x-seller-token` | Clique [aqui](https://lojista.picpay.com/dashboard/ecommerce-token) para pegar as credenciais

```php
<?php
 require_once 'src/paymentPicPay.php';
 $picpay = new PicPay("x-picpay-token", "x-seller-token");
 
  //Dados do produto
 
   $prod['ref']    = rand(1000,99999);			
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
  $picpay = new PicPay("x-picpay-token", "x-seller-token");
  
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
