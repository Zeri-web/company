<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users',
            // 'website_link' => 'required|string|max:255',
            // 'logo' => 'required|image|dimensions:min_width=100,min_height=100',
            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website_link' => $request->website_link
        ]);

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logoPath = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('public/images/', $logoPath);

            $company->update([
                'logo' => $logoPath,
            ]);
        }

        Alert::Success('Success', 'The company has been successfully created');

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users',
            // 'website_link' => 'required|string|max:255',
            // 'logo' => 'required|image|dimensions:min_width=100,min_height=100',
            
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website_link' => $request->website_link,
        ]);

        if ($request->hasFile('logo')) {
            $logo = $company->logo;
        
            if (Storage::exists('public/images/' . $logo)) {
                Storage::delete('public/images/' . $logo);
            }
        
            $logoPath = $request->file('logo')->storeAs('public/images/', $request->file('logo')->getClientOriginalName());
            $company->logo = $request->file('logo')->getClientOriginalName();
            $company->save();
        }

        Alert::Success('Success', 'The company has been successfully edited');

        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company)
    {
        $company = Company::find($company);
        $company->delete();

        Alert::Success('Success', 'The company has been successfully deleted');

        return to_route('dashboard');
    }
}
