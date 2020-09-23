<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\StoreUpdatePermission;


class PermissionController extends Controller
{
    protected $repository;


    public function __construct(Permission $permission){
        $this->repository = $permission;
        $this->middleware(['can:Permissions']);
    }

    public function index()
    {
        $permissions = $this->repository->paginate();
        return view('admin.pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('permissions.index');
    }

    public function show($id)
    {
        if(!$permission = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        if(!$permission = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.permissions.edit', compact('permission'));

    }

    public function update(StoreUpdatepermission $request, $id)
    {
        if(!$permission = $this->repository->find($id)){
            return redirect()->back();
        }

        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }

    public function destroy($id)
    {
        if(!$permission = $this->repository->find($id)){
            return redirect()->back();
        }

        $permission->delete();
        return redirect()->route('permissions.index');
    }

    public function search(Request $request){
        $filters = $request->except('_token');
        $permission = $this->repository->search($request->filter);

        return view('admin.pages.permissions.index', compact('permission', 'filters'));
    }
}
