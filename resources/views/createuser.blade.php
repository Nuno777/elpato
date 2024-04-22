@extends('layouts.master')

@section('title', 'Create User')

@section('content')
@section('page-title', 'Create User')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Create User</h2>
            </div>
            <div class="card-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('createuser.store') }}">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="example@elpato.com" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="mdi mdi-eye-off"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email_verified_at">Create Check</label>
                                        <input type="datetime" name="email_verified_at" id="email_verified_at"
                                            class="form-control" placeholder="Create Check" required readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="hidden" name="admin" class="form-control" placeholder="Perms"
                                            value="0" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LfIvMMpAAAAAMyq68S6_XTjd_bJnZopR1brbTSY"></div>
                    <br>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    // Função para obter a data e hora atual
    function getCurrentDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);
        var seconds = ('0' + now.getSeconds()).slice(-2);
        return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    }

    // Atualizar o valor do input com a data e hora atualizada a cada segundo
    setInterval(function() {
        document.getElementById('email_verified_at').value = getCurrentDateTime();
    }, 1000); // 1000 milissegundos = 1 segundo

    /*script do eye */
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('mdi-eye');
        this.querySelector('i').classList.toggle('mdi-eye-off');
    });
</script>
@endsection
