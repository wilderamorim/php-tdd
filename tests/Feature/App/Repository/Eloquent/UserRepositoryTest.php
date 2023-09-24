<?php

namespace Tests\Feature\App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Exceptions\NotFoundException;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new UserRepository(new User());
    }

    public function test_implements_user_repository_interface(): void
    {
        $this->assertInstanceOf(UserRepositoryInterface::class, $this->repository);
    }

    public function test_find_all_empty(): void
    {
        $response = $this->repository->findAll();

        $this->assertIsArray($response);
        $this->assertCount(0, $response);
    }

    public function test_find_all(): void
    {
        $count = 10;

        User::factory()->count($count)->create();
        $response = $this->repository->findAll();

        $this->assertCount($count, $response);
    }

    public function test_create(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@foo.com',
            'password' => '12345678',
        ];

        $response = $this->repository->save($data);

        $this->assertNotNull($response);
        $this->assertIsObject($response);

        unset($data['password']);
        $this->assertDatabaseHas('users', $data);
    }

    public function test_create_execption(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        $this->repository->save(['name' => 'John Doe', 'password' => '12345678']);
    }

    public function test_update(): void
    {
        $user = User::factory()->create();

        $name = $user->name . ' Updated';
        $data = compact('name');

        $response = $this->repository->save(
            data: $data,
            id: $user->id,
        );

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertDatabaseHas('users', $data);
    }

    public function test_delete(): void
    {
        $user = User::factory()->create();

        $response = $this->repository->delete($user->id);

        $this->assertTrue($response);
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    public function test_delete_does_not_exist(): void
    {
        /*
        try {
            $this->repository->delete('invalid-id');

            $this->assertTrue(false);
        } catch (\Throwable $throwable) {
            $this->assertInstanceOf(\Exception::class, $throwable);
        }
        */

        $this->expectException(NotFoundException::class);
        $this->repository->delete('invalid-id');
    }

    public function test_find_by_id(): void
    {
        $user = User::factory()->create();

        $response = $this->repository->findOneById($user->id);

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertEquals($user->id, $response->id);
    }

    public function test_find_by_id_does_not_exist(): void
    {
        $this->expectException(NotFoundException::class);

        $this->repository->findOneById('invalid-id');
    }
}
