<h1> Listagem das imagens </h1>

@if (!empty($uploads))
    @foreach ($uploads as $upload)

    <p> {{ $upload->img_name }} </p>
    <img src="img/uploads/{{ $upload->img_path }}" alt="{{ $upload->img_name }}">
    @endforeach
@endif

<a href="/create">
    upload
</a>
