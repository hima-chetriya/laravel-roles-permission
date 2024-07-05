@extends('layouts.backend.main')

@section('content')
@php
$locale = config('app.locale');
@endphp
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="container-fluhjhjid">
        <div class="page-title">
          <div class="row">
            <div class="col-6">
              <h4>Users</h4>
            </div>
            <div class="col-6">
              <div class="list-product-header">
                <a id="AddUserModal" class="btn btn-primary" data-ajax-popup="false" href="javascript:void(0);" data-url="{{route('users.create')}}"><i class="fa fa-plus"></i>Add User</a><br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="list-product">
            <form action="" method="" enctype="multipart/form-data" id="searchForm">
              <div class="row">
                <div class="col-md-4 position-relative">
                  <strong>Name:</strong>
                  <input type="text" class="form-control" value="{{@$request->name}}" name="name" id="name" placeholder="Name">
                </div>
                <div class="col-md-4 position-relative">
                  <strong>Date From:</strong>
                  <input type="date" name="start_date" class="form-control" value="{{@$request->start_date}}" placeholder="Start Date">
                </div>
                <div class="col-md-4 position-relative">
                  <strong>Date To:</strong>
                  <input type="date" name="end_date" class="form-control" value="{{@$request->end_date}}" placeholder="End Date">
                </div>
              </div>

              <div class="row" style="margin-top: 20px;">
                <div class="form-group col-md-4">
                  <strong>Gender:</strong>
                  <select name="gender" id="gender" class="form-control">
                    <option selected="" disabled="" value="">Choose...</option>
                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <strong>Country:</strong>
                  <select class="form-select" name="country">
                    <option selected="" disabled="" value="">Choose...</option>
                    <option value="canada" {{ request('country') == 'canada' ? 'selected' : '' }}>Canada</option>
                    <option value="london" {{ request('country') == 'london' ? 'selected' : '' }}>London</option>
                    <option value="japan" {{ request('country') == 'japan' ? 'selected' : '' }}>Japan</option>
                    <option value="us" {{ request('country') == 'us' ? 'selected' : '' }}>U.S </option>
                    <option value="thailand" {{ request('country') == 'thailand' ? 'selected' : '' }}>Thailand </option>
                    <option value="india" {{ request('country') == 'india' ? 'selected' : '' }}>India </option>
                  </select>
                </div>
              </div>
          </div>
          <br>
          <div class="modal-footer">
            <button class="btn btn-primary" id="ajax_filter" type="submit">Apply </button>
            <button class="btn btn-secondary" id="clearButton" type="button" data-bs-dismiss="modal">Cancel</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body">
        <div class="list-product">
          <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <a class="btn btn-warning float-end" href="{{ route('users-export') }}"><i class="fa fa-download"></i> Export User Data</a>
            <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
          </form>

          <table class="display table" id="user_table">
            <thead>
              <tr>
              </tr>
              <tr>
                <th><b>Name</b></th>
                <th><b>Email</b></th>
                <th><b>Gender</b></th>
                <th><b>Country</b></th>
                <!-- <th><b>Countries</b></th> -->
                <th><b>Hobbies</b></th>
                <th><b>Role</b></th>
                <th><b>Status</b></th>
                <th><b>Action</b></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- User Create Modal -->
<div id="AddUpdateUsersModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
  </div>
</div>
</div>




<script>




    $(document).ready(function() {
            $('#AddProduct').validate({
                rules: {
                    name: {
                        required: true
                    },
                  
                },
                messages: {
                    name: {
                        required: "Please enter your name"
                    },
                    
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });



  $(document).ready(function() {
    $('#clearButton').click(function() {
      // Clear all input fields in the form
      $('#searchForm').find('input[type="text"], input[type="date"], select').val('');
      table.search('').columns().search('').draw();
    });
  });

  $('#ajax_filter').click(function() {
    var url = $(this).data('url');
    $.ajax({
      type: "GET",
      url: url,
      dataType: 'html',
      success: function(data) {
        $('#searchForm').html(
          $('<div />').html(data).find('#searchForm').html()
        );
      }
    });

  });

  var table = "";
  $(document).ready(function() {
    // User List
    
    table = $('#user_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('users.index') }}?name={{ request('name') }}&start_date={{ request('start_date') }}&end_date={{ request('end_date') }}&gender={{ request('gender')}}&country={{ request('country')}}",
      columns: [{
          data: 'name',
          name: 'name'
        },

        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'gender',
          name: 'gender'
        },
        {
          data: 'country',
          name: 'country'
        },

        {
          data: 'hobbies',
          name: 'hobbies'
        },
        {
          data: 'roles',
          name: 'roles'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }
      ]
    });

    //   User Create Modal

    $(document).on('click', '#AddUserModal', function() {
      var url = $(this).data('url');
      $.ajax({
        url: url,
        type: 'GET',
        // dataType: 'html',
        success: function(response) {

          $('#AddUpdateUsersModal .modal-dialog').html(response);
          $('#AddUpdateUsersModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });



    $(document).on('click', '#EditUsersModal', function() {
      var url = $(this).data('url');
      $.ajax({
        url: url,
        type: 'GET',
        // dataType: 'html',
        success: function(response) {

          $('#AddUpdateUsersModal .modal-dialog').html(response);
          $('#AddUpdateUsersModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });

  });


  // Delete User 

  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    swal.fire({
      title: 'Are you sure?',
      text: 'You won\'t be able to revert this!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "DELETE",
          url: $(this).data('url'),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            console.log(response);
            if (response) {
              swal.fire(
                'Deleted!',
                'Your user has been deleted.',
                'success'
              );
              table.draw();
              // reload();
            }

          },
          error: function(response) {
            swal.fire(
              'Error!',
              'Failed to delete user.',
              'error'
            );
          }
        });
      }
    });

    $('#clearButton').click(function() {
      // Clear all input fields in the form
      $('#searchForm').find('input[type="text"], input[type="date"]').val('');
    });
  });


  $(document).on('click', '#toggle-class', function(e) {
    let status = $(this).data('status');
    console.log(status);
    $.ajax({
      type: "POST",
      dataType: "json",
      url: $(this).data('url'),
      data: {
        'status': status,
        _token: "{{ csrf_token() }}" // Include CSRF token if using Laravel
      },
      success: function(data) {
        table.draw();
        console.log(data.message);
      },
      error: function(xhr, status, error) {
        console.error('Error changing status:', error);
      }
    });
  });
</script>
@endsection