<?php

declare(strict_types=1);

namespace App\Contracts\Services\UserService;

use Illuminate\Contracts\Pagination\Paginator;

interface UserServiceInterface
{
  public function findByNameWithPagination(string $search, string $perPage): Paginator;
  public function update(string $id, array $data): array;
  public function store(array $data): array;
  public function delete(array $data): array;
}

?>