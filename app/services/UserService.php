<?php


namespace App\services;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserService
{
  public function get(Request $request): Collection
  {
    return $this->search($request->get('search'));
  }

  public function search($query = null): Collection
  {
    if (!isset($query)) {
      $users = User::where('role', 'customer')->orderBy('id', 'desc')->get();
    } elseif (is_numeric($query)) {
      $query = $query * 100;
      $users = User::where('role', 'customer')->get()->filter(function ($user) use ($query) {
        return $user->balance === (int)$query;
      });
    } else {
      $users = User::where('role', 'customer')->where('name', 'like', "{$query}%")->get();
    }
    return $users;
  }
}
