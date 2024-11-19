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
                        <!-- Campo de seleção de Worker -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="product">User Worker</label>
                                <select name="user_slug" class="form-control">
                                    @foreach ($users as $user)
                                        @if ($user->type == 'worker')
                                            <option value="{{ $user->slug }}" required>{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Campo de filtro por ID de Drop -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="drop-filter">Filter Drop by ID</label>
                                <input type="text" id="drop-filter" class="form-control" placeholder="Enter drop ID"
                                    onkeyup="filterDrops()">
                            </div>
                        </div>

                        <!-- Campo de filtro por Type (Salaried ou Nonsalaried) -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="type">Filter Drop by Type</label>
                                <select name="type" id="type" class="form-control"
                                    onchange="filterDropsByType()">
                                    <option value="">All</option>
                                    <option value="Salaried" {{ request('type') == 'Salaried' ? 'selected' : '' }}>
                                        Salaried</option>
                                    <option value="Nonsalaried"
                                        {{ request('type') == 'Nonsalaried' ? 'selected' : '' }}>
                                        Nonsalaried</option>
                                </select>
                            </div>
                        </div>

                        <!-- Lista de Drops com cores baseadas no status -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name">Drop</label>
                                <select name="drop_id[]" class="form-control" multiple id="drop-list" style="height: 200px;">
                                    @foreach ($drops as $drop)
                                        <option value="{{ $drop->slug }}"
                                            style="background-color:
                                            @if ($drop->status == 'Ready') #85f36e;
                                            @elseif ($drop->status == 'Suspense') #838383;
                                            @elseif ($drop->status == 'Dont send') #fff085;
                                            @elseif ($drop->status == 'Problem') #ff9e8e;
                                            @elseif ($drop->status == 'Going to die') #F8ABEE; @endif
                                            color:
                                            @if ($drop->status == 'Suspense') white; @else black; @endif">
                                            {{ $drop->id_drop }} ({{ $drop->type }})
                                        </option>
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
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/assigndrop.js') }}"></script>
@endpush
