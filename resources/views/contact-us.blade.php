<x-app-layout>
    <x-slot name="header">
        {{ __('Fale Conosco') }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{route('contactus.send')}}" method="POST" enctype="multipart/form-data" role="form">
                @csrf

                {{ __('Selecione o motivo do contato:') }}
                <input type="hidden" id="id" name="id" type="text" value="{{Auth::user()->id}}">
                <input type="hidden" id="name" name="name" type="text" value="{{Auth::user()->name}}">
                <input type="hidden" id="email" name="email" type="email" value="{{Auth::user()->email}}">

                <!-- radio -->
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="subject" id="subject1" value={{ __('Problema') }}>
                        <label for="subject1" class="custom-control-label">{{ __('Relatar um problema') }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="subject" id="subject2" value={{ __('Sugestao') }}>
                        <label for="subject2" class="custom-control-label">{{ __('Fazer uma sugestão') }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="subject" id="subject3" value={{ __('Outro') }}>
                        <label for="subject3" class="custom-control-label">{{ __('Outro') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <x-jet-label for="msg" value="{{ __('Mensagem') }}" />
                    <textarea id="msg" name="msg" class="form-control" rows="4" placeholder="Mensagem ..."></textarea>
                </div>

                <div class="form-group">
                    <div class="custom-file">
                        <x-jet-label for="fileToUploadTalk" value="{{ __('Imagem (opcional)') }}" />
                        <x-jet-input id="fileToUploadTalk" class="block mt-1 w-full" type="file" name="fileToUploadTalk"  accept="image/png, image/jpeg" />
                        <span>{{ __('Arquivo limitado a 1Mb (.png ou .jpeg)') }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <x-jet-button class="ml-4">
                        {{ __('Enviar') }}
                    </x-jet-button>
                    <a href="{{ route('profile') }}">
                        <x-jet-danger-button class="ml-4">
                            {{ __('Cancelar') }}
                        </x-jet-danger-button>
                    </a>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</x-app-layout>
