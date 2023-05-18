<div id="view_users_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">View User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>  
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        @if (!empty($user['image']))
                            <img src="{{ !empty($user['image']) ? url(env('IMAGE_PATH')). '/' . $user['image'] : '' }}" alt="Image" class="img-thumbnail rounded" height="300" width="300">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p>{{ $user['name'] }}</p>
                        <p>{{ $user['address'] }}</p>
                        <p>{{ $user['gender'] }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">
                    <span class='glyphicon '></span> Close
                </button>
            </div>
        </div>
    </div>
</div>