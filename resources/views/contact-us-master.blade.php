<x-app-layout>
    <x-slot name="header">
        {{ __('Solicitações') }}
    </x-slot>

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Assunto</th>
                <th>Ticket</th>
                <th>Data</th>
                <th>Status</th>
                <th>Definir Status</th>
                <th>Mensagem</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal Edit Status -->
    <div class="modal fade" id="setStatusModal" tabindex="-1" aria-labelledby="setStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setStatusModalLabel">
                        Atualizar Status
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('contactusmaster.status')}}" method="POST">
                        @csrf

                        <input type="hidden" name="statusId" id="statusId">

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status" id="status1" value="em Analise">
                                <label for="status1" class="custom-control-label">em Analise</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="em Espera">
                                <label for="status2" class="custom-control-label">em Espera</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status" id="status3" value="Concluido">
                                <label for="status3" class="custom-control-label">Concluido</label>
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

    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('contactusmaster.data') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'subject', name: 'subject'},
                    {data: 'ticket', name: 'ticket'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status_now', name: 'status_now'},
                    {data: 'defStatus', name: 'defStatus', orderable: false, searchable: false},
                    {data: 'message', name: 'message'}
                ],
            });
        });
    </script>

    <script>
        function passId(id) {
            $("#statusId").val(id);
        }
    </script>
</x-app-layout>

