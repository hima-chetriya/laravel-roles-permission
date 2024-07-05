@extends('layouts.backend.main')

@section('content')
@php
$locale = config('app.locale');
@endphp
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Products</h4>
      </div>

      <div class="col-6">
        <div class="list-product-header">
          @can('product-create')
          <a id="AddProductModal" class="btn btn-primary" data-ajax-popup="false" href="javascript:void(0);" data-url="{{route('products.create')}}"><i class="fa fa-plus"></i>Add Product</a><br>
          @endcan
        </div>
      </div>

    </div>
  </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <!-- <div class="card-header pb-0 card-no-border">
          <h4>HTML5 Export Buttons</h4>
        </div> -->
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="display" id="product-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Detail</th>
                  <th class="Image">Image</th>
                  <th class="Action">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- User Create Modal -->
  <div id="ProductModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
<script>





  var table = "";
  $(document).ready(function() {
    // User List
    table = $('#product-table').DataTable({
      processing: true,
      serverSide: true,
      order:[],
      ajax: "{{ route('products.index') }}",
      columns: [
        // {
        //   data: null,
        //   name: 'serial',
         
        //   searchable: false,
        //   render: function(data, row, meta) {
        //     return meta.row + meta.settings._iDisplayStart + 1;
        //   }
        // },

        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'code',
          name: 'code'
        },
        {
          data: 'detail',
          name: 'detail'
        },

        {
          data: 'image',
          name: 'image'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }
      ],

      dom: "Bfrtip",
      buttons: [{
          extend: "csvHtml5",
          exportOptions: {
            columns: ':visible:not(.Image):not(.Action)'
          },

        },
        {
          extend: "pdfHtml5",
          exportOptions: {
            columns: ':visible:not(.Image):not(.Action)'
          }
        }
      ]

    });


    

    //   Product Create Modal
    
    $(document).on('click', '#AddProductModal', function() {
      var url = $(this).data('url');
      $.ajax({
        url: url,
        type: 'GET',
        // dataType: 'html',
        success: function(response) {

          $('#ProductModal .modal-dialog').html(response);
          $('#ProductModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });

    //   Product Edit Modal

    $(document).on('click', '#EditProductModal', function() {
      var url = $(this).data('url');
      $.ajax({
        url: url,
        type: 'GET',
        // dataType: 'html',
        success: function(response) {

          $('#ProductModal .modal-dialog').html(response);
          $('#ProductModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
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




  });
</script>

@endsection