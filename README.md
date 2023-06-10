<html>
  <head></head>
  <body>
    <div>
      <h2>Área de membros da João Financeira</h2>
      <br>
      <h3><b>Instalação</b></h3>
      <p>
        Projeto de integração de dados do software Doppus para a base interna do proprietário e acesso de clientes sobre os produtos comprados.<br>
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
            <li>API_CLIENT_ID (ID DA API)</li>
            <li>API_CLIENT_SECRET (CHAVE SECRETA DO CLIENTE DA API)</li>
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
        <li> <b>api_cliente</b> <br>
          Tabela de clientes. Irá gravar o cliente apenas uma vez.
        </li>
        <li> <b>api_item</b> <br>
          Tabela dos itens. Irá gravar o item apenas uma vez.
        </li>
        <li> <b>api_transacao_item</b> <br>
          Tabela de vinculo entre cliente e item.
        </li>
      </ul>
      <h3><b>Autores</b></h3>
      <a href="https://sunsetsoftware.com.br" target="_blank">Sunset Software</a> <br>
    </div>
  </body>
</html>