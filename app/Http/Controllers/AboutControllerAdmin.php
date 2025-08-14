<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;

class AboutControllerAdmin extends Controller
{
    public function index()
    {
        $companyInfo = CompanyInfo::first();
       
        return view('admin.about', compact('companyInfo'));
    }

    // public function update(Request $request)
    // {
    //     $companyInfo = CompanyInfo::first();
    //     $companyInfo->update($request->all());
    //     return redirect()->back()->with('success', 'Information updated successfully.');
    // }

    public function frontview(){
        $companyInfo = CompanyInfo::first();
        return view('about',compact('companyInfo'));
    }


     public function edit()
    {
        // Get the first (or only) company info record
        $companyInfo = CompanyInfo::first();

        // If no record exists, create a blank one to avoid errors
        if (!$companyInfo) {
            $companyInfo = new CompanyInfo();
            $companyInfo->company_name = '';
            $companyInfo->mobile = '';
            $companyInfo->email = '';
            $companyInfo->mission = '';
            $companyInfo->vision = '';
            $companyInfo->values = '';
        }

        return view('admin.about.create_about', compact('companyInfo'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'mobile' => 'required|string',
            'email' => 'required|string',
            'mission' => 'required|string',
            'vision' => 'required|string',
            'values' => 'required|string',
        ]);

        // Find existing or create new
        $companyInfo = CompanyInfo::first();

        if (!$companyInfo) {
            $companyInfo = new CompanyInfo();
        }

        // Fill data
        $companyInfo->company_name = $validated['company_name'];
        $companyInfo->mobile = $validated['mobile'];
        $companyInfo->email = $validated['email'];
        $companyInfo->mission = $validated['mission'];
        $companyInfo->vision = $validated['vision'];
        $companyInfo->values = $validated['values'];

        $companyInfo->save();

        return redirect()->route('company-info.edit')->with('success', 'Company information updated successfully.');
    }
}
