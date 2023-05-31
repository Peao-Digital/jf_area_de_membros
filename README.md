<html>
  <head></head>
  <body>
    <div>
      <h2>Área de membros da João Financeira</h2>
      <br>
      <h3><b>Instalação</b></h3>
      <p>
        Projeto de integração de dados do software Ticto para a base interna do proprietário e acesso de clientes sobre os produtos comprados.<br>
      </p>
      <h3><b>Instalação</b></h3>
      <ul>
        <li>Executar o comando composer install</li>
        <li>
          Copiar o arquivo .env.example para .env e ajustar as informações de acesso:
          <ul>
            <li>DEBUG (0 = Produção | 1 = Desenvolvimento)</li>
            <li>DB_HOST (Host do banco de dados | IP)</li>
            <li>DB_USER (Usuário do banco de dados)</li>
            <li>DB_PASS (Senha de acesso ao banco de dados)</li>
            <li>DB_DATABASE (Nome da base do banco)</li>
            <li>DB_ENGINE (Qual o banco de dados utilizado, Ex. "mysql")</li>
            <li>BASE_PATH (Se possuir um dominio deixar vazio "", senão informar o caminho até a pasta public, Ex. "/jf_area_de_membros/public")</li>
            <li>TOKENS_TICTO (Tokens do webhook do ticto, separados por virgula, Ex. "432jfdsd524k3, sdfs2fsdfds434,s354fsdfs324")</li>
          </ul>
        </li>
        <li>Executar o arquivo db.sql na base de dados escolhida</li>
      </ul>
      <h3><b>Fluxo do programa</b></h3>
      <ul>
        <li>Página inicial (/index): Tela com o campo de cpf\cnpj</li>
        <li>Página de produtos (/produtos): Tela de exibição dos produtos cadastrados e liberados para o cliente que acessou a página anterior</li>
        <li>Rota de consulta de produtos (/produtos/consultar?cliente=XXXX): Rota que retorna em formato JSON os dados de produtos do cliente</li>
        <li>Todas as rotas com exceção da página inicial necessitam dos parametros de CSRF que existem na página (csrf_name, csrf_value)</li>
      </ul>
      <h3><b>Base de dados</b></h3>
      <ul>
        <li> <b>ticto_cliente</b> <br>
          Tabela de clientes. Irá gravar o cliente uma vez apenas, contendo informações de endereço e contato
        </li>
        <li> <b>ticto_ordem</b> <br>
          Tabela das ordens, é utilizada para como referência para as outras tabelas
        </li>
        <li> <b>ticto_cliente_ordem</b> <br>
          Tabela de vinculo entre ordem e cliente
        </li>
        <li> <b>ticto_item</b> <br>
          Tabela do produto comprado por ordem
        </li>
        <li> <b>ticto_logs</b> <br>
          Tabela para gravação de erros, tais como: json ilegível, ordem repetida ou erro na gravação das tabelas descritas acima
        </li>
      </ul>
      <h3><b>Autores</b></h3>
      <a href="https://sunsetsoftware.com.br" target="_blank">Sunset Software</a> <br>
    </div>
  </body>
</html>