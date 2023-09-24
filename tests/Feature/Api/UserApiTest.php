<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Tests\TestCase;

class UserApiTest extends TestCase
{
    protected string $baseUrl = '/api/users';

    /**
     * @dataProvider dataProviderPaginate
     * @return void
     */
    public function test_paginate(int $total, int $currentPage = 1, int $totalPage = 15): void
    {
        User::factory()->count($total)->create();

        $response = $this->getJson($this->baseUrl . '?page=' . $currentPage);

        $response->assertOk();
        $response->assertJsonCount($totalPage, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
            'meta' => [
                'pagination' => [
                    'current_page',
                    'from',
                    'last_page',
                    'per_page',
                    'to',
                    'total',
                ],
            ],
        ]);
        $response->assertJsonFragment([
            'total' => $total,
            'current_page' => $currentPage,
        ]);
    }

    public static function dataProviderPaginate(): array
    {
        return [
            'Empty' => ['total' => 0, 'currentPage' => 1, 'totalPage' => 0],
            '40 users page 1' => ['total' => 40, 'currentPage' => 1, 'totalPage' => 15],
            '40 users page 2' => ['total' => 40, 'currentPage' => 2, 'totalPage' => 15],
            '40 users page 3' => ['total' => 40, 'currentPage' => 3, 'totalPage' => 10],
            '40 users page 4' => ['total' => 40, 'currentPage' => 4, 'totalPage' => 0],
        ];
    }

    /**
     * @dataProvider dataProviderCreate
     * @param array $data
     * @param int $httpStatusCode
     * @param array $structure
     * @return void
     */
    public function test_create(array $data, int $httpStatusCode, array $structure): void
    {
        $response = $this->postJson($this->baseUrl, $data);

        $response->assertStatus($httpStatusCode);
        $response->assertJsonStructure($structure);
    }

    public function test_show(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson($this->baseUrl . '/' . $user->id);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
            ],
        ]);
    }

    public function test_show_not_found(): void
    {
        $response = $this->getJson($this->baseUrl . '/invalid-id');
//        $response->assertNotFound();
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    /**
     * @dataProvider dataProviderUpdate
     * @param array $data
     * @param int $httpStatusCode
     * @return void
     */
    public function test_update(array $data, int $httpStatusCode): void
    {
        $user = User::factory()->create();

        $response = $this->putJson($this->baseUrl . '/' . $user->id, $data);

        $response->assertStatus($httpStatusCode);
//        $response->assertJsonStructure([
//            'data' => [
//                'id',
//                'name',
//                'email',
//            ],
//        ]);
    }

    public function test_update_not_found(): void
    {
        $response = $this->putJson($this->baseUrl . '/invalid-id', [
            'name' => 'John Doe',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_delete(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson($this->baseUrl . '/' . $user->id);

        $response->assertNoContent();
    }

    public function test_delete_not_found(): void
    {
        $response = $this->deleteJson($this->baseUrl . '/invalid-id');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public static function dataProviderCreate(): array
    {
        return [
            'Empty' => [
                'data' => [],
                'httpStatusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'structure' => [
                    'message',
                    'errors' => [
                        'name',
                        'email',
                        'password',
                    ],
                ],
            ],
            'Invalid email' => [
                'data' => ['name' => 'John Doe', 'email' => 'invalid-email', 'password' => 'password'],
                'httpStatusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'structure' => [
                    'message',
                    'errors' => [
                        'email',
                    ],
                ],
            ],
            'Invalid password' => [
                'data' => ['name' => 'John Doe', 'email' => 'foo@bar.com', 'password' => '123456'],
                'httpStatusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'structure' => [
                    'message',
                    'errors' => [
                        'password',
                    ],
                ],
            ],
            'Valid' => [
                'data' => ['name' => 'John Doe', 'email' => 'foo@bar.com', 'password' => 'password'],
                'httpStatusCode' => Response::HTTP_CREATED,
                'structure' => [
                    'data' => [
                        'id',
                        'name',
                        'email',
                    ],
                ],
            ],
        ];
    }

    public static function dataProviderUpdate(): array
    {
        return [
//            'Empty' => [
//                'data' => [],
//                'httpStatusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
//            ],
            'Invalid email' => [
                'data' => ['name' => 'John Doe', 'email' => 'invalid-email'],
                'httpStatusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ],
            'Valid' => [
                'data' => ['name' => 'John Doe', 'password' => 'password'],
                'httpStatusCode' => Response::HTTP_OK,
            ],
//            'Without password' => [
//                'data' => ['name' => 'John Doe'],
//                'httpStatusCode' => Response::HTTP_OK,
//            ],
//            'Without name' => [
//                'data' => ['password' => 'password'],
//                'httpStatusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
//            ],
        ];
    }
}
