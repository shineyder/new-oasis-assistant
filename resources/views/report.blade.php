<x-app-layout>
    <x-slot name="header">
        {{ __('Meus Relatórios') }}
    </x-slot>

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Mapa</th>
                <th>Quadra</th>
                <th>Casas</th>
                <th>Comércios</th>
                <th>Edifícios</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal Update Report -->
    <div class="modal fade" id="updateReportModal" tabindex="-1" aria-labelledby="updateReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateReportModalLabel">
                        Atualizar Relatório
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('contactusmaster.status')}}" method="POST">
                        @csrf

                        <input type="hidden" name="reportUpdateId" id="reportUpdateId">

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

    <!-- Modal Delete Report -->
    <div class="modal fade" id="deleteReportModal" tabindex="-1" aria-labelledby="deleteReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteReportModalLabel">
                        Deletar Relatório
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('contactusmaster.status')}}" method="POST">
                        @csrf

                        <input type="hidden" name="reportDeleteId" id="reportDeleteId">

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
                ajax: "{{ route('report.data') }}",
                columns: [
                    {data: 'map', name: 'map'},
                    {data: 'block', name: 'block'},
                    {data: 'desc2', name: 'desc2'},
                    {data: 'desc3', name: 'desc3'},
                    {data: 'desc4', name: 'desc4'},
                    {data: 'defStatus', name: 'defStatus', orderable: false, searchable: false}
                ],
            });
        });
    </script>

    <script>
        function passIdUpload(id) {
            $("#reportUpdateId").val(id);
        }

        function passIdDelete(id) {
            $("#reportDeleteId").val(id);
        }
    </script>
</x-app-layout>

