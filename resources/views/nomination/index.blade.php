<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nomination Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            {{-- <div class="text-center p-3">
                <img height="100px" src="{{asset('assets/img/logo.png')}}" alt="">
            </div> --}}
            <div class="col-md-6 py-3 my-3">
                <div class="card">
                    <div class="card-header text-center">
                        <img width="200px" src="{{asset('assets/img/logo.png')}}" alt="">
                    </div>

                    <div class="card-body">
                        @include('validate')
                        <form action="{{ route('form.store')}}" method="POST" class="was-validated">
                            @csrf
                            <div class="border p-3 shadow">
                                <h4 class="text-center">Information</h4>
                                <div class="mb-2">
                                    <label for="validationName" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}"
                                        required>
                                    <div class="invalid-feedback">Enter Your Name</div>
                                </div>
                                <div class="mb-2">
                                    <label for="validationEmail" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}"
                                        required>
                                    <div class="invalid-feedback">Enter Your Email</div>
                                </div>
                                <div class="mb-2">
                                    <label for="validationPhone" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{old('phone')}}"
                                        required>
                                    <div class="invalid-feedback">Enter Your Phone</div>
                                </div>
                                <div class="mb-2">
                                    <label for="validationDescription" class="form-label">Description</label>
                                    <p id="count" class="text-left text-center mb-1 d-none" style="font-size: 10px;">
                                        Word
                                        Count: <span id="display_count">0</span> | Word Left: <span
                                            id="word_left">50</span>
                                    </p>
                                    <textarea name="description" id="description" class="form-control" cols="10"
                                        rows="3" placeholder="Not more than 50 words"
                                        required>{{old('description')}}</textarea>
                                    <div class="invalid-feedback">Enter Your Description</div>
                                </div>
                                <div class="mt-2 text-center">
                                    <button style="width: 100%" class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Footer</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
    $("#description").on('keyup', function() {
        var words = this.value.match(/\S+/g).length;
        if (words > 50) {
            // Split the string on first 200 words and rejoin on spaces
            var trimmed = $(this).val().split(/\s+/, 50).join(" ");
            // Add a space at the end to keep new typing making new words
            $(this).val(trimmed + " ");
        }
        else {
            $('#display_count').text(words);
            $('#word_left').text(50-words);
            if (words>1) {
                $('#count').removeClass('d-none');
            }else if(words<1){
                $('#count').addClass('d-none');
            } 
            else {
                $('#count').addClass('d-none');
            }
        }
    });
 });
    </script>
</body>

</html>