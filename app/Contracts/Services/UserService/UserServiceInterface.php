<?php

declare(strict_types=1);

namespace App\Contracts\Services\UserService;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;

interface UserServiceInterface
{
  public function findByNameWithPagination(string $search): Paginator;
  public function findById(string $id): User;
  public function update(string $id, array $data): bool;
  public function store(array $data): bool;
  public function delete(array $data): void;
}

?>