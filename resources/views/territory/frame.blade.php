<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <!-- Compiled and minified CSS and Import Google Icon Font -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" defer></script>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            article{height: 50000px;}
            body{display: block;}
        </style>
    </head>

    <script>
    function myFunction(param){
        if (document.getElementById("work_" + param).checked) {
            document.getElementById("data-" + param).setAttribute("class", "");
        } else {
            document.getElementById("data-" + param).setAttribute("class", "hide");
        }
    }
    </script>

    <body>
        <div class="container">
            <form action="{{route('territory.report')}}" method="POST">
                @csrf
                
                <ul class="collapsible">
                    @foreach ($data as $blockData)
                        <li>
                            <div class="collapsible-header">
                                Quadra {{ $blockData->block }}: {{($blockData->worked == 0) ? "não trabalhada" : "trabalhada"}}
                            </div>
                            <div class="collapsible-body">
                                <div class="row">
                                    <div>
                                        <label>
                                            @if ($blockData->worked == 1)
                                                <input type="hidden" id="work_{{$blockData->id}}" name="work_{{$blockData->id}}" value="1">
                                            @else
                                                <input type="checkbox" id="work_{{$blockData->id}}" name="work_{{$blockData->id}}" onclick='myFunction("{{$blockData->id}}")' {{($blockData->worked == 1) ? "checked = 'checked' disabled = 'disabled'" : ""}}>
                                                <span> Quadra Trabalhada</span>
                                            @endif
                                        </label>
                                    </div>
                                    @if ($blockData->worked == 1)
                                        <div class="col s12">
                                            <span> Número de Residências: {{$blockData->number_of_houses}}</span><br>
                                            <span> Número de Comércios: {{$blockData->number_of_commerces}}</span><br>
                                            <span> Número de Edifícios: {{$blockData->number_of_buildings}}</span>
                                        </div>
                                        <input type="hidden" id="n_res_{{$blockData->id}}" name="n_res_{{$blockData->id}}" type="number" value={{$blockData->number_of_houses}}>
                                        <input type="hidden" id="n_com_{{$blockData->id}}" name="n_com_{{$blockData->id}}" type="number" value={{$blockData->number_of_commerces}}>
                                        <input type="hidden" id="n_edi_{{$blockData->id}}" name="n_edi_{{$blockData->id}}" type="number" value={{$blockData->number_of_buildings}}>
                                    @else
                                        <div id="data-{{$blockData->id}}" class="hide">
                                            <div class="col s4">
                                                <input id="n_res_{{$blockData->id}}" name="n_res_{{$blockData->id}}" type="number" class="validate" value={{$blockData->number_of_houses}} min="0">
                                                <label for="n_res_{{$blockData->id}}">Número de Residências</label>
                                            </div>

                                            <div class="col s4">
                                                <input id="n_com_{{$blockData->id}}" name="n_com_{{$blockData->id}}" type="number" class="validate" value={{$blockData->number_of_commerces}} min="0">
                                                <label for="n_com_{{$blockData->id}}">Número de Comércios</label>
                                            </div>

                                            <div class="col s4">
                                                <input id="n_edi_{{$blockData->id}}" name="n_edi_{{$blockData->id}}" type="number" class="validate" value={{$blockData->number_of_buildings}} min="0">
                                                <label for="n_edi_{{$blockData->id}}">Número de Edifícios</label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <input type="hidden" name="mapactive" value={{$local}}>

                <button type="submit" name="btn-env-rel" class="btn teal darken-2">
                    Enviar Relatório
                </button>
            </form>
        </div>

        <!-- Compiled and minified JavaScript -->
        <script type = "text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>

        <script>
        $(document).ready(function() {
            $('.collapsible').collapsible({accordion: false});
        })
        </script>
    </body>
</html>
