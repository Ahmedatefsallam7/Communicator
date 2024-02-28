<x-mail::message>

    # Welcome, {{ $message->user->name }}

    {{ json_decode($message->message_data,true)['en'] }}

    ## {!! $bodyText !!}


    Thanks from communicator team
</x-mail::message>
