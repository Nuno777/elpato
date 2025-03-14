<div class="modal fade" id="requestDropModal{{ $drop->slug }}" tabindex="-1" role="dialog"
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
                <form action="{{ route('sendDropRequest', ['slug' => $drop->slug]) }}" method="POST">
                    @csrf
                    <p>If your drop has <b>problems</b>, you can <b>request a new one</b>, but you have to <b>wait 24
                            hours</b> for it to be <b>approved</b>.
                            <br>
                            Just a reminder that drop can return to normal. This function is only recommended when there is just 1 drop added to your account and you need more!
                        <br><b>Write your reason to be approved!</b>
                    </p>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" placeholder="Write the message here..." rows="6" style="resize: none" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Request</button>
                </form>

            </div>
        </div>
    </div>
</div>
