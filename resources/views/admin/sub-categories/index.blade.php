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
                    @can('sub-categories-create')
                    <a id="AddSubcategoryModal" class="btn btn-primary" data-ajax-popup="false" href="javascript:void(0);" data-url="{{route('sub-categories.create')}}"><i class="fa fa-plus"></i>Add SubCategory</a><br>
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
                        <table class="display" id="Subcategory-table">
                            <thead>
                                <tr>
                                    <th>Category</th>
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
    <div id="SubCategoryStructureModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel" aria-hidden="true">
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
        
        // SubCategory List

        table = $('#Subcategory-table').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: "{{ route('sub-categories.index') }}",
            columns: [
                {
                        data: 'categories',
                        name: 'categories'
                    },
                {
                    data: 'sub_category_name',
                    name: 'sub_category_name'
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

         // Add SubCategory Modal

        $(document).on('click', '#AddSubcategoryModal', function() {
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                // dataType: 'html',
                success: function(response) {

                    $('#SubCategoryStructureModal .modal-dialog').html(response);
                    $('#SubCategoryStructureModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Save SubCategory Form

         $(document).on('submit', '#AddSubCategories', function(event) {
            event.preventDefault();
             
            let sub_category_name = $('#sub_category_name').val();
            let description = $('#description').val();
            let category_id = $('#category_id').val();

            $.ajax({
                url: '{{route("sub-categories.store")}}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    sub_category_name: sub_category_name,
                    description: description,
                    category_id: category_id
                },
                success: function(response) {
                    console.log('AJAX success response:', response);
                    $('#AddSubCategories')[0].reset();
                    $("#SubCategoryStructureModal").modal('hide')
                    table.draw();
                    $.notify(response.success, "error");
                },
                error: function(xhr) {
                    // console.log(xhr.status);
                    if (xhr.status === 422) { // Validation error
                        let errors = xhr.responseJSON.errors;
                        $('#name-error').text(errors.sub_category_name ? errors.sub_category_name[0] : '');
                        $('#description-error').text(errors.description ? errors.description[0] : '');
                        $('#category-error').text(errors.category_id ? errors.category_id[0] : ''); 
                    } else {
                        $.notify("An error occurred. Please try again later.", "error");
                    }
                }
            });
        });

        $(document).on('click', '#EditSubcategoryModal', function() {
            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'GET',
                // dataType: 'html',
                success: function(response) {

                    $('#SubCategoryStructureModal .modal-dialog').html(response);
                    $('#SubCategoryStructureModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        
        // Update Subcategories 

        $(document).on('submit', '#EditSubCategories', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
        
            let formData = {
                sub_category_name: $('#sub_category_name').val(),
                description: $('#description').val(),
                category_id: $('#category_id').val()
            };

            $.ajax({
                url: "{{ route('sub-categories.update', '') }}/" + id,
                method: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#EditSubCategories')[0].reset();
                    $("#SubCategoryStructureModal").modal('hide')
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

        });



    });
</script>
@endsection