<div class="modal fade" id="assigndrop" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Drop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="assignDropForm" action="{{ route('assign.worker.drop') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Seleção de Worker -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="user-slug">User Worker</label>
                                <select name="user_slug" id="user-slug" class="form-control">
                                    <option value="" selected>Unknown</option>
                                    @foreach ($users as $user)
                                        @if ($user->type == 'worker')
                                            <option value="{{ $user->slug }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Filtro por ID de Drop -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="drop-filter">Filter Drop by ID</label>
                                <input type="text" id="drop-filter" class="form-control" placeholder="Enter drop ID">
                            </div>
                        </div>

                        <!-- Filtro por Tipo -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="filter-drop-type">Filter Drop by Type</label>
                                <select name="type" id="filter-drop-type" class="form-control">
                                    <option value="">All</option>
                                    <option value="Salaried">Salaried</option>
                                    <option value="Nonsalaried">Nonsalaried</option>
                                </select>
                            </div>
                        </div>

                        <!-- Lista de Drops -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="drop-list">Drop</label>
                                <select name="drop_id[]" class="form-control" multiple id="drop-list"
                                    style="height: 400px;">
                                    @foreach ($drops as $drop)
                                        <option value="{{ $drop->slug }}"
                                            data-original-text="{{ $drop->id_drop }} ({{ $drop->type }})"
                                            style="background-color:
                                            @if ($drop->status == 'Ready') #00cb38;
                                            @elseif ($drop->status == 'Suspense') #515151;
                                            @elseif ($drop->status == 'Dont send') #ffea51;
                                            @elseif ($drop->status == 'Problem') #ff7760;
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
    <script src="{{ asset('js/drop/assigndrop.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropList = document.getElementById('drop-list');
            const filterType = document.getElementById('filter-drop-type');
            const userSlugSelect = document.getElementById('user-slug');

            // Filtro por tipo
            filterType.addEventListener('change', () => {
                const selectedType = filterType.value;

                fetch(`/panel/dashboard/drops/filter?type=${selectedType}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => updateDropList(data.drops))
                    .catch(error => console.error('Error fetching drops:', error));
            });

            // Obter drops associadas
            userSlugSelect.addEventListener('change', () => {
                const userSlug = userSlugSelect.value;

                if (!userSlug) {
                    // Quando "Unknown" é selecionado, remove "(Associated)" de todas as opções
                    resetDropList();
                    return;
                }

                fetch('/panel/dashboard/drops/get-drops-for-worker', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            user_slug: userSlug
                        })
                    })
                    .then(response => response.json())
                    .then(associatedDrops => updateAssociatedDrops(associatedDrops))
                    .catch(error => console.error('Error fetching associated drops:', error));
            });

            // Atualiza a lista de drops
            function updateDropList(drops) {
                dropList.innerHTML = '';
                drops.forEach(drop => {
                    const option = document.createElement('option');
                    option.value = drop.slug;
                    option.textContent = `${drop.id_drop} (${drop.type})`;
                    option.style.backgroundColor = getDropColor(drop.status);
                    option.style.color = getTextColor(drop.status);
                    option.setAttribute('data-original-text', `${drop.id_drop} (${drop.type})`);
                    dropList.appendChild(option);
                });
            }

            // Retorna a cor de fundo baseada no status
            function getDropColor(status) {
                switch (status) {
                    case 'Ready':
                        return '#00cb38';
                    case 'Suspense':
                        return '#515151';
                    case 'Dont send':
                        return '#ffea51';
                    case 'Problem':
                        return '#ff7760';
                    case 'Going to die':
                        return '#F8ABEE';
                    default:
                        return '';
                }
            }

            // Retorna a cor do texto baseada no status
            function getTextColor(status) {
                if (status === 'Suspense') {
                    return 'white';
                }
                return 'black';
            }

            // Atualiza drops associadas
            function updateAssociatedDrops(associatedDrops) {
                Array.from(dropList.options).forEach(option => {
                    const originalText = option.getAttribute('data-original-text');
                    if (associatedDrops.includes(option.value)) {
                        option.text = `${originalText} (Associated)`;
                    } else {
                        option.text = originalText;
                    }
                });
            }

            // Resetar lista de drops quando "Unknown" for selecionado
            function resetDropList() {
                Array.from(dropList.options).forEach(option => {
                    const originalText = option.getAttribute('data-original-text');
                    option.text = originalText; // Remove o "(Associated)" se "Unknown" for selecionado
                });
            }
        });
    </script>
@endpush
