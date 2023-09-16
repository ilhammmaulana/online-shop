@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Products'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Products</h6>
                    </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <button type="button" class="btn bg-gradient-primary ms-4 mt-1 mb-4" data-bs-toggle="modal"
                                data-bs-target="#createProduct">
                                Create Product
                            </button>
                            {{-- Edit --}}
                            <div class="modal fade" id="editProduct" tabindex="-1" role="dialog"
                            aria-labelledby="editModelProduct" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModelProduct">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form enctype="multipart/form-data" id="editForm"   action="" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <img id="editImagePreview" src="#" alt="Image Preview"
                                                    style="display: none; max-width: 100%; max-height: 300px;">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="name" class="h6">Product name</label>
                                                    <div class="form-group">
                                                        <input required type="text" name="name" class="form-control" id="update-name"
                                                            placeholder="Product name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="description" class="h6">Description</label>
                                                    <div class="form-group">
                                                        <textarea required name="description" class="form-control" id="update-description" >
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="price" class="h6">Price</label>
                                                    <div class="form-group">
                                                        <input required name="price" class="form-control" id="update-price" />
                                                        <span id="priceError" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="update_category_product" class="h6">Select Category Product</label>
                                                        <select required name="category_id" class="form-control" id="update_category_product">
                                                            <option value="Product Catgeory" disabled selected>Product Catgeory</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="photo" class="h6">Product photo</label>
                                                    <div class="form-group">
                                                        <input type="file" id="imageInput"
                                                            onchange="previewImageForEdit(event)"class="form-control"
                                                            name="image">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="latitude" class="h6">Latitude</label>
                                                    <div class="form-group">
                                                        <input required type="text" class="form-control" id="update-latitude"
                                                            name="latitude" placeholder="Latitude">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="longitude" class="h6">Longitude</label>
                                                    <div class="form-group">
                                                        <input required type="text" class="form-control" id="update-longitude"
                                                            name="longitude" placeholder="Longitude">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="address" class="h6">Product address</label>
                                                    <div class="form-group">
                                                        <input required type="text" class="form-control" id="update-address"
                                                            name="address" placeholder="Product address">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Update</button>
                                    </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Create --}}
                        <div class="modal fade" id="createProduct" tabindex="-1" role="dialog"
                            aria-labelledby="createModelProduct" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createModelProduct">Craete Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <img id="imagePreview" src="#" alt="Image Preview"
                                                    style="display: none; max-width: 100%; max-height: 300px;">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="name" class="h6">Product name</label>
                                                    <div class="form-group">
                                                        <input required type="text" name="name" class="form-control" id="name"
                                                            placeholder="Product name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="description" class="h6">Product description</label>
                                                    <div class="form-group">
                                                        <textarea required name="description" class="form-control" id="name"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="price" class="h6">Price</label>
                                                    <div class="form-group">
                                                        <input required name="price" class="form-control" id="price" />
                                                        <span id="priceError" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="category_Products" class="h6">Select Category Product</label>
                                                        <select required name="category_id" class="form-control" id="category_Products">
                                                            <option value="Product Catgeory" disabled selected>Product Catgeory</option>
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="photo" class="h6">Product photo</label>
                                                    <div class="form-group">
                                                        <input type="file" id="imageInput"
                                                            onchange="previewImage(event)"class="form-control"
                                                            name="image">
                                                    </div>
                                                </div>
                                             
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Create</button>
                                    </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-sm p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Photo</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Avarage Rating</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $product['name'] }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ Str::limit($product['description'], 40, '...') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        <td>
                                                <div>
                                                    <img src="{{ $product['image'] === null ? asset('assets/img/default.png') : asset($product['image']) }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <p class="{{ $product['average_rating'] !== null ? 'text-warning' : '' }}"> <i class="fas fa-star me-1"></i>{{ $product['average_rating'] === null ? 0 : number_format($product['average_rating'], 2) }}</p> --}}
                                                0
                                            </td>
                                            <td class="align-middle text-xs font-weight-bold">
                                                {{ format_rupiah($product['price']) }}
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary edit-button"
                                                data-bs-toggle="modal" data-bs-target="#editProduct"
                                                data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}"
                                                data-description="{{ $product->description }}"
                                                data-price="{{ $product->price }}"
                                                data-category="{{ $product->category_id }}"
                                                data-image="{{ $product->image === null ? null : url($product->image) }}"
                                            >
                                                Edit
                                                <form action="{{ url('products') . '/' .$product->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                </button>
                                                <button TYPE="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <ul class="pagination pagination-primary ms-3 mt-4">
                                @if ($products->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif
                        
                                @if ($products->lastPage() == 1) 
                                    <li class="page-item active"><span class="page-link">1</span></li>
                                @else
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        @if ($page == $products->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                        
                                @if ($products->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                @endif
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>

    <script>
       document.addEventListener("DOMContentLoaded", function() {
        const priceInput = document.getElementById("price");
    const priceError = document.getElementById("priceError");

    priceInput.addEventListener("input", function() {
        const inputValue = priceInput.value;

        const numericValue = inputValue.replace(/\D/g, '');

        priceInput.value = numericValue;

        if (inputValue !== numericValue) {
            priceError.textContent = "Please enter a valid integer.";
        } else {
            priceError.textContent = "";
        }
    });
});
        </script>
    <script>
    const imagePreview = document.getElementById('imagePreview');
    const editImagePreview = document.getElementById('editImagePreview');

        
        function previewImage(event) {
            const imageInput = event.target;

            if (imageInput.files && imageInput.files[0]) {
                const file = imageInput.files[0];
                const reader = new FileReader();

                const fileType = file.type;
                const validImageTypes = ['image/jpeg', 'image/jpg'];
                if (!validImageTypes.includes(fileType)) {
                    alert('Please select a valid JPG/JPEG image.');
                    imageInput.value = '';
                    return;
                }

                const fileSizeMB = file.size / (1024 * 1024);
                const maxSizeMB = 2;
                if (fileSizeMB > maxSizeMB) {
                    alert('Image size must be less than 2MB.');
                    imageInput.value = '';
                    return;
                }

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '#';
                imagePreview.style.display = 'none';
            }
        }
        function previewImageForEdit(event)
        {
            const imageInput = event.target;

            if (imageInput.files && imageInput.files[0]) {
                const file = imageInput.files[0];
                const reader = new FileReader();

                const fileType = file.type;
                const validImageTypes = ['image/jpeg', 'image/jpg'];
                if (!validImageTypes.includes(fileType)) {
                    alert('Please select a valid JPG/JPEG image.');
                    imageInput.value = '';
                    return;
                }

                const fileSizeMB = file.size / (1024 * 1024);
                const maxSizeMB = 2;
                if (fileSizeMB > maxSizeMB) {
                    alert('Image size must be less than 2MB.');
                    imageInput.value = '';
                    return;
                }

                reader.onload = function(e) {
                    editImagePreview.src = e.target.result;
                    editImagePreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                editImagePreview.src = '#';
                editImagePreview.style.display = 'none';
            }
        }
        const editButtons = document.querySelectorAll('.edit-button');
    const editForm = document.getElementById('editForm');
    const editNameInput = document.getElementById('update-name');
    const editDescriptionInput = document.getElementById('update-description');
    const editPriceInput = document.getElementById('update-price');
    const editLongitude = document.getElementById('update-longitude');
    const editLatitude = document.getElementById('update-latitude');
    const editAdress = document.getElementById('update-address');
    const editCategoryDropdown = document.getElementById('update_category_product');
    const editCityDropdown = document.getElementById('update_city');
    const editProvinceDropdown = document.getElementById('update_provinces');

  
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            const price = button.getAttribute('data-price');
            const longitude = button.getAttribute('data-longitude');
            const latitude = button.getAttribute('data-latitude');
            const address = button.getAttribute('data-address');
            const image = button.getAttribute('data-image');
            const category = button.getAttribute('data-category');
            const city = button.getAttribute('data-city');
            const province = button.getAttribute('data-province');

            const url = "{{ url('Products') }}" + '/' + id;
            editForm.setAttribute('action', url);
            editNameInput.value = name;
            editImagePreview.src = image;
            editImagePreview.style.display = 'block';
            editDescriptionInput.value = description;
            editPriceInput.value = price;
            editLatitude.value = latitude;
            editLongitude.value = longitude;
            editAdress.value = address;
            setSelectedOption(editCategoryDropdown, category);
            setSelectedOption(editCityDropdown, city);
            console.log(city)
            setSelectedOption(editProvinceDropdown, province);

        });
        
    });
    function setSelectedOption(dropdown, value) {
    const options = dropdown.options;
    for (let i = 0; i < options.length; i++) {
        if (options[i].value === value) {
            options[i].selected = true;
            break;
        }
    }
}
    </script>
@endsection
