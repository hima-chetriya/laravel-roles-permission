@extends('layouts.backend.main')
@section('content')
@php
$locale = config('app.locale');
@endphp
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Categories</h4>
            </div>

            <div class="col-6">
                <div class="list-product-header">
                    @can('categories-create')
                    <a id="AddcategoryModal" class="btn btn-primary" data-ajax-popup="false" href="javascript:void(0);" data-url="{{route('categories.create')}}"><i class="fa fa-plus"></i>Add Category</a><br>
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
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="category-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
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
    <div id="CategoryStructureModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel" aria-hidden="true">
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

        table = $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: "{{ route('categories.index') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });

        //   Product Create Modal

        $(document).on('click', '#AddcategoryModal', function() {
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                // dataType: 'html',
                success: function(response) {

                    $('#CategoryStructureModal .modal-dialog').html(response);
                    $('#CategoryStructureModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        //   Product edit Modal


        $(document).on('click', '#EditcategoryModal', function() {
            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'GET',
                // dataType: 'html',
                success: function(response) {

                    $('#CategoryStructureModal .modal-dialog').html(response);
                    $('#CategoryStructureModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


        //  Store Categoty data

        $(document).on('submit', '#AddCategories', function(event) {
            event.preventDefault();
            let name = $('#name').val();
            let description = $('#description').val();

            $.ajax({
                url: '{{route("categories.store")}}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: name,
                    description: description
                },
                success: function(response) {
                    console.log('AJAX success response:', response);
                    $('#AddCategories')[0].reset();
                    $("#CategoryStructureModal").modal('hide')
                    table.draw();
                    $.notify(response.success, "error");
                },
                error: function(xhr) {
                    // console.log(xhr.status);
                    if (xhr.status === 422) { // Validation error
                        let errors = xhr.responseJSON.errors;
                        $('#name-error').text(errors.name ? errors.name[0] : '');
                        $('#description-error').text(errors.description ? errors.description[0] : '');
                    } else {
                        $.notify("An error occurred. Please try again later.", "error");
                    }
                }
            });
        });


        // Update categories 

        $(document).on('submit', '#update-form', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            console.log(id);

            let formData = {
                name: $('#name').val(),
                description: $('#description').val()
            };

            $.ajax({
                url: "{{ route('categories.update', '') }}/" + id,
                method: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#update-form')[0].reset();
                    $("#CategoryStructureModal").modal('hide')
                    table.draw();
                    $.notify(response.success, "error");
                },
                error: function(response) {
                    if (response.status === 422) { // Validation error
                        let errors = response.responseJSON.errors;
                        $('#name-error').text(errors.name ? errors.name[0] : '');
                        $('#description-error').text(errors.description ? errors.description[0] : '');
                    } else {
                        $.notify("An error occurred. Please try again later.", "error");
                    }
                }
            });
        });

      

        // Delete categories 

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