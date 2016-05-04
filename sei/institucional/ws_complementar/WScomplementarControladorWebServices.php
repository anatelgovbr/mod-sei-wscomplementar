<?php

  class WScomplementarControladorWebServices implements ISeiControladorWebServices{
  
  	public function processar($strServico){
  		 
  		$strArq = null;
  
  		switch ($strServico) {
  			 
  			case 'wscomplementar':
  				$strArq = 'wscomplementar.wsdl';
  				break;
  			
  			default:
  				break;
  		}
  
  		if ($strArq!=null){
  			$strArq = dirname(__FILE__).'/ws/'.$strArq;
  		}
  
  		return $strArq;
  	}
  }  
?>