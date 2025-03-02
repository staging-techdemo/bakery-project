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
                                <h2>packages Management</h2>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="text-right">
                                <a href="{{ route('admin.add_packages') }}" class="primary-btn primary-bg">Add New</a>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="user-table" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>

                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price ($)</th>
                                    <th>Type</th>
                                    <th>Limited</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{ $i }}</td>

                                        <td>{{ $package->title }}</td>
                                        <td>{{ $package->short_desc }}</td>
                                        <td>${{ $package->price }}</td>
                                        <td>{{ $package->type }}</td>
                                        <td>{{ $package->is_limited == 1 ? "Limited" : '-' }}</td>
                                        <td>{{ $package->is_active == 1 ? 'Active' : 'Non-Active' }}</td>
                                        <td>{{ date('d/m/y', strtotime($package->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class=" dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.edit_packages', $package->id) }}"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.delete_packages', $package->id) }}"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Delete</a>
                                                    @if ($package->is_active == 1)
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.suspend_packages', $package->id) }}"><i
                                                                class="fa fa-ban" aria-hidden="true"></i> In Active</a>
                                                    @else
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.suspend_packages', $package->id) }}"><i
                                                                class="fa fa-ban" aria-hidden="true"></i> Activate</a>
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
