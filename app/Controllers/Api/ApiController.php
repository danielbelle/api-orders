<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\ProductModel;
use Exception;
use Firebase\JWT\JWT;

class ApiController extends ResourceController
{
	// POST user method
	public function userRegister()
	{
		$rules = [
			"name" => "required",
			"email" => "required|valid_email|is_unique[users.email]",
			"password" => "required"
		];

		if (!$this->validate($rules)) {
			// error

            $response = [
                "cabecalho" => [
                    "status" => 500,
				    "mensagem" => $this->validator->getErrors(),
                ],
                "retorno" => []
            ];
		} else {
			// no error
			$user_obj = new UserModel();

			$data = [
				"name" => $this->request->getVar("name"),
				"email" => $this->request->getVar("email"),
				"password" => password_hash($this->request->getVar("password"), PASSWORD_DEFAULT)
			];

			if ($user_obj->insert($data)) {
				// success
				$response = [
                    "cabecalho" => [
                        "status" => 200,
                        "mensagem" => "Usuário já é registrado",
                    ],
					"retorno" => []
				];
			} else {
				// failed to insert
				$response = [
                    "cabecalho" => [
                        "status" => 500,
                        "mensagem" => "Falha ao registrar o usuário",
                    ],
					"retorno" => []
				];
			}
		}

		return $this->respondCreated($response);
	}

	// POST user method
	public function userLogin()
	{
		$rules = [
			"email" => "required|valid_email",
			"password" => "required"
		];

		if (!$this->validate($rules)) {
			// error
			$response = [
                "cabecalho" => [
                    "status" => 500,
                    "mensagem" => $this->validator->getErrors(),
				],
                "retorno" => []
            ];
		} else {
			// no error
			$email = $this->request->getVar("email");
			$password = $this->request->getVar("password");

			$user_obj = new UserModel();

			$userdata = $user_obj->where("email", $email)->first();

			if (!empty($userdata)) {
				// user exists

				if (password_verify($password, $userdata['password'])) {
					// user details matched

					$iat = time();
					$nbf = $iat + 5;  // não pode usar o token antes de
					$exp = $iat + 600; // token expira

					$payload = [
						"iat" => $iat,
						"nbf" => $nbf,
						"exp" => $exp,
						"userdata" => $userdata
					];

					$token = JWT::encode($payload, $this->getKey(),'HS256');

					$response = [
                        "cabecalho" => [
                            "status" => 200,
                            "mensagem" => "Usuário logado",
						],
                        "retorno" => [
							"token" => $token
						]
					];
				} else {
					// password didnt match
					$response = [
                        "cabecalho" => [
                            "status" => 500,
                            "mensagem" => "Senha incorreta",
                        ],
                        "retorno" => []
                    ];
				}
			} else {
				// user doesnot exists
				$response = [
                    "cabecalho" => [
                        "status" => 500,
                        "mensagem" => "Dados inválidos",
					],
                    "retorno" => []
                ];
			}
		}

		return $this->respondCreated($response);
	}

	public function getKey()
	{
		return "QWERTYASDFGH";
	}

	// GET user method
	public function userProfile()
	{
		$auth = $this->request->getHeader("Authorization");

		try {

			if (isset($auth)) {

				$token = $auth->getValue();

				$decoded_data = JWT::decode($token, $this->getKey(), array("HS256"));

				$response = [
                    "cabecalho" => [
                        "status" => 200,
                        "mensagem" => "Dados do usuário",
                    ],
					"retorno" => [
						"user" => $decoded_data,
						"id" => $decoded_data->userdata->id
					]
				];
			} else {

				$response = [
                    "cabecalho" => [
                        "status" => 500,
                        "mensagem" => "O usuário deve estar logado",
					],
                    "retorno" => []
                ];
			}
		} catch (Exception $ex) {

			$response = [
                "cabecalho" => [
                    "status" => 500,
                    "mensagem" => $ex->getMessage(),
				],
                "retorno" => []
            ];
		}

		return $this->respondCreated($response);
	}

	// POST product method
	public function createProduct()
	{
		$rules = [
			"title" => "required",
			"price" => "required"
		];

		if (!$this->validate($rules)) {
			// errors
			$response = [
                "cabecalho" => [
                    "status" => 500,
                    "mensagem" => $this->validator->getErrors(),
				],
                "retorno" => []
            ];
		} else {
			// no error
			$auth = $this->request->getHeader("Authorization");

			$token = $auth->getValue();

			$decoded_data = JWT::decode($token, $this->getKey(), array("HS256"));

			$user_id = $decoded_data->userdata->id;

			$product_obj = new ProductModel();

			$data = [
				"title" => $this->request->getVar("title"),
				"price" => $this->request->getVar("price")
			];

			if ($product_obj->insert($data)) {
				// data has been saved
				$response = [
                    "cabecalho" => [
                        "status" => 200,
                        "mensagem" => "Produto criado com sucesso",
                    ],
                    "retorno" => []
                ];
			} else {
				// failed to save
				$response = [
                    "cabecalho" => [
                        "status" => 500,
                        "mensagem" => "Falha ao criar produto",
					],
                    "retorno" => []
                ];
			}
		}

		return $this->respondCreated($response);
	}

	// GET product method
	public function listProducts()
	{
		try {

			$auth = $this->request->getHeader("Authorization");

			$token = $auth->getValue();

			$decoded_data = JWT::decode($token, $this->getKey(), array("HS256"));

			$user_id = $decoded_data->userdata->id;

			$product_obj = new ProductModel();

			$product_data = $product_obj->findAll();

			$response = [
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Lista de produtos",
                ],
				"retorno" => $product_data
			];

			return $this->respondCreated($response);
		} catch (Exception $ex) {

			$response = [
                "cabecalho" => [
                    "status" => 500,
                    "mensagem" => $ex->getMessage(),
                ],
				"retorno" => []
			];

			return $this->respondCreated($response);
		}
	}

/*    // GET single product method
    public function singleProductDetail($product_id)
    {
		try {

			$auth = $this->request->getHeader("Authorization");

			$token = $auth->getValue();

			$decoded_data = JWT::decode($token, $this->getKey(), array("HS256"));

			$user_id = $decoded_data->userdata->id;

			$product_obj = new ProductModel();

			$product_data = $product_obj->where("user_id", $user_id)->find($product_id); //questão do id
            
            if(!empty($product_data)){
                // produto localizado
                $response = [
                    "cabecalho" => [
                        "status" => 200,
                        "mensagem" => "Produto encontrado",
                    ],
                    "retorno" => $product_data
                ];
            }else{
                // produto não localizado
                $response = [
                    "cabecalho" => [
                        "status" => 404,
                        "mensagem" => "Produto não encontrado",
                    ],
                    "retorno" => []
                ];
            }
			return $this->respondCreated($response);

		} catch (Exception $ex) {

			$response = [
                "cabecalho" => [
                    "status" => 500,
                    "mensagem" => $ex->getMessage(),
                ],
				"retorno" => []
			];

			return $this->respondCreated($response);
		}
	}

    // PUT product method
    public function updateProduct($product_id)
    {
        // validação
        $rules = [
			"title" => "required",
			"price" => "required"
		];

        if (!$this->validate($rules)) {
			// errors
			$response = [
                "cabecalho" => [
                    "status" => 500,
                    "mensagem" => $this->validator->getErrors(),
				],
                "retorno" => []
            ];
		} else {
			// no error
			try {

                $auth = $this->request->getHeader("Authorization");
    
                $token = $auth->getValue();
    
                $decoded_data = JWT::decode($token, $this->getKey(), array("HS256"));
    
                $user_id = $decoded_data->userdata->id;
    
                $product_obj = new ProductModel();
    
                $product_data = $product_obj->where("user_id", $user_id)->find($product_id); //questão do id
                

                $data = [
                    "title" => $this->request->getVar("title"),
                    "price" => $this->request->getVar("price"),
                    "user_id" => $user_id
                ];
            }catch (Exception $ex) {

                $response = [
                    "cabecalho" => [
                        "status" => 500,
                        "mensagem" => $ex->getMessage(),
                    ],
                    "retorno" => []
                ];
    
                return $this->respondCreated($response);
            }
        }
        // produto existe
        // update

        // produto não existe
    }*/

	// DELETE product method
	public function deleteProduct($product_id)
	{
		try {

			$auth = $this->request->getHeader("Authorization");

			$token = $auth->getValue();

			$decoded_data = JWT::decode($token, $this->getKey(), array("HS256"));

			$user_id = $decoded_data->userdata->id;

			$product_obj = new ProductModel();

			$product_data = $product_obj->where([
				"id" => $product_id
			])->first();

			if(!empty($product_data)){
				// product
				$product_obj->delete($product_id);

				$response = [
                    "cabecalho" => [
                        "status" => 200,
                        "mensagem" => "O produto foi excluído",
                    ],
                    "retorno" => []
                ];
			}else{
				// no product
				$response = [
                    "cabecalho" => [
                        "status" => 404,
                        "mensagem" => "Produto não existe",
                    ],
                    "retorno" => []
                ];
			}

			return $this->respondCreated($response);

		} catch (Exception $ex) {

			$response = [
                "cabecalho" => [
                    "status" => 500,
                    "mensagem" => $ex->getMessage(),
                ],
				"retorno" => []
			];

			return $this->respondCreated($response);
		}
	}
}
