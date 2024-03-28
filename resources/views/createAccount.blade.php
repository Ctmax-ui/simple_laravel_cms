<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if (Session::has("success"))
        {{Session::get("success")}}
    @endif

    <a href="/users">Get back</a>

    <form action="{{route("users.store")}}" method="POST" class="d-grid w-25">
        @csrf
        <input name="name" type="text" placeholder="Name" value="{{old('name')}}">
        @error("name")
        <span class="text-danger">
            {{$message}}
        </span>
        @enderror
        <input name="email" type="email" placeholder="Your Email" value="{{old('email')}}">
        @error("email")
        <span class="text-danger">
            {{$message}}
        </span>
        @enderror
        <input name="password" type="text" placeholder="Your password" value="{{old('password')}}">

        <input name="password_confirmation" type="text" placeholder="Confirm password" value="">
        @error("password")
        <span class="text-danger">
            {{$message}}
        </span>
        @enderror
        <input type="submit" value="submit">
    </form>
    
</body>
</html>