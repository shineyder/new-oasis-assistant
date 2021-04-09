<x-app-layout>
    <x-slot name="header">
        {{ __('Relatórios') }}
    </x-slot>

    <p>OBS: Quando se completa o território, todos os relatórios até então são arquivados e, portanto, não aparecerão nesta página.</p>

    <div style="margin-bottom: 10px;">
        <button type="button" class="edit btn btn-primary">
            <a href="{{route('territory.s13')}}" style="color: white;">
                S-13
            </a>
        </button>
    </div>

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Nome</th>
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
                    <form action="{{route('report.update')}}" method="POST">
                        @csrf

                        <input type="hidden" name="reportUpdateId" id="reportUpdateId">
                        <input type="hidden" name="territoryUpdateId" id="territoryUpdateId">

                        <div class="form-group">
                            <label for="number_of_houses">Número de Residências</label>
                            <input type="number" class="form-control" id="number_of_houses" name="number_of_houses" value="0" min="0"/>
                        </div>
                        <div class="form-group">
                            <label for="number_of_commerces">Número de Comércios</label>
                            <input type="number" class="form-control" id="number_of_commerces" name="number_of_commerces" value="0" min="0"/>
                        </div>
                        <div class="form-group">
                            <label for="number_of_buildings">Número de Edifícios</label>
                            <input type="number" class="form-control" id="number_of_buildings" name="number_of_buildings" value="0" min="0"/>
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
                    <span>Tem certeza que gostaria de deletar esse relatório? Todas as informações serão perdidas!</span>
                    <form action="{{route('report.delete')}}" method="POST">
                        @csrf
                        <input type="hidden" name="reportDeleteId" id="reportDeleteId">
                        <input type="hidden" name="territoryDeleteId" id="territoryDeleteId">
                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary float-end" style="margin-right: 10px;">
                            Confirmar
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
                ajax: "{{ route('reportmaster.data') }}",
                columns: [
                    {data: 'name', name: 'users.name'},
                    {data: 'map', name: 'territories.map'},
                    {data: 'block', name: 'territories.block'},
                    {data: 'desc2', name: 'events.desc2'},
                    {data: 'desc3', name: 'events.desc3'},
                    {data: 'desc4', name: 'events.desc4'},
                    {data: 'defStatus', name: 'defStatus', orderable: false}
                ],
            });
        });
    </script>

    <script>
        function passIdUpload(id, territory_id) {
            $("#reportUpdateId").val(id);
            $('#territoryUpdateId').val(territory_id);
        }

        function passIdDelete(id, territory_id) {
            $("#reportDeleteId").val(id);
            $('#territoryDeleteId').val(territory_id);
        }
    </script>
</x-app-layout>

