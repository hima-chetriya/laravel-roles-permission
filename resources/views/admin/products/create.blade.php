<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="commonModalLabel">Add Product </h4>
        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="card-body">
            <form id="AddProduct" class="row g-3 needs-validation custom-input" action="{{route('products.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 position-relative">
                    <strong>Name:</strong>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                   
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Code:</strong>
                    <input type="text" name="code" placeholder="Code" class="form-control">
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Detail:</strong>
                    <textarea type="text" name="detail" placeholder="Detail" class="form-control"></textarea>
                </div>

                <div class="col-md-6 position-relative">
                    <strong>Image:</strong>
                    <input type="file" name="image" placeholder="Image" class="form-control"></input>
                </div>


                <div class="modal-footer">
                    <button id="saveButton" class="btn btn-primary" type="submit">Save </button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
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
                    code: {
                        required: true
                    },
                    detail: {
                        required: true
                    },
                    image: {
                        required: true
                    },
                  
                },
                messages: {
                    name: {
                        required: "Please enter your name"
                    },
                    code: {
                        required: "Please enter your code"
                    },
                    detail: {
                        required: "Please enter your detail"
                    },
                    image: {
                        required: "Please enter your Image"
                    },
                    
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

</script>
