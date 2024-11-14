<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\EmployeeProject;
use App\Services\EmployeeProjectService;

class EmployeeProjectController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request, EmployeeProjectService $employeeProjectService){

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();
        $fileData = array_map('str_getcsv', file($filePath));

        $header = array_shift($fileData);
        $employeeProjectService->storeProjects($fileData);

        return redirect()->route('employee-table');

    }


    public function table(EmployeeProjectService $employeeProjectService)
    {

        $pairs = $employeeProjectService->populateTableData();
        return view('employeeTable', compact('pairs'));

    }

}
