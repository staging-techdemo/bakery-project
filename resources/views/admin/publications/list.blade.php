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
                <h2>Publication </h2>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="text-right">
                <!--<a href="{{route('admin.add_testimonial')}}" class="primary-btn primary-bg">Add New</a>-->
              </div>
            </div>
          </div>

        

          <div class="table-responsive">
            <table id="user-table" class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Institute Name</th>
                  <th>Person Name</th>
                  <th>Role</th>
                  <th>Title</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ;?>
                @foreach($publications as $publication)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$publication->get_publication_profiles->username}}</td>
                  <td>{{$publication->get_publication_users->full_name}}</td>
                  <td>{{$publication->get_publication_users->role_id == 2 ? 'Teacher' : 'Student'}}</td>
                  <td>{{$publication->title}}</td>

                   <td>{{date("d/m/y",strtotime($publication->created_at))}}</td> 
                
                  
                  <td>{{$publication->is_active == 1 ? 'Active' : 'Inactive'}}</td>
                  <td>
                    <div class="dropdown show action-dropdown">
                      <a class=" dropdown-toggle" href="#" role="button" id="action-dropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="action-dropdown">
                      
                        <a class="dropdown-item" href="{{route('admin.edit_publication',$publication->id)}}"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i>
                          View</a>
                          <a class="dropdown-item" href="{{route('admin.delete_publication',$publication->id)}}"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i>
                          Delete</a>
                          @if($publication->is_active == 1)
                        <a class="dropdown-item" href="{{route('admin.suspend_publication',$publication->id)}}"><i class="fa fa-ban" aria-hidden="true"></i> In Active</a>
                        @else
                        <a class="dropdown-item" href="{{route('admin.suspend_publication',$publication->id)}}"><i class="fa fa-ban" aria-hidden="true"></i> Activate</a>
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