<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if (Session::has('success'))
    <div class="row">
        <div id="toast-container" class="toast-top-right">
            <div id="success-alert" class="toast toast-success" aria-live="polite">
                <button type="button" class="close toast-close-button" role="button">&times;</button>
                <div class="toast-title">Success Message</div>
                <div class="toast-message">{{ Session::get('success') }}</div>
            </div>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="row">
        <div id="toast-container" class="toast-top-right">
            <div id="error-alert" class="toast toast-error" aria-live="assertive">
                <button type="button" class="close toast-close-button" role="button">&times;</button>
                <div class="toast-title">Error Message</div>
                <div class="toast-message">{{ Session::get('error') }}</div>
            </div>
        </div>
    </div>
@endif

<script>
    $(document).ready(function() {
        // Remove a mensagem de sucesso após 5 segundos
        setTimeout(function() {
            $('#success-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 7000);

        // Remove a mensagem de erro após 5 segundos
        setTimeout(function() {
            $('#error-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 7000);
    });
</script>
