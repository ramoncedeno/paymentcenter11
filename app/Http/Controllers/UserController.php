<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Function for export users
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * Function for import users
     */
    public function import()
    {
        try {

            Excel::import(new UsersImport, 'users.xlsx');
            return redirect('/')->with('success', 'Importación completada con éxito.');

        } catch (\Exception $e) {

            // Loguear el error en caso de que ocurra
            Log::error('Error durante la importación: ' . $e->getMessage());
            return redirect('/')->with('error', 'Error durante la importación. Por favor, revisa los registros de log.');

        }
    }

    /**
     * Displays the user import form.
     */
    public function showimportform()
    {
        return view('formimportusers');
    }

    /**
     * Processes the file uploaded in the form for import.
     */
    public function usersimportform(Request $request)
    {
        //Validate that a file has been uploaded
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');
                Excel::import(new UsersImport, $file);
                return redirect()->back()->with('success', 'Importación completada con éxito.');
            } catch (\Exception $e) {
                // Log the error if it occurs
                Log::error('Error durante la importación desde formulario: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error durante la importación. Por favor, revisa los registros de log.');
            }
        }

        return redirect()->back()->with('error', 'No se ha seleccionado un archivo para importar.');
    }


    // Returns all paged users to view
    public function index()
    {
        $users = User::paginate(15);
        return view('viewuserstable',compact('users'));
    }


}
