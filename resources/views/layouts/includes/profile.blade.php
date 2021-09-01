<!-- Modal -->
<div class="modal fade" id="profile-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="profileForm">
                @csrf
                <div class="modal-body">
                   <div class="row animated fadeInRight">
                        <div class="col-md-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5 id="modalTitle">Profile Detail</h5>
                                </div>
                                <div>
                                    <div class="ibox-content no-padding text-center">
                                        <img id="image_user" alt="image" width="250px" class="rounded-circle img-fluid" src="{{
                                        isset(\Illuminate\Support\Facades\Auth::user()->image)
                                        ? URL::asset('uploads/user/img/'.\Illuminate\Support\Facades\Auth::user()->image)
                                        : URL::asset('assets/default-user-image.png')
                                    }}"/>
                                    </div>
                                    <div class="ibox-content profile-content">
                                        <div class="form-group row" id="edit_name">
                                            <label class="col-sm-5 d-flex align-items-center">Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control name @error('name') is-invalid @enderror" name="name" id="name">
                                                <div class="invalid-feedback-name text-danger font-italic"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="edit_email">
                                            <label class="col-sm-5 d-flex align-items-center">Email</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                                                <div class="invalid-feedback-email text-danger font-italic"></div>
                                            </div>
                                        </div>
                                        <h4 id="detail_name"><strong>{{Auth::user()->name}}</strong></h4>
                                        <p id="detail_email"><i class="fa fa-envelope"></i> {{Auth::user()->email}}</p>
                                        <div class="user-button" id="button_edit">
                                            <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="#" data-id="{{Auth::user()->id}}" class="btn btn-warning btn-sm btn-block editdata" id="editdata" data-toggle="tooltip" title="Ubah Profile">
                                                            <i class="fa fa-arrow-circle-o-right"></i> Ubah Nama Profile
                                                        </a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" id="button_submit">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><strong>Close</strong></button>
                    <button class="ladda-button ladda-button-submit btn btn-primary" data-style="zoom-in" type="submit" id="saveBtn">
                        <strong>Save Changes</strong>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
