<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = permission::all();
        return view('admin.permission.index', compact('permissions'));
    }


    public function create()
    {
        return view('admin.permission.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $permissionData = [
            'name' => $request->name,
        ];

        $permissions = permission::create($permissionData);
        return redirect()->route('admin.permission.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $permissions = permission::find($id);
        return view('admin.permission.edit', compact('permissions'));
    }


    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $permissionData = [
            'name' => $request->name,
        ];

        $permissions = permission::where('id', $id)->update($permissionData);
        return redirect()->route('admin.permission.index');
    }


    public function destroy(string $id)
    {
        $permissions = permission::destroy($id);
        return redirect()->route('admin.permission.index');
    }
}
