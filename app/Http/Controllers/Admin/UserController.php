<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Actions\User\CreateUser;
use App\Models\User;

class UserController extends Controller
{
    protected $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    public function index()
    {
        return view('pages.admin.users.create', [
            'users' => User::latest()->get()
        ]);
    }

    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->createUser->execute($request->validated());

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }
}
