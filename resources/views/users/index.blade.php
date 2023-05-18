
@extends('main')
@section('page-name', 'Users')
@section('content')
<div>
    <button class="btnAdd btn primary mb-2">Add new</button>
</div>
<div class="table-responsive">
    <table class="table table-striped table-hover table-sm dataTable" id="user-table">
      <thead>
        <tr>
          <th>#ID</th>
          <th>Name</th>
          <th data-orderable="false">Image</th>
          <th data-orderable="false">Address</th>
          <th data-orderable="false">Gender</th>
          <th data-orderable="false">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($users as $item)
            <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>
                @if (!empty($item['thumb_image']))
                    <img src="{{ !empty($item['thumb_image']) ? url(env('IMAGE_PATH')). '/' . $item['thumb_image'] : '' }}" alt="Image">
                @endif
            </td>
            <td>{{ $item['address'] }}</td>
            <td>{{ $item['gender'] }}</td>
            <td>
                <a href="#" class="editBtn" data-id="{{ $item['id'] }}">Edit</a>
                <a href="{{ route('users.delete',[$item['id']]) }}" class="deleteBtn">Delete</a>
            </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  
  @include('users.add')
@endsection

@section('css')
<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }
</style>
@endsection
@section('script')
  <script>

    $(document).ready(function () {
        $('#user-table').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    $(document).on('click', '.btnAdd',function(event){
            $('#add_users_frm')[0].reset();
            $("#add_users_modal").modal('show');
    });

    $("#add_users_frm").validate({
        rules: {
            name: {
                required: true,
            },
            address: {
                required: true
            },
            image: {
                required: true
            },
            gender: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Name is required",
            },
            address: {
                required: "Address is required"
            },
            gender: {
                required: "Gender is required"
            },
            image: {
                required: "Image is required"
            },
        },
        errorPlacement: function(error, element) {
			var placement = $(element).data('error');
			if (placement) {
				$(placement).append(error)
			} else {
				error.insertAfter(element);
			}
		},
        submitHandler: function() { 
            return true;
        }
    });

  </script>
@endsection