<!-- Break Modal -->
<div class="modal fade" id="breakModal" tabindex="-1" role="dialog" aria-labelledby="breakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="breakModalLabel">Add Break</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('breaks.start') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="breakReason">Break Reason</label>
                        <select class="form-control" id="breakReason" name="reason">
                            <option value="lunch">Lunch</option>
                            <option value="coffee">Coffee</option>
                            <option value="personal">Personal</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Take Break</button>
                </form>
            </div>
        </div>
    </div>
</div>
