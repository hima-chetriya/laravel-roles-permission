<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="commonModalLabel">Update Product </h4>
        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="card-body">
            <form id="AddUser" class="row g-3 needs-validation custom-input" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 position-relative">
                    <strong>Name:</strong>
                    <input class="form-control" type="text" value="{{ $products->name }}" name="name" id="name" placeholder="Name">
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Code:</strong>
                    <input type="text" name="code" placeholder="Code" value="{{ $products->code }}" class="form-control">
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Detail:</strong>
                    <textarea type="text" name="detail"  placeholder="Detail" class="form-control">{{$products->detail}}</textarea>
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Image:</strong>
                    <input type="file" name="image" placeholder="Image" class="form-control"></input>
                    <img src="{{url('images' .'/'. $products->image)}}" height="100px" width="100px">
                </div>
               

                <div class="modal-footer">
                    <button id="saveButton" class="btn btn-primary" type="submit">Save </button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>