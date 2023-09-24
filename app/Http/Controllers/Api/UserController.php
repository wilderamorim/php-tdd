<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->repository->findAllPaginated();
        $items = $response->items();

        return UserResource::collection($items)
            ->additional([
                'meta' => [
                    'pagination' => [
                        'current_page' => $response->currentPage(),
                        'from' => $response->firstItem(),
                        'last_page' => $response->lastPage(),
                        'per_page' => $response->perPage(),
                        'to' => $response->lastItem(),
                        'total' => $response->total(),
                    ],
                ],
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $user = $this->repository->save($request->validated());
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->repository->findOneById($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->repository->save($request->validated(), $id);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
