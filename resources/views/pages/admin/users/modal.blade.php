<!-- Modal -->
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="inputForm">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-5 d-flex align-items-center">Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            <div class="invalid-feedback-name text-danger font-italic"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 d-flex align-items-center">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                            <div class="invalid-feedback-email text-danger font-italic"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="form-password">
                        <label class="col-sm-5 d-flex align-items-center">Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="fpassword form-control  @error('password') is-invalid @enderror" id="fpassword" name="password">
                            <div class="invalid-feedback-password text-danger font-italic"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 d-flex align-items-center">Role</label>
                        <div class="col-sm-7">
                            <select class="role form-control @error('role') is-invalid @enderror" id="role" name="role">
                                @foreach(ROLE as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback-role text-danger font-italic"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="form-active">
                        <label class="col-sm-5 d-flex align-items-center">Active</label>
                        <div class="col-sm-7">
                            <div class="pretty p-icon p-round p-jelly p-bigger" style="font-size: 15pt;">
                                <input type="checkbox" class="form-control @error('status') is-invalid @enderror" name="status" id="status" />
                                <div class="state p-primary">
                                    <i class="icon fa fa-check"></i>
                                    <label></label>
                                </div>
                                <div class="invalid-feedback-status text-danger font-italic"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><strong>Close</strong></button>
                    <button class="ladda-button ladda-button-submit btn btn-primary" data-style="zoom-in" type="submit" id="saveBtn">
                        <strong>Save Changes</strong>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
