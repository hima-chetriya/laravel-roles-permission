<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="commonModalLabel">Add </h4>
        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="card-body">
            <form id="AddUser" class="row g-3 needs-validation custom-input" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 position-relative">
                    <strong>Name:</strong>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Email:</strong>
                    <input type="email" name="email" placeholder="Email" class="form-control">
                </div>
                <div class="mb-3 d-flex gap-3 checkbox-checked">
                    <div class="form-check">
                        <input class="form-check-input" id="gender" type="radio" value="Male" name="gender">
                        <label class="form-check-label mb-0" for="gender">Male </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="gender" type="radio" name="gender" value="Female" checked="">
                        <label class="form-check-label mb-0" for="gender">Female</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-wrapper border rounded-3 checkbox-checked">
                        
                    <strong>Select Your Hobbies:</strong>
                    
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" value="Traveling" id="" type="checkbox" value="">
                            <label class="form-check-label" for="">Traveling</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]"  value="Music" id="" type="checkbox" value="" checked="">
                            <label class="form-check-label" for="">Music</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" value="Readbooks" id="" type="checkbox" value="" checked="">
                            <label class="form-check-label" for="">Readbooks</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 position-relative">
                    <strong>Password:</strong>
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>


                <div class="col-md-6 position-relative">
                    <strong>Confirm Password:</strong>
                    <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                </div>
                <div class="col-md-3 position-relative">
                    <label class="form-label" for="validationTooltip04">Country:</label>
                    <select class="form-select" name="country" id="validationTooltip04" required="">
                        <option selected="" disabled="" value="">Choose...</option>
                        <option value="canada">Canada</option>
                        <option value="london">London</option>
                        <option value="japan">Japan</option>
                        <option value="us">U.S </option>
                        <option value="thailand">Thailand </option>
                        <option value="india">India </option>

                    </select>
                    <div class="invalid-tooltip">Please select a valid state.</div>
                </div>
                <div class="col-md-3 position-relative">
                    <label class="form-label" for="validationTooltip04">Country:</label>
                    <select class="form-select" name="countries[]" id="validationTooltip04" required="" multiple>
                        <option selected="" disabled="" value="">Choose...</option>
                        <option value="canada">Canada</option>
                        <option value="london">London</option>
                        <option value="japan">Japan</option>
                        <option value="us">U.S </option>
                        <option value="thailand">Thailand </option>
                        <option value="india">India </option>

                    </select>
                    <div class="invalid-tooltip">Please select a valid state.</div>
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Role:</strong>
                    <select name="roles[]" class="form-control" multiple="multiple">
                        @foreach ($roles as $value => $label)
                        <option value="{{ $value }}">
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button id="saveButton" class="btn btn-primary" type="submit">Save </button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

