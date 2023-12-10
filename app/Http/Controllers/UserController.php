<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Constants\PaginationConstants;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
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
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $creator = $request->user();

        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'], // saved hashed due to User model $casts
            'creator_user_id' => $creator?->id,
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
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $updatePayload = [];

        if ($validated['name'])
            $updatePayload[] = $validated['name'];

        if ($validated['email'])
            $updatePayload[] = $validated['email'];

        if ($validated['password'])
            $updatePayload[] = $validated['password'];

        if(count($updatePayload))
            $user->update($updatePayload);

        return redirect()->route('users.show', ['user'=>$user->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
