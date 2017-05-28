<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

use App\Services\v1\EmployeeService;


class EmployeeController extends Controller
{
    protected $employees;

    public function __construct(EmployeeService $service) {
        
        $this->employees = $service; 
    }
    
    //index -> shows all employees
    
    public function index()
    {
        $data = $this->employees->getEmployees();
        
        return response()->json($data);
    }
    
    //show -> shows a specific employee, on employees username

    public function show($id)
    {
        $data = $this->employees->getEmployee($id);
        
        return response()->json($data);
    }
    
    //store -> create a new employee into db

    public function store(Request $request)
    {
        $this->employees->validate($request->all());
        
        try {
            $employee = $this->employees->createEmployee($request);
            return response()->json($employee, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
    //update -> update a specific employee

    public function update(Request $request, $id)
    {
        $this->employees->validate($request->all());
        
        try {
            $employee = $this->employees->updateEmployee($request, $id);
            return response()->json($employee, 200);
        
        } 
        catch (ModelNotFoundException $ex) {
            throw $ex;
        }
 
        catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    //delete -> delete a specific employee
    
    public function destroy($id)
    {
        try {
            $employee = $this->employees->deleteEmployee($id);
            return response()->make('', 204);
        } 
        catch (ModelNotFoundException $ex) {
            throw $ex;
        }
        catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
