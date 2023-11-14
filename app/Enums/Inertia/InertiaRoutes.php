<?php 

declare(strict_types=1);

namespace App\Enums\Inertia;

enum InertiaRoutes: string
{  
  case INERTIA_USERS_PAGE = 'Users/UsersPage';
  case INERTIA_EDIT_PAGE = 'Users/EditUserPage';
  case INERTIA_SINGLE_USER_PAGE = 'Users/SingleUserPage';
}

?>