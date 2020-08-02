<?php

namespace App\Http\Controllers;

use App\services\UserService;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getCurrentUserRole():string
    {
      return \Auth::user()->role;
    }

    public function index(Request $request): Collection
    {
      $service = new UserService();
      return $service->get($request);
    }

  public function show($id)
  {
    return User::with('notes')->findOrFail($id);
  }
}
