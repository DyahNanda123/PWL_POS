<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
            {{-- <th>Password</th> --}}
        </tr>
        <tr>
        <td>{{ $data->user_id }}</td>
        <td>{{ $data->username }}</td>
        <td>{{ $data->nama }}</td>
        <td>{{ $data->level_id }}</td>
        {{-- <td>{{ $data->password }}</td> --}}
    </tr>
    </table>
</body>
</html>  

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Data Pengguna</title>
</head>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>Jumlah Pengguna</td>
        </tr>
        <tr>
            <td>{{ $data }}</td>
        </tr>
    </table>
</body>
</html> --}}