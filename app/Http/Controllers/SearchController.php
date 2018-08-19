<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function users() {

        $search_users = Input::get('q');
        $search_users_from_DB = User::where('name', 'like', '%' . $search_users . '%')->paginate(3);

        return view('search.users', compact('search_users_from_DB'));

    }
}
