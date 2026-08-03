<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return response([
            'data' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $company->fill($request->all());

        if (isset($request->inn)) {
            $company->inn = preg_replace("/[^\d.]/", "", $request->inn);
        }
        if (isset($request->kpp)) {
            $company->kpp = preg_replace("/[^\d.]/", "", $request->kpp);
        }
        if (isset($request->ogrn)) {
            $company->ogrn = preg_replace("/[^\d.]/", "", $request->ogrn);
        }
        if (isset($request->ogrn)) {
            $company->okpo = preg_replace("/[^\d.]/", "", $request->okpo);
        }

        $company->save();

        return response([
            'data' => $company
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
