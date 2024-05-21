<!-- Modal Form -->
<div class="modal fade" id="assigndrop" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalForm">Assign Drop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="assignDropForm" action="{{ route('assign.worker.drop') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="product">User Worker</label>
                                <select name="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        @if ($user->type == 'worker')
                                            <option value="{{ $user->id }}" required>{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Drop</label>
                                <select name="drop_id[]" class="form-control" multiple>
                                    @foreach ($drops as $drop)
                                        @if ($drop->status != 'Problem' && $drop->status != 'Dont send' && $drop->status != 'Suspense')
                                            <option value="{{ $drop->id }}">{{ $drop->id_drop }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Assign Drop</button>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
        </div>
    </div>
</div>
