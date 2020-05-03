<?
class WScomplementarIntegracao extends SeiIntegracao {
	
	public function __construct(){
	}
	
	public function getNome(){
		return 'Webservice Complementar';
	}
	
	public function getVersao() {
		return '1.3.0';
	}
	
	public function getInstituicao(){
		return 'ANATEL (Projeto Colaborativo no Portal do SPB)';
	}
	
	public function inicializar($strVersaoSEI){	
	}
	
	public function processarControladorWebServices($strServico){
		
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