<?php

  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  class TesteController { 
    public function autenticar(Request $request, Response $response, $args = []) {
      $dados = [
        "success"=> true,
        "error"=> [],
        "return_type"=> 0,
        "message"=> "Access token successfully generated.",
        "data" => [
          "token"=> "b3d9217f-4eb7-6f1f-a9c7-99ef069faed0",
          "token_type"=> "Bearer",
          "expire_in"=> 3600
        ]
      ];

      $response->getBody()->write(json_encode($dados));
      return $response
        ->withHeader('content-type', 'application/json');
    }

    public function dados(Request $request, Response $response, $args = []) {
      $pagina = $request->getQueryParams()['page'];
      if ($pagina == 1) {
        $dados = [
          "success"=> true,
          "error"=> [],
          "return_type"=> 0,
          "message"=> "Transactions found.",
          "data"=> [
            [
              "transaction_code"=> "27536126",
              "registration_date"=> "2020-12-07 20:45:49",
              "customer"=> [
                "name"=> "Elton John",
                "doc_type"=> "CPF",
                "doc"=> "919.359.381-59",
                "email"=> "eltonjohn@gmail.com",
                "phone"=> "(48) 99123-4567"
              ],
              "address"=> [
                "zipcode"=> "88123-456",
                "address"=> "Rua dos Artistas",
                "number"=> "123",
                "neighborhood"=> "Centro",
                "city"=> "Florianópolis",
                "state"=> "SC"
              ],
              "items"=> [
                [
                  "code"=> "44293",
                  "description"=> "Curso de Guitarra",
                  "type"=> 2,
                  "type_text"=> "Produto digital/serviço",
                  "amount"=> 1,
                  "cost_price"=> 7.65,
                  "sale_price"=> 10.98
                ],
                [
                  "code"=> "24231",
                  "description"=> "Guitarra Fender",
                  "type"=> 1,
                  "type_text"=> "Produto físico",
                  "amount"=> 1,
                  "cost_price"=> 112.11,
                  "sale_price"=> 132.09
                ]
              ]
            ],
            [
              "transaction_code"=> "275361246445",
              "registration_date"=> "2020-12-07 20:45:49",
              "customer"=> [
                "name"=> "John Blues",
                "doc_type"=> "CPF",
                "doc"=> "423.359.381-59",
                "email"=> "eltonjohn@gmail.com",
                "phone"=> "(48) 99123-4567"
              ],
              "address"=> [
                "zipcode"=> "88123-456",
                "address"=> "Rua dos Artistas",
                "number"=> "123",
                "neighborhood"=> "Centro",
                "city"=> "Florianópolis",
                "state"=> "SC"
              ],
              "items"=> [
                [
                  "code"=> "44293",
                  "description"=> "Curso de Guitarra",
                  "type"=> 2,
                  "type_text"=> "Produto digital/serviço",
                  "amount"=> 1,
                  "cost_price"=> 7.65,
                  "sale_price"=> 10.98
                ]
              ]
            ]
          ]
        ];
      } else if($pagina == 2) {
        $dados = [
          "success"=> true,
          "error"=> [],
          "return_type"=> 0,
          "message"=> "Transactions found.",
          "data"=> [
            [
              "transaction_code"=> "275361547269",
              "registration_date"=> "2020-12-07 20:45:49",
              "customer"=> [
                "name"=> "Elton John",
                "doc_type"=> "CPF",
                "doc"=> "919.359.381-59",
                "email"=> "eltonjohn@gmail.com",
                "phone"=> "(48) 99123-4567"
              ],
              "address"=> [
                "zipcode"=> "88123-456",
                "address"=> "Rua dos Artistas",
                "number"=> "123",
                "neighborhood"=> "Centro",
                "city"=> "Florianópolis",
                "state"=> "SC"
              ],
              "items"=> [
                [
                  "code"=> "5654",
                  "description"=> "Curso de Guitarra 2",
                  "type"=> 2,
                  "type_text"=> "Produto digital/serviço",
                  "amount"=> 1,
                  "cost_price"=> 7.65,
                  "sale_price"=> 10.98
                ]
              ]
            ]
          ]
        ];
      } else {
        $dados = $dados = [
          "success"=> true,
          "error"=> [],
          "return_type"=> 0,
          "message"=> "Transactions found.",
          "data"=> []
        ];
      }

      $response->getBody()->write(json_encode($dados));
      return $response
        ->withHeader('content-type', 'application/json');
    }
  }