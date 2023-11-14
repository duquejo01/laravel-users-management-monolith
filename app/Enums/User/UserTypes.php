<?php 

declare(strict_types=1);

namespace App\Enums\User;

enum UserTypes: string
{
  case ADMIN = 'admin';
  case EDITOR = 'editor';
  case USER = 'user';
}

?>