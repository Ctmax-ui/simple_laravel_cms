<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <a href="{{route("users.index")}}">Go back</a>

    <form action="{{ route('users.update', $userData->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $userData->name }}">
        @error('name')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
        <input type="email" name="email" value="{{ $userData->email }}">
        @error('email')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
        <input type="submit" value="update">
    </form>

</body>

</html>
