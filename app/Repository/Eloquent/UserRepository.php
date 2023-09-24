<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Contracts\PaginationInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Exceptions\NotFoundException;
use App\Repository\Presenters\PaginationEloquentPresenter;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    protected Model $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function findAll(): array
    {
        return $this->model->get()->toArray();
    }

    public function findAllPaginated(int $currentPage = 1): PaginationInterface
    {
        return new PaginationEloquentPresenter($this->model->paginate());
    }

    public function findOneById(string $id): object
    {
        if (!$user = $this->model->find($id)) {
            throw new NotFoundException('User not found');
        }

        return $user;
    }

    public function findOneByEmail(string $email): object
    {
        if (!$user = $this->model->where('email', $email)->first()) {
            throw new NotFoundException('User not found');
        }

        return $user;
    }

    public function save(array $data, ?string $id = null): object
    {
        if (is_null($id)) {
            return $this->create($data);
        }

        return $this->update($id, $data);
    }

    public function create(array $data): object
    {
        $data['password'] = bcrypt($data['password']);
        return $this->model->create($data);
    }

    public function update(string $id, array $data): object
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = $this->findOneById($id);
        $user->update($data);

        $user->refresh();

        return $user;
    }

    public function delete(string $id): bool
    {
        return $this->findOneById($id)->delete();
    }
}
