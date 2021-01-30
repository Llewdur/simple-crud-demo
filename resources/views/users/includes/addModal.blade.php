<div class="modal fade" id="addModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="addForm" name="addForm" class="form-horizontal">
                    <div id="addErrorMessages" class="addErrorMessages btn btn-danger"></div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="255" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="col-sm-2 control-label">Surname</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname" value="" maxlength="255" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="idnumber" class="col-sm-2 control-label text-nowrap">South African Id Number</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="idnumber" name="idnumber" placeholder="Enter ID" value="" maxlength="11" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label text-nowrap">Mobile Number</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="" maxlength="11" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label text-nowrap">Email Address</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="255" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob" class="col-sm-2 control-label text-nowrap">Birth Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Birth Date" value="" required="required">
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
                        <button type="submit" class="btn btn-primary" id="addButton">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
