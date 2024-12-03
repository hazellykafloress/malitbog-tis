<?php

namespace App\Enums;

enum RoleEnum: string
{
  case ADMINS = 'Admin';
  case ADMIN = 'admin';
  case OWNER = 'owner';
}
