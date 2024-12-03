<?php

namespace App\Helpers;


class ImagePathHelper
{
  public static function normalizePath($path)
  {
    return $path ? str_replace('public', '/storage', $path) : 'https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg';
  }
}
