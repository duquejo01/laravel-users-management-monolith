<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\UserService\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

  private const SEARCH_TERM = 'search';
  
  public function __construct(
    private readonly UserServiceInterface $userService,
  ) {}

  public function renderUsersView(Request $request): Response {

    $searchTerm = self::SEARCH_TERM;

    return Inertia::render('Users/UsersPage', [
      'filters' => $request->only($searchTerm),
      'users' => $this->userService->findByNameWithPagination( $request->input($searchTerm, '') ),
    ]);
  }

  public function update(Request $request) {
    $isUpdated = $this->userService->update($request->input('id'), $request->input());
    if( $isUpdated ) {
      return to_route('users.index');
    }
  }

  public function store( Request $request) {
    $isCreated = $this->userService->store($request->input());
    if( $isCreated ) {
      return to_route('users.index');
    }
  }

  public function delete(Request $request) {
    $this->userService->delete($request->input());
    return Inertia::location('/users');
  }
}
