<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: whitesmoke;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        .profile-image {
            width: 300px;  
            height: 300px; 
            border-radius: 40%;
            object-fit: cover;
            margin-bottom: 20px;     
        }

        .profile-info {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }

        .profile-info .info-item {
            background-color: white;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-info label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-container">
        <img src="{{ asset('storage/images/profil.JPG') }}" alt="Profile Picture" class="profile-image">
            <div class="profile-info">
                <div class="info-item">
                    <label>Nama: </label> <?= $nama ?>
                </div>
                <div class="info-item">
                    <label>Kelas: </label> <?= $kelas ?>
                </div>
                <div class="info-item">
                    <label>NPM: </label> <?= $npm ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
