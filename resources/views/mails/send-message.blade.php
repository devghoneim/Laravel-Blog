<x-mail::message>

<h1>{{ $data['name'] }}</h1>
<br>
<h2>{{ $data['email'] }}</h2>
<h2>{{ $data['phone'] }}</h2>
<hr>
<p>{{ $data['message'] }}</p>
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
