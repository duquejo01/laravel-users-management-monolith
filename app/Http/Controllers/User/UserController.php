<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\UserService\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class UserController extends Controller
{

  private const SEARCH_KEY = 'search';
  private const PAGINATION_NUMBER = 10;
  
  public function __construct(
    private readonly UserServiceInterface $userService,
  ) {}

  public function list(Request $request) {

    $searchTerm = self::SEARCH_KEY;
    $paginationNumber = self::PAGINATION_NUMBER;

    return Inertia::render('Users/UsersPage', [
      'filters' => $request->only($searchTerm),
      'users' => $this->userService->findByNameWithPagination(
        $request->input($searchTerm, ''),
        $request->input('perPage', $paginationNumber),
      ),
    ]);
  }

  public function update(Request $request) {

    $validation = Validator::make($request->all(), [
      'id' => ['required', 'integer'],
      'name' => ['required', 'string'],
      'email' => ['required', 'email'],
      'role' => ['required', Rule::in(['Admin', 'Editor', 'User'])],
      'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
      'birthday' => ['required', 'date'],
      'nationality' => ['required', 'string'],
      'address' => ['required', 'string'],
      'phone_number' => ['required', 'string'],
      'address' => ['required', 'string'],
      'city' => ['required', 'string'],
      'state' => ['required', 'string'],
      'country' => ['required', 'string'],
      'description' => ['required', 'string'],
      'avatar.url' => ['required', 'url'],
      'avatar.alt' => ['string'],
      'password' => ['nullable', 'string'],
    ]);

    if( $validation->fails()) {
      return response()->json([
        'status' => HttpResponse::HTTP_BAD_REQUEST,
        'error' => 'Bad Request',
        'message' => $validation->errors(),
      ], HttpResponse::HTTP_BAD_REQUEST );
    }

    $updateId = $request->input('id');
    $updateData = $request->input();

    try {
      return $this->userService->update( $updateId, $updateData );
    } catch (Throwable $th) {
      return response()->json([
        'status' => $th->getCode(),
        'error' => HttpResponse::$statusTexts[$th->getCode()],
        'message' => $th->getMessage(),
      ], $th->getCode());
    }
  }

  public function store( Request $request) {

    $validation = Validator::make($request->all(), [
      'name' => ['required', 'string'],
      'email' => ['required', 'email'],
      'role' => ['required', Rule::in(['Admin', 'Editor', 'User'])],
      'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
      'birthday' => ['required', 'date'],
      'nationality' => ['required', 'string'],
      'address' => ['required', 'string'],
      'phone_number' => ['required', 'string'],
      'address' => ['required', 'string'],
      'city' => ['required', 'string'],
      'state' => ['required', 'string'],
      'country' => ['required', 'string'],
      'description' => ['required', 'string'],
      'avatar.url' => ['required', 'url'],
      'avatar.alt' => ['string'],
      'password' => ['required', 'string'],
    ]);

    if( $validation->fails() ) {
      return response()->json([
        'status' => HttpResponse::HTTP_BAD_REQUEST,
        'error' => HttpResponse::$statusTexts[HttpResponse::HTTP_BAD_REQUEST],
        'message' => $validation->errors(),
      ], HttpResponse::HTTP_BAD_REQUEST );
    }

    try {
      return $this->userService->store($request->input());
    } catch (Throwable $th) {
      return response()->json([
        'status' => $th->getCode(),
        'error' => HttpResponse::$statusTexts[$th->getCode()],
        'message' => $th->getMessage(),
      ], $th->getCode());
    }

    // return to_route('users.index');
  }

  public function delete(Request $request) {

    $validation = Validator::make( $request->all(), [
      'ids' => ['required', 'array'],
      'ids.*' => ['required', 'integer']
    ]);

    if( $validation->fails() ) {
      return response()->json([
        'status' => HttpResponse::HTTP_BAD_REQUEST,
        'error' => HttpResponse::$statusTexts[HttpResponse::HTTP_BAD_REQUEST],
        'message' => $validation->errors(),
      ], HttpResponse::HTTP_BAD_REQUEST );
    }

    try {
      return $this->userService->delete($request->input('ids'));
    } catch (Throwable $th) {
      return response()->json([
        'status' => $th->getCode(),
        'error' => HttpResponse::$statusTexts[$th->getCode()],
        'message' => $th->getMessage(),
      ], $th->getCode());
    }

    // return Inertia::location('/users');
  }
}
