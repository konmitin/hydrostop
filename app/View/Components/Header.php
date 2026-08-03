<?php

namespace App\View\Components;

use App\Models\Branch;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public Branch $branch;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $branchId = session('branch_id') ?? 1;
        $this->branch = Branch::find($branchId);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
