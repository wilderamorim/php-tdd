<?php

namespace Tests\Unit\App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new \App\Models\User();
    }

    protected function expectedTraits(): array
    {
        return [
            \Laravel\Sanctum\HasApiTokens::class,
            \Illuminate\Database\Eloquent\Factories\HasFactory::class,
            \Illuminate\Notifications\Notifiable::class,
            \Illuminate\Database\Eloquent\Concerns\HasUuids::class,
        ];
    }

    protected function expectedFillable(): array
    {
        return [
            'name',
            'email',
            'password',
        ];
    }

    protected function expectedCasts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
