<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="commonModalLabel">Update User </h4>
        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="card-body">
            <form id="" class="row g-3 needs-validation custom-input" action="{{route('users.update',$user->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="col-md-6 position-relative">
                    <strong>Name:</strong>
                    <input class="form-control" value="{{$user->name}}" type="text" name="name" id="name" placeholder="Name">
                </div>
                <div class="col-md-6 position-relative">
                    <strong>Email:</strong>
                    <input type="email" value="{{$user->email}}" name="email" placeholder="Email" class="form-control">
                </div>
                <div class="mb-3 d-flex gap-3 checkbox-checked">
                    <div class="form-check">
                        <input class="form-check-input" id="gender" type="radio" value="Male"  name="gender" {{ ($user->gender=="Male")? "checked" : "" }} >
                        <label class="form-check-label mb-0" for="gender">Male </label>
                    </div>
                
                    <div class="form-check">
                        <input class="form-check-input" id="gender" type="radio" name="gender" value="Female" {{ ($user->gender=="Female")? "checked" : "" }} >
                        <label class="form-check-label mb-0" for="gender">Female</label>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card-wrapper border rounded-3 checkbox-checked">
                    <strong>Select Your Hobbies:</strong>
                    @php
                    $selected = json_decode($user->hobbies, true); // Ensure the countries are decoded as an array
                    @endphp
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" value="Traveling" id="" type="checkbox"   {{ in_array('Readbooks', $selected ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="">Traveling</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="obbies[]"  value="Music" id="" type="checkbox"   {{ in_array('Music', $selected ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="">Music</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" value="Readbooks" id="" type="checkbox"   {{ in_array('Readbooks', $selected ?? []) ? 'checked' : '' }}>
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

                        <option value="{{$user->country}}" {{ $user->country ? 'selected' : '' }}>
                            {{$user->country}}
                        </option>
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
                    <label class="form-label" for="validationTooltip04">Countries:</label>
                    @php
                    $selected = json_decode($user->countries, true); // Ensure the countries are decoded as an array
                    @endphp
                    <select name="countries[]" multiple="multiple" class="form-select" id="validationTooltip04">
                        <option value="canada" {{ in_array('canada', $selected ?? []) ? 'selected' : '' }}>Canada</option>
                        <option value="london" {{ in_array('london', $selected ?? []) ? 'selected' : '' }}>London</option>
                        <option value="japan" {{ in_array('japan', $selected ?? []) ? 'selected' : '' }}>Japan</option>
                        <option value="us" {{ in_array('us', $selected ?? []) ? 'selected' : '' }}>U.S</option>
                        <option value="thailand" {{ in_array('thailand', $selected ?? []) ? 'selected' : '' }}>Thailand</option>
                        <option value="india" {{ in_array('india', $selected ?? []) ? 'selected' : '' }}>India</option>
                    </select>
                    <div class="invalid-tooltip">Please select a valid state.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <strong>Role:</strong>
                    <select name="roles[]" class="form-control" multiple="multiple">
                        @foreach ($roles as $value => $label)
                        <option value="{{ $value }}" {{ isset($userRole[$value]) ? 'selected' : ''}}>
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