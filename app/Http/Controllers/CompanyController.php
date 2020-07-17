<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\Employee;

class CompanyController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $companies = DB::table('companies')->orderBy('id', 'desc')->paginate(5);

        return view('company.companies', ['companies' => $companies]);
    }

    public function create() {

        return view('company.create');
    }

    public function store(Request $request) {
        //Validacion del formulario
        $validated = $this->validate($request, [
            'comp-name' => 'required|string|unique:companies,name|max:255',
            'comp-email' => 'required|string|unique:companies,email|email|max:255',
            'website' => 'required|string|unique:companies,website|max:100',
            'logo' => 'mimes:jpg,gif,png,jpeg|dimensions:min_width=100,min_height=100'
        ]);

        //Recoger datos del formulario
        $user = \Auth::user();
        $name = $request->input('comp-name');
        $website = $request->input('website');
        $email = $request->input('comp-email');

        //var_dump($name);
        //var_dump($website);
        //var_dump($email);
        //die();

        //Asignar valores al objeto Company
        $company = new Company();
        $company->name = $name;
        $company->website = $website;
        $company->email = $email;

        //Recoger imagen del formulario
        $logo_path = $request->file('logo');
        if($logo_path){
            //Poner nombre único
            $logo_path_name = time().$logo_path->getClientOriginalName();
            //Guardar imagen en carpeta publica
            Storage::disk('public')->put($logo_path_name, File::get($logo_path));
            //Setear nombre del logo en el objeto
            $company->logo = $logo_path_name;
        }

        //Guardar en la BBDD
        $company->save();

        return redirect()->route('companies')->with([
            'message' => 'Company added successfully!'
        ]);
    }

    public function edit($id) {
            $company = Company::find($id);

            return view('company.edit', [
                'company' => $company
            ]);
    }

    public function update(Request $request) {
        //Validacion del formulrario
        $validate = $this->validate($request, [
            'comp-name' => 'required|string|max:255',
            'comp-email' => 'required|string|email',
            'website' => 'required|string|max:100',
            'logo' => 'mimes:png,jpeg,jpg,gif|dimensions:min_width=100,min_height=100'
        ]);
        //Recoger datos del formulrario
        //$user = \Auth::user();
        $id = $request->input('company_id');
        $name = $request->input('comp-name');
        $website = $request->input('website');
        $email = $request->input('comp-email');

        //Conseguir el objeto Company para setear los datos nuevos
        $company = Company::find($id);
        //Asignar nuevos valores al objeto Company
        $company_id = $company->id;
        $company->name = $name;
        $company->website = $website;
        $company->email = $email;

        //Recoger imagen del formulario
        $logo_path = $request->file('logo');
        if($logo_path) {
            $logo_path_name = time().$logo_path->getClientOriginalName();
            Storage::disk('public')->put($logo_path_name, File::get($logo_path));
            $company->logo = $logo_path_name;
        }

        $company->update();

        return redirect()->route('companies')->with([
            'message' => 'Company upadated successfully'
        ]);
    }

    public function delete($id) {
        $user = \Auth::user();
        $company = Company::find($id);

        if($user && $company && $user->is_admin) {
        $company->delete('name');
        $company->delete('website');
        $company->delete('email');
        //Eliminar ficheros de imagen
        Storage::disk('public')->delete($company->logo);
        //Eliminar registro Company
        $company->delete();

        $message = array( 'message' => 'Company deleted successfully');
    } else {
        $message = array( 'message' => 'Failed to delete company');
    }

        return redirect()->route('companies')->with($message);
    }

    public function showEmployeesFromCompany($id) {
        $company = Company::find($id);
        $employees = Employee::where('company_id', $company->id)->orderBy('last_name')->get();

        return view('company.show')->with([
            'employees' => $employees
        ]);
    }
}
