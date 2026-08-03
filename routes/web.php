<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\UserController;
use App\Http\Resources\ProductResource;
use App\Http\Resources\PropertyValueResource;
use App\Http\Resources\SertificateResource;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductPropertyValue;
use App\Models\Property;
use App\Models\Sertificate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'user']);
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/user/logout', [UserController::class, 'logout']);

Route::get('/public/branches/active', [BranchController::class, 'getActive']);
Route::post('/public/branches/active/{branchId}', [BranchController::class, 'setActive']);

Route::apiResource('/public/calls', CallController::class);
Route::apiResource('/public/sertificates', CallController::class);

Route::get('/', function (Request $request) {

    $products = Product::limit(8)->get();

    return view('index', [
        'about' => '',
        'phone' => '',
        'email' => '',
        'address' => '',
        'work_hours' => '',
        'products' => $products,
        'branch' => $request->branch
    ]);
})->middleware('branch');

Route::get('/catalog/{category?}', function (Request $request, ?string $category = null) {
    $breadcrumbs = [
        [
            'text' => 'Главная',
            'href' => '/'
        ]
    ];

    $sort = $request->sort ?? 'name';
    $order = $request->order ?? 'asc';

    $categorySlug = $request->category;

    $products = new Product;

    if (isset($sort)) {
        $products = $products->orderBy($sort, $order ?? 'asc');
    }

    if (isset($category)) {
        $products = $products->whereHas('category', function (Builder $query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        });
    }

    $products = $products->paginate(20);

    $categories = Category::get();

    return view(
        'catalog',
        [
            'breadcrumbs' => $breadcrumbs,
            'sort' => $sort,
            'order' => $order,
            'products' => $products,
            'categories' => $categories,
            'active_category' => $categorySlug,
            'branch' => $request->branch
        ]
    );
})->middleware('branch');

Route::get('/catalog/{category}/{product}', function (Request $request, string $categorySlug, string $productSlug) {
    $breadcrumbs = [
        [
            'text' => 'Главная',
            'href' => '/'
        ],
        [
            'text' => 'Каталог',
            'href' => '/catalog'
        ]
    ];

    $category = Category::where('slug', $categorySlug)->first();

    $breadcrumbs[] = [
        'text' => $category->name,
        'href' => '/catalog/' . $category->slug,
    ];

    $product = Product::where('slug', $productSlug)->first();

    if (!$product) {
        return view('errors.404');
    }

    $properties = ProductPropertyValue::where('product_id', $product->id)->where('is_hidden', 'N')->get();

    $otherProducts = Product::whereHas('category', function (Builder $query) use ($categorySlug) {
        $query->where('slug', $categorySlug);
    })->get();

    return view(
        'product',
        [
            'breadcrumbs' => $breadcrumbs,
            'properties' => $properties,
            'category' => $category,
            'otherProducts' => $otherProducts,
            'product' => $product,
            'branch' => $request->branch
        ]
    );
})->middleware('branch');

Route::get('/about', function (Request $request) {
    $breadcrumbs = [
        [
            'text' => 'Главная',
            'href' => '/'
        ]
    ];

    $serts = Sertificate::paginate(20);

    return view('about', [
        'breadcrumbs' => $breadcrumbs,
        'branch' => $request->branch,
        'sertificates' => $serts->items(),
    ]);
})->middleware('branch');

Route::get('/privacy', function (Request $request) {
    $breadcrumbs = [
        [
            'text' => 'Главная',
            'href' => '/'
        ]
    ];

    return view('privacy', [
        'breadcrumbs' => $breadcrumbs,
        'branch' => $request->branch
    ]);
})->middleware('branch');

Route::get('/contacts', function (Request $request) {
    $company = Company::find(1);

    return view('contacts', [
        'company' => $company,
        'branch' => $request->branch
    ]);
})->middleware('branch');

Route::get('/h-admin/auth', function (Request $request) {
    return view('admin/index');
})->name('admin-login');

Route::get('/h-admin', function (Request $request) {
    return view('admin/index');
})->middleware('userAuth');

Route::get('/h-admin/{any}', function () {
    return view('admin/index');
})->where('any', '.*')->middleware('userAuth');
