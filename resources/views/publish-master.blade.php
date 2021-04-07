<x-app-layout>
    <x-slot name="header">
        {{ __('Publicadores') }}
    </x-slot>

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Grupo</th>
                <th>Definir Grupo</th>
                <th>Acesso</th>
                <th>Definir Acesso</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="setGroupModal" tabindex="-1" aria-labelledby="setGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setGroupModalLabel">
                        Definir Grupo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="button" class="btn btn-primary">
                        Salvar Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="setAccessModal" tabindex="-1" aria-labelledby="setAccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setAccessModalLabel">
                        Definir Acesso
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="button" class="btn btn-primary">
                        Salvar Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('publisher.data') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'group', name: 'group'},
                    {data: 'defGroup', name: 'defGroup', orderable: false, searchable: false},
                    {data: 'access', name: 'access'},
                    {data: 'defAccess', name: 'defAccess', orderable: false, searchable: false},
                ]
            });
        });
    </script>
</x-app-layout>


