<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="row">
    <div class="col-md-6 mx-auto text-center">
        @if (Session::has('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6 mx-auto text-center">
        @if (Session::has('error'))
            <div id="error-alert" class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
</div>

<script>
    $(document).ready(function(){
        // Remove a mensagem de sucesso após 5 segundos
        setTimeout(function(){
            $('#success-alert').alert('close');
        }, 10000);

        // Remove a mensagem de erro após 5 segundos
        setTimeout(function(){
            $('#error-alert').alert('close');
        }, 10000);
    });
</script>
