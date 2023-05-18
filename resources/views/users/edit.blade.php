<div id="edit_users_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>  
            <form action="{{ route('users.edit') }}" id="edit_users_frm" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id ="id" value={{ $user['id'] }}>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input type="text" name="edit_name" id="edit_name" value="{{ $user['name'] }}" class="form-control" placeholder="Enter first name" autocomplete="off">
                            <span id="error-edit_name" class="error"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_address">Address</label>
                            <textarea id="edit_address" name="edit_address" cols="3" class="form-control" placeholder="Enter address">{{ $user['address']  }}</textarea>
                            <span id="error-edit_address" class="error"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_gender">Gender</label>
                            <select name="edit_gender" id="edit_gender" class="form-control">
                                <option value="Male" {{ $user['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user['gender'] == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <span id="error-edit_gender" class="error"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_image">Image</label>
                            <input type="file" name="edit_image" id="edit_image" class="form-control">
                            <span id="error-edit_image" class="error"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($user['thumb_image']))
                            <img src="{{ !empty($user['thumb_image']) ? url(env('IMAGE_PATH')). '/' . $user['thumb_image'] : '' }}" alt="Image" class="img-thumbnail rounded">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn" >
                    Submit
                </button>
                <button type="button" class="btn" data-dismiss="modal">
                    <span class='glyphicon '></span> Close
                </button>
            </div>
            </form>
        </div>
    </div>
</div>