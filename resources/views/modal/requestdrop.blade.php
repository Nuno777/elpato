<div class="modal fade" id="requestDropModal{{ $drop->id }}" tabindex="-1" role="dialog"
    aria-labelledby="requestDropModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestDropModalLabel">Request New Drop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sendDropRequest', ['id_drop' => $drop->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" style="resize: none" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Request</button>
                </form>

            </div>
        </div>
    </div>
</div>
