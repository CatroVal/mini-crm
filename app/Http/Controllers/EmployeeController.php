<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Company;
use App\Employee;

class EmployeeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //Eager Loading para precargar las relaciones de las dos tablas en una sola consulta
        $companies = Company::all();
        //$employees = DB::table('employees')->orderBy('last_name', 'asc')->paginate(10);
        $employees = Employee::with('company')->orderBy('last_name')->get();

        //return view('employee.employees', ['employees' => $employees]);
        return view('employee.employees', compact('companies','employees'));
    }

    public function create(){
        $companies_list = array(
                'companies' => DB::table('companies')->orderBy('name', 'asc')->get()
        );

        return view('employee.create', $companies_list);
    }

    public function store(Request $request) {

        //Validacion del formulrario
        $validated = $this->validate($request, [
            'first_name' => 'required|string|alpha|max:255',
            'last_name' => 'required|string|alpha|max:255',
            'empl_email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:100',
            'company' => 'required|integer'
        ]);

        //Recoger datos del formulario
        $user = \Auth::user();

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('empl_email');
        $phone = $request->input('phone');
        $company_id = $request->input('company');

        //Asignar valores al objeto Employee y guardar en BBDD
        $employee = new Employee();
        $employee->first_name = $first_name;
        $employee->last_name = $last_name;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->company_id = (int)$company_id;
        //var_dump($employee);
        //die();

        $employee->save();

        return redirect()->route('employees')->with([
            'message' => 'New employee added successfully!'
        ]);
    }

    public function edit($id) {
        $employee = Employee::find($id);

        return view('employee.edit', [
            'employee' => $employee
        ]);
    }

    public function update(Request $request, $id) {
        $employee = Employee::find($id);

        //dd($employee);
        //Validacion de datos del formulrario
        $validated = $this->validate($request, [
            //'employee_id' => '',
            'first_name' => 'required|string|alpha|max:255',
            'last_name' => 'required|string|alpha|max:255',
            'email' => ['required','email',Rule::unique('employees')->ignore($employee->id)],
            'phone' => 'nullable|string|max:100'
        ]);


        //Recoger datos del formulario
        $id = $request->input('employee_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        //Conseguir el objeto Employee para setear los nuevos datos
        //$employee = Employee::find($id);
        //Asignar nuevos valores al objeto
        $employee_id = $employee->id;
        $employee->first_name = $first_name;
        $employee->last_name = $last_name;
        $employee->email = $email;
        $employee->phone = $phone;

        $employee->update();

        return redirect()->route('employees')->with([
            'message' => 'Employee data updated succesfully'
        ]);
    }

    public function delete($id) {
        $user = \Auth::user();
        $employee = Employee::find($id);

        if($user && $employee && $user->is_admin) {
            //$employee->delete('first_name');
            //$employee->delete('last_name');
            //$employee->delete('email');
            //$employee->delete('phone');
            //$employee->delete('company_id');
            $employee->delete();

            $message = array('message' => 'Employee deleted successfully');
        } else {
            $message = array('message' => 'Failed to delete employee');
        }

        return redirect()->route('employees')->with($message);
    }
}
