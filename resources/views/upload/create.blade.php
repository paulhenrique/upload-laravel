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
        dl, ol, ul {
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


<!-- <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
@csrf
    <label for="img_name"> Nome da imagem </label>
    <input type="file" name="img_path[]" class="image" multiple="multiple">
    <button class="sub"> Enviar </button>
</form> -->

<div class="container mt-5">
        <form class="w-100 d-flex flex-column align-items-center" action="{{route('store')}}" method="post" enctype="multipart/form-data">
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

            <!-- <fielset class="form-group">
                <label class="" for="img_name"> Nome da(s) imagem(s)
                <input class="form-control" type="text" name="img_name" id="img_name" placeholder="nome da imagem">
            </fieldset> -->
            <div class="custom-file mt-3">
                <input type="file" name="img_path_temporario[]" class="custom-file-input" id="images" multiple>
                <input style="display:none;" type="file" name="img_path[]" class="custom-file-input" id="images-hidden" multiple>
                <label class="custom-file-label" for="images">Escolha a(s) imagem(s) </label>
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Images
            </button>
        </form>
    </div>
<script src="{{ asset('Croppie/croppie.js') }}"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script>
        $(function() {
        // Multiple images preview with JavaScript
        let containImages = [];
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
            // $(imgPreviewPlaceholder).html('');

            if (input.files) {
                var filesAmount = input.files.length;


                for (i = 0; i < filesAmount; i++) {


                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                    containImages.push(input.files[i]);
                    console.log(input.files[i]);
                }

                // $('#images-hidden').val(containImages);
                const fl = new FileList();
                fl = containImages;
                document.querySelector('#images-hidden').files = fl;
                console.log(containImages);
            }

        };

            $('#images').on('change', function() {
                multiImgPreview(this, '#upload-demo');
            });

        uploadCrop = document.querySelector('#upload-demo') = new Croppie({
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

        });
});
    </script>
</body>
</html>
