<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="commonModalLabel">Add SubCategory </h4>
        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="card-body">
            <input type="hidden" id="editCategoryId" name="id">
            <form id="AddSubCategories" class="row g-3 needs-validation custom-input" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 position-relative">
                    <strong>Name:</strong>
                    <input class="form-control" type="text" name="sub_category_name" id="sub_category_name" placeholder="sub_category_name">
                    <span id="name-error" class="text-danger"></span>
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Description:</strong>
                    <input type="text" name="description" placeholder="description" id="description" class="form-control">
                    <span id="description-error" class="text-danger"></span>
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Categories:</strong>

                    <select name="category_id" id="category_id" class="form-control">
                    <option>select</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}"> {{$category->name}}
                        </option>
                        @endforeach
                    </select>
                    <span id="category-error" class="text-danger"></span>
                </div>

                <div class="modal-footer">
                    <button id="save-sub-categories" class="btn btn-primary" type="submit">Save </button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>