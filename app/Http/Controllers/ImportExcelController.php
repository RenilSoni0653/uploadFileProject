<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Excel;

class ImportExcelController extends Controller
{
    public function index()
    {
        $data = \DB::table('users')->orderBy('id', 'DESC')->paginate(10);
        return view('import_excel', compact('data'));
    }

    public function search(Request $request)
    {
        $user = User::paginate(10);
        $search = $request->input('search');
        
        $users = User::query()
        ->where('cust_name','LIKE',$search)
        ->orWhere('gender','LIKE',$search)
        ->orWhere('address','LIKE',$search)
        ->get();

        return view('searchExcel',compact('users'));
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls'
        ]);

        $data = Excel::import(new UsersImport,$request->file('select_file'));
        
        foreach($data as $key => $value)
        {
            foreach($value as $row)
            {
                $insert_data[] = array(
                    'cust_name'  => $row['cust_name'],
                    'gender'   => $row['gender'],
                    'address'   => $row['address'],
                );
            }
        }
        if(!empty($insert_data))
        {
            DB::table('users')->insert($insert_data);
        }
        
        return back()->with('success', 'Excel Data Imported successfully.');
    }
}
