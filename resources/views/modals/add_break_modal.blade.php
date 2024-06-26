<div class="modal fade" id="breakModal" tabindex="-1" role="dialog" aria-labelledby="breakModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="breakModalLabel">Add Break</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addBreakForm">
                    <div class="form-group">
                        <label for="breakReason">Break Reason</label>
                        <input type="text" class="form-control" id="breakReason" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Take Break</button>
                </form>
            </div>
        </div>
    </div>
</div>