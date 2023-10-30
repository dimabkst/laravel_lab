<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Constants\PaginationConstants;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {

        $limit = $req->query('limit') ?? PaginationConstants::DEFAULT_PAGINATION_LIMIT;
        $page = $req->query('page') ?? PaginationConstants::DEFAULT_PAGINATION_PAGE;

        $users = User::query()->paginate(perPage: $limit, page:$page)->appends(['limit' => $limit, 'page' => $page]);

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'bail|required|string|min:6'
        ]);

        $newUser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') // saved hashed due to User model $casts
        ]);

        return redirect()->route('users.show', ['user'=>$newUser->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'bail|nullable|string|max:255',
            'email' => ['bail', 'nullable', Rule::unique('users', 'email')->ignore($user),
            ],
            'password' => 'bail|nullable|string|min:6'
        ]);

        $updatePayload = [];

        if ($request->input('name'))
            $updatePayload[] = $request->input('name');

        if ($request->input('email'))
            $updatePayload[] = $request->input('email');

        if ($request->input('password'))
            $updatePayload[] = $request->input('password');

        if(count($updatePayload))
            $user->update($updatePayload);

        return redirect()->route('users.show', ['user'=>$user->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
