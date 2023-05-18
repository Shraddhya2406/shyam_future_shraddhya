
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
            <td>{{ $item['image'] }}</td>
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
  </script>
@endsection