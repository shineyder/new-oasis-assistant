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

    <!-- Modal Edit Group -->
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
                    <form action="{{route('publisher.group')}}" method="POST">
                        @csrf

                        <input type="hidden" name="groupId" id="groupId">

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="group" id="group1" value="Porto Novo 1">
                                <label for="group1" class="custom-control-label">Porto Novo 1</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="group" id="group2" value="Porto Novo 2">
                                <label for="group2" class="custom-control-label">Porto Novo 2</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="group" id="group3" value="Presidente Médici">
                                <label for="group3" class="custom-control-label">Presidente Médici</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="group" id="group4" value="Morro do Sesi">
                                <label for="group4" class="custom-control-label">Morro do Sesi</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="group" id="group5" value="Del Porto">
                                <label for="group5" class="custom-control-label">Del Porto</label>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">
                            Fechar
                        </button>
                        <button type="submit" class="btn btn-primary float-end" style="margin-right: 10px;">
                            Salvar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Access-->
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
                    <form action="{{route('publisher.access')}}" method="POST">
                        @csrf
                        <input type="hidden" name="accessId" id="accessId">

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc0" value="-1">
                                <label for="acc0" class="custom-control-label">Bloqueado</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc1" value="0">
                                <label for="acc1" class="custom-control-label">Nível 0</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc2" value="1">
                                <label for="acc2" class="custom-control-label">Nível 1</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc3" value="2">
                                <label for="acc3" class="custom-control-label">Nível 2</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc4" value="3">
                                <label for="acc4" class="custom-control-label">Nível 3</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc5" value="4">
                                <label for="acc5" class="custom-control-label">Nível 4</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc6" value="5">
                                <label for="acc6" class="custom-control-label">Nível 5</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc7" value="6">
                                <label for="acc7" class="custom-control-label">Nível 6</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc8" value="7">
                                <label for="acc8" class="custom-control-label">Nível 7</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="access" id="acc9" value="8">
                                <label for="acc9" class="custom-control-label">Nível 8</label>
                            </div>
                            @if (Auth::user()->access == 10)
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="access" id="acc10" value="9">
                                    <label for="acc10" class="custom-control-label">Nível 9</label>
                                </div>
                            @endif
                        </div>

                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">
                            Fechar
                        </button>
                        <button type="submit" class="btn btn-primary float-end" style="margin-right: 10px;">
                            Salvar
                        </button>
                    </form>
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

    <script>
        function passId(id) {
            $("#groupId").val(id);
            $("#accessId").val(id);
        }
    </script>
</x-app-layout>


