<x-mail::message>
    Welcome: {{ $user }}
    <br><br>
    Subject from Template: {{ $subject }}
    <br><br>
    Body from Template: {{ $bodyText }}
    <br><br>
    <x-mail::button :url="$var_url">
        Click here
    </x-mail::button>
    <br><br>
    Variables:
    <br>
    - Name: {{ $var_name }}
    <br>
    - Subject: {{ $var_subject }}
    <br>
    - Body: {{ $var_body }}
    <br>
    - URL: {{ $var_url }}
    <br><br>
    App: {{ $app }}
    <br><br>
    Message Data: {{ $msg_data }}
    <br><br>
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
