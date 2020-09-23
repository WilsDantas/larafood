<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\requests\StoreUpdateUser;
use App\Models\User;


class UserController extends Controller
{
    private $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;

        $this->middleware(['can:Users']);
    }


    public function index(){

        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    public function create(){
        return view('admin.pages.users.create');
    }

    public function store(StoreUpdateUser $request){
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']); // Encrypt Password

        $this->repository->create($data);
        
        return redirect()->route('users.index');
    }

    public function show($id){
        if (!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.users.show', compact('user'));
    }

    public function edit($id){
        if (!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.users.edit', compact('user'));
    }

    public function update(StoreUpdateUser $request, $id){
        if (!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }

        $data = $request->only('name', 'email');
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        
        return redirect()->route('users.index');
    }

    public function destroy($id){
        if (!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }

        

        $user->delete();
        return redirect()->route('users.index');
    }

    public function search(Request $request){
        $filters = $request->except('_token');
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', compact('users', 'filters'));
    }

    
    
}
