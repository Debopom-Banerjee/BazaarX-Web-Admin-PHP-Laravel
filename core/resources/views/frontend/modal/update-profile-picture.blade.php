 <!-- Wishlist Popup Start -->
 <div class="modal fade" id="profilePicture" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Profie Picture</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close"
                    style="padding: 0px 20px;font-size: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-5">
                <form class="text-center" method="post" action="{{ route('panel.update-profile-img', auth()->id()) }}" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ getAuthProfileImage(auth()->user()->avatar ) }}" alt="">
                    <div class="mt-4">
                        <h4>Select Profile Image</h4>
                        <div class="form-group mt-5">
                            <label for="avatar" class="form-label">Select profile image</label> <br>
                            <input type="file" name="avatar" class="form-control" id="avatar" accept="image/jpg,image/png,image/jpeg">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-outline-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Wishlist Popup End -->