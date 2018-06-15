# Módulo Webservice Complementar do SEI

## Requisitos:
- SEI 3.0.0 instalado ou atualizado (verificar valor da constante de versão do SEI no arquivo /sei/web/SEI.php).

## Procedimentos para Instalação:

1. Carregar no servidor os arquivos do módulo localizados na pasta "/sei/web/modulos/ws_complementar".

2. Editar o arquivo "/sei/config/ConfiguracaoSEI.php", tomando o cuidado de usar editor que não altere o charset do arquivo, para adicionar a referência à classe de integração do módulo e seu caminho relativo dentro da pasta "/sei/web/modulos" na array 'Modulos' da chave 'SEI':

		'SEI' => array(
			'URL' => 'http://[Servidor_PHP]sei',
			'Producao' => false,
			'RepositorioArquivos' => '/var/sei/arquivos',
			'Modulos' => array('WScomplementarIntegracao' => 'ws_complementar',)
			),

3. O endereço do WSDL do módulo é o seguinte: http://[dominio_servidor]/sei/controlador_ws.php?servico=wscomplementar

4. Manual e demais orientações constam na Wiki do Projeto Principal: https://softwarepublico.gov.br/gitlab/anatel/mod-sei-wscomplementar/wikis/home

5. O projeto desse módulo é de desenvolvimento colaborativo, devendo seguir a metodologia definida, especialmente abrindo Issue antes de qualquer desenvolvimento. Link para o projeto principal: https://softwarepublico.gov.br/gitlab/anatel/mod-sei-wscomplementar