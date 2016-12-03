# Manual do Módulo de Webservice Complementar do SEI

 * Para instalar, acesse o arquivo "Leia-me.txt" que segue junto com o código do módulo.
 * Endereço do WSDL do módulo: http://[dominio_servidor]/sei/controlador_ws.php?servico=wscomplementar
 * Recomendado utilizar o [software SOAP-UI](http://sourceforge.net/projects/soapui/files/soapui/ Clique aqui para baixar) para testes do módulo.

## 1. Consultar Usuário Externo

### Método “consultarUsuarioExterno”:

| Parâmetros de Entrada |  |
| ---- | ---- |
| SiglaSistema | Valor informado no cadastro do sistema realizado no SEI. |
| IdentificacaoServico | Valor informado no cadastro do serviço realizado no SEI. |
| Email | Endereço de e-mail indicado pelo Usuário Externo em seu cadastro no SEI para fins de autenticação. Caso seja informado, tem que corresponder ao e-mail vinculado ao CPF indicado (se não corresponder retornará que “*E-mail informado não corresponde ao registrado no cadastro do Usuário Externo no SEI*”). |
| Cpf | CPF sem formatação e sem zeros à esquerda para consulta se existe cadastro correspondente como Usuário Externo no SEI. |

| Parâmetros de Saída |  |
| ---- | ---- |
| parametros | Uma lista de ocorrências da estrutura UsuarioExterno. |

| Observações |
| ---- |
| O usuário será listado sempre que indicar um CPF que conste na lista de Usuários Externos do SEI. Esta consulta não está vinculada à concessão de outras operações diretamente por meio do SEI (Administração > Sistemas) para o Sistema e Serviço indicados. O sistema cliente deverá verificar dois parâmetros da estrutura de dados de retorno para confirmar que o Usuário Externo de fato está com cadastro regular, se a “SituacaoAtivo” está “S” (ativo) e  se “LiberacaoCadastro” está “L” (liberado), pois se o cadastro estiver desativado (SituacaoAtivo=N) o usuário externo não conseguirá logar na tela de acesso externo mesmo que esteja liberado (LiberacaoCadastro=L). |

### Regras de Negócio:
 * Se a SiglaSistema e/ou IdentificacaoServico não forem válidos, o webservice retorna as mensagens padrão atuais a respeito.
 * Se o CPF informado não tiver cadastro como Usuário Externo no SEI o webservice retorna a mensagem “*Não existe cadastro de Usuário Externo no SEI com o CPF informado*”.
 * Se o CPF informado não for válido, ou seja, não passar na validação de sua estrutura (dígito verificador inválido), o webservice retorna a mensagem “*Número de CPF inválido*”.
 * Se o E-mail informado não passar na validação de formato (não pode ter espaços e tem que ter @), o webservice retorna a mensagem “*E-mail inválido*”.
 * Se o CPF informado for de Usuário Externo com cadastro localizado, mas, mesmo sendo opcional, o e-mail indicado em conjunto no chamado não corresponder ao cadastrado no SEI (quando quiser fazer dupla validação), o webservice retorna a mensagem “*E-mail informado não corresponde ao registrado no cadastro do Usuário Externo no SEI*”.
 * Demais regras devem ser implementadas pelo sistema cliente da integração, combinando os dados retornados, especialmente referente aos dados de “SituacaoAtivo” e “LiberacaoCadastro” conforme estrutura de dados “UsuarioExterno” abaixo especificada.

### Estrutura de Dados "UsuarioExterno":

| Dado | Descrição |
| ---- | ---- |
| IdUsuario | Id interno de identificação do usuário no SEI |
| Email | Endereço de e-mail utilizado pelo Usuário Externo para acesso à tela de Acesso Externo do SEI, indicado quando efetivou seu cadastro no SEI como Usuário Externo |
| Nome | Nome do Usuário Externo |
| Cpf | Número do CPF do Usuário Externo (sem formatação) |
| Rg | Número do RG |
| OrgaoExpedidor | Órgão Expedidor do RG |
| Telefone | Telefone |
| Endereco | Endereço |
| Bairro | Bairro |
| SiglaUf | Sigla da Unidade da Federação |
| NomeCidade | Nome da Cidade |
| Cep | CEP do endereço |
| DataCadastro | Data na qual o Usuário Externo efetivou o cadastro no SEI |
| SituacaoAtivo | Estado do cadastro do Usuário Externo (S=Ativado e N=Desativado, sendo que este estado do cadastro é independente de sua liberação, ou seja, mesmo liberado, se o cadastro estiver desativado o usuário não consegue mais ter acesso externo ao SEI) |
| LiberacaoCadastro | Estado da aprovação do cadastro do Usuário Externo (L=Liberado e P=Pendente) |