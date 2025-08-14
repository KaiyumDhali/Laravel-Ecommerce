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
        $company_info = CompanyInfo::first();
        return view('about',compact('company_info'));
    }


     public function edit()
    {
        // Get the first (or only) company info record
        $companyInfo = CompanyInfo::first();

        // If no record exists, create a blank one to avoid errors
        if (!$companyInfo) {
            $companyInfo = new CompanyInfo();
            $companyInfo->company_name = '';
            $companyInfo->company_address = '';
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
    //dd($request);
    $validated = $request->validate([
        'company_name' => 'required|string|max:255',
        'company_address' => 'required|string|max:255',
        'mobile' => 'required|string',
        'email' => 'required|string',
        'mission' => 'required|string',
        'vision' => 'required|string',
        'values' => 'required|string',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Find existing or create new
    $companyInfo = CompanyInfo::first();
    if (!$companyInfo) {
        $companyInfo = new CompanyInfo();
    }

    // Handle image upload
    if ($request->hasFile('company_logo')) {
        $imageName = 'company_logo_' . time() . '.' . $request->company_logo->extension();
        $request->company_logo->move(public_path('uploads/company'), $imageName);
        $companyInfo->company_logo = 'uploads/company/' . $imageName; // ✅ assign to correct variable
    }

    // Fill data
    $companyInfo->company_name = $validated['company_name'];
    $companyInfo->company_address = $validated['company_address'];
    $companyInfo->mobile = $validated['mobile'];
    $companyInfo->email = $validated['email'];
    $companyInfo->mission = $validated['mission'];
    $companyInfo->vision = $validated['vision'];
    $companyInfo->values = $validated['values'];

    $companyInfo->save();

    return redirect()->route('company-info.edit')->with('success', 'Company information updated successfully.');
}

}
