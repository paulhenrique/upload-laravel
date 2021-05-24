<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('Croppie/croppie.css') }}">
    <title> Upload de imagens </title>

    <style>
        .container {
            max-width: 500px;
        }

        dl,
        ol,
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .imgPreview img {
            padding: 8px;
            max-width: 100px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <form id="imageForm" class="w-100 d-flex flex-column align-items-center" action="{{route('store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="user-image mb-3 text-center">
                <div class="imgPreview"> </div>
            </div>
            <div class="user-image mb-3 text-center">
                <div class="" id="upload-demo"> </div>
            </div>

            <div class="custom-file mt-3">
                <input type="file" name="img_path_temporario" class="custom-file-input" id="images">
                <input type="hidden" name="img_path" id="images-hidden">
                <label class="custom-file-label" for="images">Escolha a(s) imagem(s) </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-4">
                Upload Images
            </button>

        </form>
    </div>
    <script src="{{ asset('Croppie/croppie.js') }}"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        // $(function() {
        function inicializarCroppie() {
            const el = document.querySelector('#upload-demo');
            const options = {
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }

            };
            return new Croppie(el, options);
        }

        const croppedDiv = inicializarCroppie();

        var multiImgPreview = function(input) {
            const that = this;
            var reader = new FileReader();

            reader.onload = function(event) {
                const url = event.target.result;
                croppedDiv.bind({
                    url
                });
            }

            reader.readAsDataURL(input.files[0]);
        }

        document.querySelector('#imageForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const imageFormHidden = document.querySelector('#imageForm');
            const imageHidden = document.querySelector('#images-hidden');
            croppedDiv.result('base64').then((base64) => {
                imageHidden.value = base64;
                console.log(imageFormHidden)

            }).then(() => {
                imageFormHidden.submit();
            });

        });

        document.querySelector('#images').addEventListener('change', function() {
            multiImgPreview(this);
        });

        // });
    </script>
</body>

</html>