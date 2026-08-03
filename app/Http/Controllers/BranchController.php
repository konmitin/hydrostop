<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function getActive(Request $request)
    {
        $branchId = session('branch_id') ?? 1;
        $branch = Branch::find($branchId);

        return response([
            'data' => $branch,
        ]);
    }

    public function setActive(Request $request, int $branchId)
    {

        $branch = Branch::find($branchId);

        if (!$branch) {
            return response([
                'errors' => [
                    'branch' => 'Ошибка выбора города, данный город не существует'
                ],
            ], 422);
        }

        session('branch_id', $branchId ?? 1);

        return response([
            'data' => $branch,
        ]);
    }
}
