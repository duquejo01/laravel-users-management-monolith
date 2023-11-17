<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\Contracts\Services\UserService\UserServiceInterface;
use App\Exceptions\UserException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Response as HttpResponse;

class UserService implements UserServiceInterface
{
  public function __construct(private readonly User $user){}

  public function findByNameWithPagination($search = '', $perPage = 10): Paginator
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
      ->paginate($perPage)
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

  public function update(string $id, array $data): array
  {

    $user = $this->user->query()->where('id', '=', $id)->first();

    if ( ! $user ) {
      throw new UserException(
        'The user does not exist',
        HttpResponse::HTTP_BAD_REQUEST
      );
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
    ];

    $isUpdated = $user->update($inputs);

    return [
      'success' => $isUpdated,
      'user' => $user,
    ];
  }

  public function store(array $data): array
  {

    $user = $this->user->query()->where('email', '=', $data['email'])->first();

    if( $user ) {
      throw new UserException(
        'The user already exist',
        HttpResponse::HTTP_CONFLICT
      );
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

    $newUser = new User($inputs);
    $isSaved = $newUser->save();

    return [
      'success' => $isSaved,
      'users' => $newUser,
    ];
  }

  public function delete(array $ids): array
  {
    $users = $this->user->whereIn('id', $ids);

    if( $users->count() < 1 ) {
      throw new UserException(
        'The specified user list was not found',
        HttpResponse::HTTP_NOT_FOUND
      );
    }

    $usersForDeletion = $users->get()->map( function($user) {
      return collect($user->toArray())
        ->only(['id', 'name', 'email'])
        ->all();
    });
    $isDeleted = $users->delete();

    return [
      'success' => $isDeleted,
      'users' => $usersForDeletion,
    ];
  }
}
