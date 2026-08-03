<?php

namespace App\View\Components;

use App\Models\Branch;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Template extends Component
{
    public Branch $branch;
    public string $yandexMetrika;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public mixed $title,
        public mixed $description,
    ) {
        $branchId = session('branch_id') ?? 1;
        $this->branch = Branch::find($branchId);

        $this->yandexMetrika = env('YANDEX_METRIKA', '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.template');
    }
}
