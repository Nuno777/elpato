{{-- @extends('layouts.master')

@section('title', 'Create Drop')

@section('content')
@section('page-title', 'Create Drop')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Create Drops</h2>
            </div>
            <div class="card-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('createdrops.store') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="id_drop">ID</label>
                                <input type="text" name="id_drop" id="id_drop" class="form-control"
                                    placeholder="Id Drop" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <input type="text" name="notes" id="notes" class="form-control"
                                    placeholder="Notes" value="N/A">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Address" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="personalnotes">Personal Notes</label>
                                <input type="text" name="personalnotes" id="personalnotes" class="form-control"
                                    placeholder="Personal Notes" value="N/A">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="packages">Packages</label>
                                        <input type="text" name="packages" id="packages" class="form-control"
                                            placeholder="Packages" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected value="Default"
                                                style="background-color: #fff; color: black; " disabled>
                                                Default</option>
                                            <option value="Ready" style="background-color: #82FB6A; color: black; ">
                                                Ready</option>
                                            <option value="Problem" style="background-color: #FF7059; color: white;">
                                                Problem</option>
                                            <option value="Dont send" style="background-color: #F1DD50; color: black;">
                                                Dont send</option>
                                            <option option value="Suspense"
                                                style="background-color: #424945; color: white;">Suspense</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expired">Expired At</label>
                                        <input type="date" name="expired" id="expired" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" class="form-control" id="type">
                                            <option value="All">All</option>
                                            <option value="Salaried">Salaried</option>
                                            <option value="Nonsalaried">Nonsalaried</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Insert Drop</button>
                    <a href="{{ route('drops') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
 --}}

<div class="modal fade" id="createDropModal" tabindex="-1" role="dialog" aria-labelledby="createDropModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDropModalLabel">Create Drop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('createdrops.store') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="id_drop">Drop</label>
                                <input type="text" name="id_drop" id="id_drop" class="form-control"
                                    placeholder="Drop" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Name" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Address" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="packages">Packages</label>
                                        <input type="text" name="packages" id="packages" class="form-control"
                                            placeholder="Packages" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" class="form-control" id="type">
                                            <option value="All">All</option>
                                            <option value="Salaried">Salaried</option>
                                            <option value="Nonsalaried">Nonsalaried</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected value="Default"
                                                style="background-color: #fff; color: black; " disabled>
                                                Default</option>
                                            <option value="Ready" style="background-color: #82FB6A; color: black; ">
                                                Ready</option>
                                            <option value="Problem" style="background-color: #FF7059; color: white;">
                                                Problem</option>
                                            <option value="Dont send" style="background-color: #F1DD50; color: black;">
                                                Dont send</option>
                                            <option option value="Suspense"
                                                style="background-color: #424945; color: white;">Suspense
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expired">Expired At</label>
                                        <input type="date" name="expired" id="expired" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea style="resize: none;" type="text" name="notes" id="notes" class="form-control" placeholder="Notes"
                                    cols="43" rows="5" required>N/A</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="personalnotes">Personal Notes</label>
                                <textarea style="resize: none;" type="text" name="personalnotes" id="personalnotes" class="form-control"
                                    placeholder="Personal Notes" cols="43" rows="5" required>N/A</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Insert Drop</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script src="{{ asset('js/colortabledrops.js') }}"></script>
@endpush
