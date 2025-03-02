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
                <h2>Services Management</h2>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="text-right">
                <a href="{{route('admin.add_service')}}" class="primary-btn primary-bg">Add New</a>
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
                  <th>Bullet Points</th>
                  <th>image</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ;?>
                @foreach($services as $service)
               
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$service->title}}</td>
                  <td>
                    <div class="limit-text">
                      {{$service->short_desc}}
                    </div>
                  </td>
                  <td>{!! $service->long_desc !!}</td>
                  <td>
                    <img src="{{ asset($service->img_path) }}" alt='image' class='imgFluid list-img' loading='lazy'>
                  </td>
               
                
                   <td>{{date("d/m/y",strtotime($service->created_at))}}</td> 
                
                  
                  <td>{{$service->is_active == 1 ? 'Active' : 'Non-Active'}}</td>
                  <td>
                    <div class="dropdown show action-dropdown">
                      <a class=" dropdown-toggle" href="#" role="button" id="action-dropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="action-dropdown">
                      
                        <a class="dropdown-item" href="{{route('admin.edit_service',$service->id)}}"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i>
                          Edit</a>
                          <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this Service  ')" href="{{route('admin.delete_service',$service->id)}}"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i>
                          Delete</a>
                          @if($service->is_active == 1)
                        <a class="dropdown-item" href="{{route('admin.suspend_service',$service->id)}}"><i class="fa fa-ban" aria-hidden="true"></i> In Active</a>
                        @else
                        <a class="dropdown-item" href="{{route('admin.suspend_service',$service->id)}}"><i class="fa fa-ban" aria-hidden="true"></i> Activate</a>
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>
                <?php $i++;?>
               @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    </div>
    </div>

  

@endsection
@section('css')
<style type="text/css">
	/*in page css here*/
</style>
@endsection
@section('js')
<script type="text/javascript">
   
</script>
@endsection