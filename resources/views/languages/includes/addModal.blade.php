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
                        <label class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter Code" value="" maxlength="10" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="required">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="addButton">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
