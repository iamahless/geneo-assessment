<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<main>
    <div class="container mt-5">

        @include('partials.flashes')

        <form method="post" action="{{ route('contact.process') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="inputFullName" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="inputFullName"
                       required>
                @if ($errors->has('name'))
                    <div class="text-danger fw-bold mt-2">{{$errors->first('name')}}</div>
                @endif
            </div>
            <div class="mb-4">
                <label for="inputEmailAddress" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="inputEmailAddress" value="{{ old('email') }}"
                       required>
                @if ($errors->has('email'))
                    <div class="text-danger fw-bold mt-2">{{$errors->first('email')}}</div>
                @endif
            </div>
            <div class="mb-4">
                <label for="inputMessage" class="form-label">Message</label>
                <textarea name="message" class="form-control" id="inputMessage" rows="4"
                          required>{{ old('message') }}</textarea>
                @if ($errors->has('message'))
                    <div class="text-danger fw-bold mt-2">{{$errors->first('message')}}</div>
                @endif
            </div>
            <div class="mb-4">
                <label for="inputFile" class="form-label">Upload File</label>
                <input class="form-control" type="file" id="inputFile" name="attachment" value="{{ old('attachment') }}"
                       accept=".pdf, .xlsx, .csv">
                @if ($errors->has('attachment'))
                    <div class="text-danger fw-bold mt-2">{{$errors->first('attachment')}}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit Form</button>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
</body>
</html>
