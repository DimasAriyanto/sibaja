<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function getById(int $id): User
    {
        $user = $this->userRepository->getById($id);
        if (! $user) {
            throw new ModelNotFoundException('User dengan id '.$id.' tidak ditemukan');
        }

        return $user;
    }

    public function getByUsername(string $username): User
    {
        $user = $this->userRepository->getByUsername($username);
        if (! $user) {
            throw new ModelNotFoundException('User dengan username '.$username.' tidak ditemukan');
        }

        return $user;
    }

    public function getMappedUserTypes(): array
    {
        return collect(User::$ROLE)->map(function ($type) {
            return [
                'value' => $type,
                'name' => ucfirst($type),
            ];
        })->toArray();
    }

    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $user = $this->getById($id);

        return $this->userRepository->update($user, $data);
    }

    public function delete(int $id)
    {
        $user = $this->getById($id);

        return $this->userRepository->delete($user);
    }
}
