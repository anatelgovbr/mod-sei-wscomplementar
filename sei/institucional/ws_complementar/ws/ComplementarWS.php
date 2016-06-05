<?
/**
 * ANATEL
 *
 * 22/04/2016 - criado por Marcus Dionisio - ORLE
 *
 */

require_once dirname(__FILE__).'/../../../SEI.php';


class ComplementarWS extends InfraWS {

  public function getObjInfraLog(){
		return LogSEI::getInstance();
  }

  public function consultarUsuarioExterno($SiglaSistema, $IdentificacaoServico, $Email, $Cpf = "") {
  	try {
  	  		$InfraException = new InfraException();
  			
  	    // Valida E-mail.
  	  	if (! InfraUtil::validarEmail($Email)) {
  	  		$InfraException->lancarValidacao('E-mail inválido.');
  	  	}
  	  		 
  		// Valida CPF se informado.
  		if (strlen(trim($Cpf)) > 0 && ! InfraUtil::validarCpf($Cpf)) {
  			$InfraException->lancarValidacao('Número de CPF inválido.');
  		}
  			
  		InfraDebug::getInstance()->setBolLigado(false);
  		InfraDebug::getInstance()->setBolDebugInfra(false);
  		InfraDebug::getInstance()->limpar();
  			
  		SessaoSEI::getInstance(false);
  			
  		$objServicoDTO = self::obterServico($SiglaSistema, $IdentificacaoServico);
  			
  		$this->validarAcessoAutorizado(explode(',', str_replace(' ', '', $objServicoDTO->getStrServidor())));
  			
  		$UsuarioExternoDTO = new UsuarioExternoDTO();
  		$UsuarioExternoRN = new UsuarioExternoRN();
  			
  		$UsuarioExternoDTO = $UsuarioExternoRN->consultarExterno($Email);
  			
  		// Confirma se o CPF informado é o mesmo do cadastro.
  		if (strlen(trim($Cpf)) > 0 && (InfraUtil::formatarCpf($UsuarioExternoDTO->getDblCpf()) !== InfraUtil::formatarCpf($Cpf))) {
  			$InfraException->lancarValidacao('CPF informado não corresponde ao registrado no cadastro do Usuário Externo no SEI.');
  		}
  			
  		// Usuário Externo Liberado = L, Pendente = P
  		switch ($UsuarioExternoDTO->getStrStaTipo()) {
  			case UsuarioRN::$TU_EXTERNO_PENDENTE :
  				$UsuarioExternoDTO->setStrStaTipo('P');
  				break;
  
  			case UsuarioRN::$TU_EXTERNO :
  				$UsuarioExternoDTO->setStrStaTipo('L');
  				break;
  
  			default :
  				$InfraException->lancarValidacao('Erro ao consultar o cadastro do Usuário Externo no SEI.');
  				break;
  		}
  
  
  		$ret = array ();
  		$ret[] = (object) array(
  				'IdUsuario' => $UsuarioExternoDTO->getNumIdUsuario(),
  				'E-mail' => $UsuarioExternoDTO->getStrSigla(),
  				'Nome' => $UsuarioExternoDTO->getStrNome(),
  				'Cpf' => InfraUtil::formatarCpf($UsuarioExternoDTO->getDblCpf()),
  				'SituacaoAtivo' => $UsuarioExternoDTO->getStrSinAtivo(),
  				'LiberacaoCadastro' => $UsuarioExternoDTO->getStrStaTipo(),
  				'Rg' => $UsuarioExternoDTO->getDblRgContato(),
  				'OrgaoExpedidor' => $UsuarioExternoDTO->getStrOrgaoExpedidorContato(),
  				'Telefone' => $UsuarioExternoDTO->getStrTelefoneContato(),
  				'Endereco' => $UsuarioExternoDTO->getStrEnderecoContato(),
  				'Bairro' => $UsuarioExternoDTO->getStrBairroContato(),
  				'SiglaUf' => $UsuarioExternoDTO->getStrSiglaEstadoContato(),
  				'NomeCidade' => $UsuarioExternoDTO->getStrNomeCidadeContato(),
  				'Cep' => $UsuarioExternoDTO->getStrCepContato(),
  				'DataCadastro' => $UsuarioExternoDTO->getDthDataCadastroContato());
  
  		return $ret;
  
  	} catch ( Exception $e ) {
  		$this->processarExcecao ( $e );
  	}
  }

  private function obterServico($SiglaSistema, $IdentificacaoServico){
		
	  $objUsuarioDTO = new UsuarioDTO();
	  $objUsuarioDTO->retNumIdUsuario();
	  $objUsuarioDTO->setStrSigla($SiglaSistema);
	  $objUsuarioDTO->setStrStaTipo(UsuarioRN::$TU_SISTEMA);
	  
	  $objUsuarioRN = new UsuarioRN();
	  $objUsuarioDTO = $objUsuarioRN->consultarRN0489($objUsuarioDTO);
	  
	  if ($objUsuarioDTO==null){
	    throw new InfraException('Sistema ['.$SiglaSistema.'] não encontrado.');
	  }
	  
	  $objServicoDTO = new ServicoDTO();
	  $objServicoDTO->retNumIdServico();
	  $objServicoDTO->retStrIdentificacao();
	  $objServicoDTO->retStrSiglaUsuario();
		$objServicoDTO->retNumIdUsuario();
		$objServicoDTO->retStrServidor();
		$objServicoDTO->retStrSinLinkExterno();
		$objServicoDTO->retNumIdContatoUsuario();
		$objServicoDTO->setNumIdUsuario($objUsuarioDTO->getNumIdUsuario());
		$objServicoDTO->setStrIdentificacao($IdentificacaoServico);
			
		$objServicoRN = new ServicoRN();
		$objServicoDTO = $objServicoRN->consultar($objServicoDTO); 
			
		if ($objServicoDTO==null){
			throw new InfraException('Serviço ['.$IdentificacaoServico.'] do sistema ['.$SiglaSistema.'] não encontrado.');
		}
			
		return $objServicoDTO;
	}
}

$servidorSoap = new SoapServer("wscomplementar.wsdl",array('encoding'=>'ISO-8859-1'));

$servidorSoap->setClass("ComplementarWS");

//Só processa se acessado via POST
if ($_SERVER['REQUEST_METHOD']=='POST') {
	$servidorSoap->handle();
}
?>