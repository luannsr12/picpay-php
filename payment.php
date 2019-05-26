<?php
  
  /* Simples integração com PicPay
   * Arquivo de CheckOut
   * @author: Script Mundo
   */
  
   /* Acesse a documentação do PicPay para mais informações
    * Para cada requisição o PicPay exige um IDReference diferente
    * Na class PicPay o IDReference recebe o id do produto
	* portanto toda vez que fizer a requisição não se esqueça de alterar o id do produto
	*/
	
	
  // class PicPay
  require_once 'src/paymentPicPay.php';
  
  $picpay = new PicPay;
  
  
  
  // Dados do produto
   $prod['id']    = rand(1000,99999).159;			
   $prod['nome']  = "Blusa Adidas";
   $prod['valor'] = 35.50;
   
   // Dados do cliente
   $cli['nome']      = "João";
   $cli['sobreNome'] = "Das Neves";
   $cli['cpf']		 = "000.000.000-00";
   $cli['email']	 = "email@provedor.com";
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
