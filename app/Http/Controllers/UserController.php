<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    public function import()
    {
        Excel::import(new UsersImport, 'users.xlsx');

        return redirect('/')->with('success', 'All good!');
    }

    // View Form import users
    public function showimportform()
    {
        return view('formimportusers');
    }

    public function usersimportform (Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Excel::import(new UsersImport, $file);
            return redirect()->back()->with('success', 'Importación completada');
        }

        return redirect()->back()->with('error', 'No se ha seleccionado un archivo para importar');
    }
}
