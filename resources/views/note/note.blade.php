<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@foreach($notes as $note)
    <h3>{{$note->title}}</h3>
@endforeach
<form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title">
    <input type="text" name="description">
    <input type="submit" value="add">
</form>
</body>
</html>
