<?
class WScomplementarIntegracao implements ISeiIntegracao {
	public function __construct(){
	}
	
	public function montarBotaoProcedimento(SeiIntegracaoDTO $objSeiIntegracaoDTO){
			
	}
	
	public function montarIconeProcedimento(SeiIntegracaoDTO $objSeiIntegracaoDTO){
		return array();
	}
	
	public function montarBotaoDocumento(SeiIntegracaoDTO $objSeiIntegracaoDTO){
		return array();
	}
	
	public function montarIconeDocumento(SeiIntegracaoDTO $objSeiIntegracaoDTO){
		return array();
	}
	
	public function excluirProcedimento(ProcedimentoDTO $objProcedimentoDTO){
	}
	
	public function atualizarConteudoDocumento(DocumentoDTO $objDocumentoDTO){
	}
	
	public function excluirDocumento(DocumentoDTO $objDocumentoDTO){
	}
	
	public function montarBotaoControleProcessos(){}
	
	public function montarIconeControleProcessos($arrObjProcedimentoDTO){}
	
	public function montarIconeAcompanhamentoEspecial($arrObjProcedimentoDTO){
		return null;
	}
}	
?>