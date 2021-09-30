# Para testar a API Use

- Postaman

Link:  <http://localhost:81/api/v1/listagem-search/aquiCOlequeOIdDoProduto>

## Inforamações Importantes

- Class VtexConnect foi refatorada para armazenar cache da requisição do EndPoint. Agora é feita uma única requisição a cada  1min na API.


- Criou-se um ProductModel


- Class ProductTrait foi criada para ser receber os dados da Vtex e fazer o cadastro desse produto consultado no banco. Desse modo na próxima consulta os dados virão do banco de dados e não da Vetex.


- Fez-se refaoração nas classes VtexSearchService para se adequar ao ProductTrait

![alt text](https://github.com/EloneSampaio/corebiz-gobeyond/blob/master/insigths.png?raw=true)
