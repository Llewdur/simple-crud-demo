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
                        <label class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="editCode" name="code" placeholder="Enter Code" value="" maxlength="10" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="editName" name="name" placeholder="Enter Name" value="" maxlength="50" required="required">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="editButton">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
