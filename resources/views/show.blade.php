<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="text-center">Show all users</h1>

    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>Id</th>
            <th>User_name</th>
            <th>user_email</th>
            <th>user_password</th>
            <th>Data_delete</th>
            <th>Edit_delete</th>
        </tr>
        @foreach ($data as $val)
            <tr>
                <td>{{ $val['id'] }}</td>
                <td><a href="{{ route('users.show', ['user' => $val->id]) }}">{{ $val['name'] }}</a></td>
                <td>{{ $val['email'] }}</td>
                <td>{{ $val->password }}</td>
                <td>
                    <form action="{{ route('users.destroy', ['user' => $val->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('users.edit', ['user' => $val->id]) }}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
    <h4 class=" text-center"><span class="text-success">
        @if (Session::has('success'))
            {{ Session::get('success') }}
        @endif
    </span></h4>
    <h3 class="text-center"><a href="users/create" >Create users</a></h3>
</body>

</html>
