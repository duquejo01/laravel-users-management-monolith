<?php 

declare(strict_types=1);

namespace App\Enums\User;

enum UserConstants: string
{
  case USER_SEARCH_TERM = 'search';
  case USER_SEARCH_PAGINATION_VALUE = '10';
  case USER_ACTION_EDIT = 'edit';
  case USER_ACTION_CREATE = 'create';
}

?>