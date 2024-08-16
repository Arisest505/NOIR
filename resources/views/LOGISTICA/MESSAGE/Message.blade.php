@extends('layouts.appnav')

@section('styles')
    <link href="{{ asset('css/message.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="messaging-container">
        <!-- Lista de contactos -->
        <div class="contact-list">
            <h2>Mensajería</h2>
            <ul>
                @foreach($users as $user)
                    <li class="{{ request()->query('receiver_id') == $user->user_id ? 'active' : '' }}">
                        <a href="{{ route('messages.index', ['receiver_id' => $user->user_id]) }}">
                            <div class="user-avatar" style="position: relative;">
                                <img src="{{ asset('img/user.jpg') }}" alt="Avatar del usuario">
                                @if($user->unread_messages_count > 0)
                                    <span class="notification-badge">{{ $user->unread_messages_count }}</span>
                                @endif
                            </div>
                            <div class="user-info">
                                <div class="user-name">
                                    {{ $user->name }}
                                </div>
                                <div class="last-message">
                                    @if($user->latestMessage)
                                        @if($user->latestMessage->message)
                                            {{ $user->latestMessage->message }}
                                        @elseif($user->latestMessage->file_path)
                                            Imagen adjunta
                                        @else
                                            Sin mensajes
                                        @endif
                                    @else
                                        Sin mensajes
                                    @endif
                                </div>

                            </div>
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>

        <!-- Área de mensajes -->
        <div class="message-area">
            <div class="message-header">
                @if($chatUser)
                    <div class="chat-user">
                        <img src="{{ asset('img/user.jpg') }}" alt="Avatar del usuario">
                        <div class="chat-user-info">
                            <h3>{{ $chatUser->name }}</h3>

                        </div>
                    </div>
                @endif
            </div>
            <div class="messages">
                <ul>
                    @foreach($messages as $message)
                        <li class="{{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
                            @if($message->message)
                                <p>{{ $message->message }}</p>
                            @endif

                            @if($message->file_path)
                                @php
                                    $fileType = pathinfo($message->file_path, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']))
                                    <!-- Mostrar la imagen con lightbox -->
                                    <a href="#lightbox-{{ $message->id }}">
                                        <img src="{{ Storage::url($message->file_path) }}" alt="Imagen adjunta" class="attached-file">
                                    </a>

                                    <div id="lightbox-{{ $message->id }}" class="lightbox">
                                        <a href="#" class="close">&times;</a>
                                        <img src="{{ Storage::url($message->file_path) }}" alt="Imagen ampliada">
                                    </div>
                                @else
                                    <!-- Mostrar un enlace de descarga para otros tipos de archivos -->
                                    <a href="{{ Storage::url($message->file_path) }}" target="_blank">
                                        Descargar archivo {{ strtoupper($fileType) }}
                                    </a>
                                @endif
                            @endif

                            <span class="time">{{ $message->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <form class="send-message-form" action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ request('receiver_id') }}">
                <div class="input-group">
                    <input type="text" id="message" name="message" placeholder="Escribe tu mensaje...">
                    <label for="file-upload" class="custom-file-upload">
                        <i class="icon ph-bold ph-paperclip"></i>
                    </label>
                    <input id="file-upload" type="file" name="file" accept="image/*, .pdf, .doc, .docx"/>
                    <button type="submit"><i class="icon ph-bold ph-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var messagesContainer = document.querySelector(".messages");

        // Scroll inicial al cargar la página
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Desplazamiento suave al enviar un nuevo mensaje
        var form = document.querySelector('.send-message-form');
        form.addEventListener('submit', function() {
            setTimeout(function() {
                messagesContainer.scroll({
                    top: messagesContainer.scrollHeight,
                    behavior: 'smooth' // Desplazamiento suave
                });
            }, 100); // Puedes ajustar el tiempo aquí si es necesario
        });
    });
</script>
@endsection
