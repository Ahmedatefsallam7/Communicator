<x-mail::message>
    Welcome {{ $user }}
    <br>
    <br>
    subject : {{ $subject }}
    <br>
    <br>
    body text : {{ $bodyText }}
    <br>
    <br>
    <x-mail::button :url="$path">
        {{ $subject }}
    </x-mail::button>
    <br>
    <br>
    var name: {{ $var_name }}
    <br>
    <br>
    var subject: {{ $var_subject }}
    <br>
    <br>
    var body: {{ $var_body }}
    <br>
    <br>
    var_url: {{ $var_url }}
    <br>
    <br>
    App: {{ $app }}
    <br>
    <br>
    msg data: {{ $msg_data }}
    <br>
    <br>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
