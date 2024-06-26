<!-- Modal -->
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
                <form>
                    <div class="form-group">
                        <label for="breakReason">Reason</label>
                        <input type="text" class="form-control" id="breakReason" placeholder="Enter reason for break">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="takeBreakBtn">Take Break</button>
            </div>
        </div>
    </div>
</div>
