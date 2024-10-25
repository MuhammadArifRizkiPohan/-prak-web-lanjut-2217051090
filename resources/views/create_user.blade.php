<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 600px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
<form action="{{ route('user.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" class="form-control" required minlength="3" maxlength="255">
    </div>

    <div class="form-group">
        <label for="npm">NPM:</label>
        <input type="text" name="npm" id="npm" class="form-control" required pattern="\d{8}" title="NPM harus terdiri dari 8 digit angka">
    </div>

    <div class="form-group">
        <label for="kelas_id">Kelas:</label>
        <select name="kelas_id" id="kelas_id" class="form-control" required>
            <option value="">Pilih Kelas</option>
            @foreach ($kelas as $kelasItem)
                <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>