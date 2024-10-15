@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="chart-wrapper">


                <div class="user-wrapper">
                    <div class="row align-items-center mc-b-3">
                        <div class="col-lg-6 col-12">
                            <div class="primary-heading color-dark">
                                <h2>Products Management</h2>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="text-right">
                                <a href="{{ route('admin.add_products') }}" class="primary-btn primary-bg">Add New</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="user-table" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>

                                    <th>Title</th>
                                    {{-- <th>Old Price ($)</th> --}}
                                    <th> Price ($)</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Image</th>
                                    <th>Featured Product</th>
                                    <th>Created At</th>


                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $i }}</td>

                                        <td>{{ $product->title ?? '' }}</td>
                                        {{-- <td>${{ $product->old_price }}</td> --}}
                                        <td>${{ $product->price }}</td>
                                        <td>{!! $product->long_desc !!}</td>

                                        <td>
                                            {{-- @php
                                                foreach($products_categories as $category){
                                                    if($category->id == $product->category_id){
                                                        echo $category->title;
                                                        break;
                                                    }
                                                }
                                            @endphp --}}
                                            {{ $product->get_categories->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $product->get_sub_categories->title ?? 'N/A' }}
                                        </td>
                                        <td><img src="{{ asset($product->img_path) }}" class="list-img "></td>
                                        <td>{{ $product->is_featured == '1' ? 'Featured' : 'Not featured' }}</td>
                                        <td>{{ date('d/m/y', strtotime($product->created_at)) }}</td>
                                        <td>
                                            @if ($product->get_categories)
                                                @if ($product->get_categories->is_active == 1)
                                                    @if ($product->is_active == 1)
                                                        <span>Active</span>
                                                    @else
                                                        <span>Non-Active</span>
                                                    @endif
                                                @else
                                                <span>Product Category Suspended</span>
                                                    
                                                @endif
                                            @else
                                            <span>Category is Deleted</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="action-dropdown" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">
                                                    <a class="dropdown-item" href="{{ route('admin.edit_products', $product->id) }}">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        @if ($product->get_categories && $product->get_categories->is_active == 1)
                                                            Edit
                                                        @else ($product->get_categories && $product->get_categories->is_active == 3)
                                                            Change Category
                                                        @endif
                                                    </a>
                                                    <a onclick="return confirm('Are you sure you want to delete this product?')" class="dropdown-item"
                                                        href="{{ route('admin.delete_products', $product->id) }}">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete
                                                    </a>
                                        
                                                    @if ($product->get_categories && $product->get_categories->is_active == 1)
                                                    @if ($product->is_active == 1)
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.suspend_products', $product->id) }}">
                                                            <i class="fa fa-ban" aria-hidden="true"></i> Inactive
                                                        </a>
                                                    @else
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.suspend_products', $product->id) }}">
                                                            <i class="fa fa-check-circle" aria-hidden="true"></i> Activate
                                                        </a>
                                                    @endif
                                                @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">
        .list-img {
            width: 160px;
            margin: auto;
            object-fit: contain;
            object-position: top;
            aspect-ratio: auto;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {

            /*in page js here*/
        })()
    </script>
@endsection
