<?
/**
 * ANATEL
 *
 * 22/04/2016 - criado por Marcus Dionisio - ORLE
 *
 */

require_once dirname(__FILE__).'/../../../SEI.php';

class UsuarioExternoRN extends InfraRN {

	public function __construct(){
		parent::__construct();
	}
	
	protected function inicializarObjInfraIBanco(){
		return BancoSEI::getInstance();
	}
	
	protected function consultarUsuarioExterno(UsuarioExternoDTO  $objUsuarioExternoDTO){
		try {
	
			//Valida Permissao
			SessaoSEI::getInstance()->validarAuditarPermissao('usuario_externo_consultar',__METHOD__,$objUsuarioExternoDTO);
	
			$objUsuarioBD = new UsuarioBD($this->getObjInfraIBanco());
			$ret = $objUsuarioBD->consultar($objUsuarioExternoDTO);
	
			return $ret;
		}catch(Exception $e){
			throw new InfraException('Erro consultando Usu�rio Externo.',$e);
		}
	}
	
	public function consultarExternoControlado($Sigla){
		try {
			$objInfraException = new InfraException();
	
			$objUsuarioExternoDTO = new UsuarioExternoDTO();
				
			//campos que ser�o retornados
			$objUsuarioExternoDTO->retNumIdUsuario();
			$objUsuarioExternoDTO->retStrSigla();
			$objUsuarioExternoDTO->retStrNome();
			$objUsuarioExternoDTO->retDblCpf();
			$objUsuarioExternoDTO->retStrSinAtivo();
			$objUsuarioExternoDTO->retStrStaTipo();
			//$objUsuarioExternoDTO->retNumIdContato();
				
			$objUsuarioExternoDTO->retDblRgContato();
			$objUsuarioExternoDTO->retStrOrgaoExpedidorContato();
			$objUsuarioExternoDTO->retStrTelefoneContato();
			$objUsuarioExternoDTO->retStrEnderecoContato();
			$objUsuarioExternoDTO->retStrBairroContato();
			$objUsuarioExternoDTO->retStrSiglaEstadoContato();
			$objUsuarioExternoDTO->retStrNomeCidadeContato();
			$objUsuarioExternoDTO->retStrCepContato();
			$objUsuarioExternoDTO->retDthDataCadastroContato();
				
			//Par�metros para consulta
			$objUsuarioExternoDTO->setStrSigla($Sigla, InfraDTO::$OPER_IGUAL);
	
			$objUsuarioExternoDTO = self::consultarUsuarioExterno($objUsuarioExternoDTO);
				
			if ($objUsuarioExternoDTO==null) {
				$objInfraException->lancarValidacao('N�o existe cadastro de Usu�rio Externo no SEI com o e-mail informado.');
			}
	
			return $objUsuarioExternoDTO;
			 
		} catch(Exception $e){
			throw new InfraException('Erro ao consultar cadastro de Usu�rio Externo no SEI.',$e);
		}
	}
}
?>