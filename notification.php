<?php
	
  /* Simples integração com PicPay
   * Arquivo de Notificação
   * @author: Luan Alves
   */
   
   
  /* Este arquivo deve estar configurado em sua callback url
   * para o PicPay posso enviar as requisições aqui.
   * O picpay irá esperar uma resposta HTTP 200 do seu site
   * Acesse a documentação do PicPay para ver mais detalhes.
   * https://ecommerce.picpay.com/doc/
   */
  
  // class PicPay
  require_once 'src/paymentPicPay.php';
  
  $picpay = new PicPay;
  
  
  // função que verifica a requisição
  $notification = $picpay->notificationPayment();
  
	  if($notification){
		  
		  $status 	   	   = $notification->status;
		  $authorizationId = $notification->authorizationId;
		  $referenceId     = $notification->referenceId;
		  
		  
		  /* -- Tratar dados -- */
	  }
 
 ?>
