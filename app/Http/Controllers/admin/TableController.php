<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Http\Requests\StoreUpdateTable;


class TableController extends Controller
{
    private $repository;

    public function __construct(table $table){
        $this->repository = $table;
        $this->middleware(['can:Tables']);
    }

    public function index()
    {
        $tables = $this->repository->latest()->paginate();

        return view('admin.pages.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.pages.tables.create');
    }

    public function store(StoreUpdatetable $request)
    {
        $this->repository->create($request->all());
        
        return redirect()->route('tables.index');
    }

    public function show($id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.tables.show', compact('table'));
    }

    public function edit($id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.tables.edit', compact('table'));

    }

    public function update(StoreUpdatetable $request, $id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        $table->update($request->all());

        return redirect()->route('tables.index');
    }

    public function destroy($id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        $table->delete();

        return redirect()->route('tables.index');
    }

    public function search(Request $request){
        $filters = $request->except('_token');
        $tables = $this->repository->search($request->filter);

        return view('admin.pages.tables.index', compact('tables', 'filters'));
    }

    public function qrcode($identify)
    {
        if(!$table = $this->repository->where('identify', $identify)->first()) {
            return redirect()->back();
        }

        $tenant = auth()->user()->tenant;

        $uri = env('URI_CLIENT') . "/{$tenant->uuid}/{$table->uuid}";

        return view('admin.pages.tables.qrcode', compact('uri'));
    }
}
