<?php

namespace App\Services\v1;

use Validator;
use App\Employee;

class EmployeeService {
        
    public function getEmployees(){
        
        return $this->filterEmployees(Employee::all());
        
    }
    
    public function getEmployee($userName){
        
        return $this->filterEmployees(Employee::where('userName', $userName)->get());
    }
    
    public function createEmployee($request) {
        
        $employee = Employee::create($request->all());
        
        $employee->save();
        
        return $this->filterEmployees([$employee]);
    }
    
   /* How i did it before 
    * 
    public function createEmployee($request) {
        
        $employee = new Employee();
        $employee->firstName    = $request->input('firstName');
        $employee->lastName     = $request->input('lastName');
        $employee->userName     = $request->input('userName');
        $employee->phone        = $request->input('phone');
        $employee->email        = $request->input('email');
        $employee->title        = $request->input('title');
        $employee->salary       = $request->input('salary');
        
        $employee->save();
        
        return $this->filterEmployees([$employee]);
    }
    */
    public function updateEmployee($request, $userName) {
        
        $employee = Employee::where('userName', $userName)->firstOrFail();
   
        $employee->firstName    = $request->input('firstName');
        $employee->lastName     = $request->input('lastName');
        $employee->userName     = $request->input('userName');
        $employee->phone        = $request->input('phone');
        $employee->email        = $request->input('email');
        $employee->title        = $request->input('title');
        $employee->salary       = $request->input('salary');
 
        $employee->save();
        return $this->filterEmployees([$employee]);
    }
    
    public function deleteEmployee($userName) {
        $employee = Employee::where('userName', $userName)->firstOrFail();
        
        $employee->delete();
    }
    
    //Filtering data output, by not showing created_at and updated_at
    
    protected function filterEmployees($employees){
        
        $data = [];
        
        foreach($employees as $employee){
            
            $entry = [
                'id'        => $employee->id,
                'firstName' => $employee->firstName,
                'lastName'  => $employee->lastName,
                'userName'  => $employee->userName,
                'phone'     => $employee->phone,
                'email'     => $employee->email,
                'title'     => $employee->title,
                'salary'    => $employee->salary,
                'href'      => route('employees.show', ['id' => $employee->userName])
            ];
            
            //Showing teams linked to an employee
            
            foreach($employee->teams as $teams){
                $entry['teamNames'][] = $teams->teamName;
            }

            $data[] = $entry;           
        }
        
       return $data;
        
    }
    
    //Validating process. Making input to be required.
    
    protected $rules = [
        'firstName' => 'required',
        'lastName'  => 'required',
        'userName'  => 'required',
        'phone'     => 'required|numeric',          //numeric, validate that it is an integer.
        'email'     => 'required',
        'title'     => 'required',
        'salary'    => 'required|numeric',
    ];
    public function validate($employee) {
        $validator = Validator::make($employee, $this->rules);
        $validator->validate();
    }
}
