<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CompaniesController extends Controller
{
    
    public function index()
    {
        //show all companies for the login user
        // $companies = Company::all();
        // return view('companies.index', ['companies'=> $companies]); 


        //show only companies whish created by login user
        if(Auth::check())
        {
            $companies = Company::where('user_id', Auth::user()->id)->get();
            return view('companies.index', ['companies'=> $companies]); 
        }
        return view('auth.login');

    }

    
    public function create()
    {
        return view('companies.create');
    }

    
    public function store(Request $request)
    {

        // $input = $request->all();
        // $user = Auth::user();
        // $user->companies()->create($input)->save();
        // Session::flash('created_post', 'The post has been created');
        // return redirect('/companies');

//=================================//

        if(Auth::check())
        {
            $company = Company::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]);

            if($company)
            {
                Session::flash('created_company', 'The company has been created');
                return redirect('/companies');
            }
        }

        return redirect()->back();




    }

    
    public function show(Company $company)
    {
        
        // $company = Company::where('id', $company->id)->first();
        // return view('companies.show', compact('company'));

        $company = Company::findOrFail($company->id);
        return view('companies.show', compact('company'));
    }

    
    public function edit(Company $company)
    {
        $company = Company::findOrFail($company->id);

        return view('companies.edit', compact('company'));
    }

    
    public function update(Request $request, Company $company)
    {
        $companyUpdate = Company::where('id', $company->id);

        $companyUpdate->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ]);

        Session::flash('updated_company', 'The company has been updated');

        return redirect()->route('companies.index');        
   
    }

   
    public function destroy(Company $company)
    {
        $company = Company::findOrFail($company->id);

        $company->delete();

        Session::flash('deleted_company', 'The company has been deleted successfuly');

        return redirect('/companies');
    }
}
