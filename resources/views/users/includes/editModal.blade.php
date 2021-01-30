<div class="modal fade" id="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" name="editForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                   <div id="editErrorMessages" class="editErrorMessages btn btn-danger">ss</div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="editName" name="name" placeholder="Enter Name" value="" maxlength="50" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="col-sm-2 control-label">Surname</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="editSurname" name="surname" placeholder="Enter Surname" value="" maxlength="255" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="idnumber" class="col-sm-2 control-label text-nowrap">South African Id Number</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="editIdnumber" name="idnumber" placeholder="Enter ID i.e. 800101 1234 567" value="" maxlength="15" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label text-nowrap">Mobile Number</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="editMobile" name="mobile" placeholder="Enter Mobile i.e. 27 83 445 2207" value="" maxlength="14" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label text-nowrap">Email Address</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="editEmail" name="email" placeholder="Enter Email" value="" maxlength="255" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob" class="col-sm-2 control-label text-nowrap">Birth Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="editDob" name="dob" placeholder="Enter Birth Date" value="" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="language_id" class="col-sm-2 control-label">Language</label>
                        <div class="col-sm-12">
                            <select id="editLanguage_id" name="language_id" class="form-control">
                                @include('includes/languagesDropDown')
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="interest_id" class="col-sm-2 control-label">Interests</label>
                        <select id="editInterest_id" name="interest_id[]" class="form-control" multiple>
                            @include('includes/interestsDropDown')
                        </select>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="editButton">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
