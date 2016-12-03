# Módulo Webservice Complementar do SEI

## Requisitos:
- SEI 2.6.0.A13 instalada (verificar valor da constante de versão do SEI no arquivo sei/SEI.php).

## Procedimentos para Instalação:

1. Carregar os arquivos do módulo localizados na pasta "/sei/institucional/ws_complementar".
2. Editar o arquivo "sei/ConfiguracaoSEI.php", tomando o cuidado de usar editor que não altere o charset do arquivo, para adicionar a referência e caminho até a pasta do módulo na chave 'Modulos' abaixo da chave 'SEI':

		'SEI' => array(
			'URL' => 'http://[Servidor_PHP]sei',
			'Producao' => false,
			'RepositorioArquivos' => '/var/sei/arquivos',
			'Modulos' => array(),
			),

		==> Adicionar a referência e caminho até a pasta do módulo na array da chave 'Modulos' indicada acima:
			
			'Modulos' => array('WScomplementar' => dirname(__FILE__).'/institucional/ws_complementar',),

3. O endereço do WSDL do módulo é o seguinte: http://[dominio_servidor]/sei/controlador_ws.php?servico=wscomplementar

4. Manual e demais orientações constam na Wiki do Projeto Principal: https://softwarepublico.gov.br/gitlab/anatel/mod-sei-wscomplementar/wikis/home

5. O projeto desse módulo é de desenvolvimento colaborativo, devendo seguir a metodologia definida, especialmente abrindo Issue antes de qualquer desenvolvimento. Link para o projeto principal: https://softwarepublico.gov.br/gitlab/anatel/mod-sei-wscomplementar