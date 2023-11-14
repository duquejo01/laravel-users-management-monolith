<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\Contracts\Services\UserService\UserServiceInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;

class UserService implements UserServiceInterface
{
  public function __construct(private readonly User $user){}

  public function findById(string $id): User
  {
    return $this->user->query()->where('id', '=', $id)->firstOrFail();
  }

  public function findByNameWithPagination($search = ''): Paginator
  {
    return $this->user->query()
      ->when(
        $search,
        function (Builder $query, string $search) {
          $query->where('name', 'ilike', "%{$search}%")
                ->orWhere('email', 'ilike', "%{$search}%");
        }
      )
      ->orderBy('updated_at', 'DESC')
      ->paginate(10)
      ->through(function ($user) {
        return [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
          'role' => $user->role,
          'phone_number' => $user->phone_number,
          'created_at' => Carbon::parse($user['created_at'])->format('M d Y'),
        ];
      })
      ->withQueryString();
  }

  public function update(string $id, array $data): bool
  {

    $user = $this->findById($id);

    if (!$user->exists()) {
      dd('User not found.');
    }

    $inputs = [
      'name' => $data['name'],
      'email' => $data['email'],
      'role' => $data['role'],
      'gender' => $data['gender'],
      'birthday' => $data['birthday'],
      'nationality' => $data['nationality'],
      'address' => $data['address'],
      'phone_number' => $data['phone_number'],
      'city' => $data['city'],
      'country' => $data['country'],
      'state' => $data['state'],
      'description' => $data['description'],
      'password' => $data['password'],
    ];

    if( $inputs['password'] === '') {
      unset($inputs['password']);
    }

    $isUpdated = $user->update($inputs);

    return $isUpdated;
  }

  public function store(array $data): bool
  {

    $inputs = [
      'name' => $data['name'],
      'email' => $data['email'],
      'role' => $data['role'],
      'gender' => $data['gender'],
      'birthday' => $data['birthday'],
      'nationality' => $data['nationality'],
      'address' => $data['address'],
      'phone_number' => $data['phone_number'],
      'city' => $data['city'],
      'country' => $data['country'],
      'state' => $data['state'],
      'description' => $data['description'],
      'password' => $data['password'],
    ];

    if( $inputs['password'] === '') {
      unset($inputs['password']);
    }

    $newUser = new User($inputs);
    return $newUser->save();
  }

  public function delete(array $ids): void
  {
    $users = $this->user->whereIn('id', $ids);
    $users->delete();
  }
}
