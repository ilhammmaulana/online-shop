<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateProfileRequest;
use App\Http\Requests\WEB\CreateProduct;
use App\Http\Requests\WEB\CreateProductRequest;
use App\Http\Requests\WEB\UpdateProductRequest;
use App\Models\CategoryProduct;
use App\Repositories\CategoryProductRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends ApiController
{
    private $categoryProductRepository, $productRepository;
    /**
     * Class constructor.
     */
    public function __construct(CategoryProductRepository $categoryProductRepository, ProductRepository $productRepository)
    {
        $this->categoryProductRepository = $categoryProductRepository;
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  $this->categoryProductRepository->getAll();
        $products = $this->productRepository->getAll();
        return view('pages.products', [
            "categories" => $categories,
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $createProductRequest)
    {
        try {
            $input = $createProductRequest->only('name', 'description', 'price', 'category_id');
            CategoryProduct::findOrFail($input['category_id']);
            $photo = $createProductRequest->file('image');
            $path = 'public/'. Storage::disk('public')->put('images/users', $photo);
            $input['image'] = $path;
            $this->productRepository->create(auth()->id(), $input);
            return redirect()->to('products')->with('success', 'Success create product !');
        } catch (\Throwable $th) {
            throw $th;
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('failed', 'Category not found');
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $updateProductRequest, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
