<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('csv.import') }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="file" name="csv_file">
        <button type="submit">Import</button>
    </form>

</body>

</html>
