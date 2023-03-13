<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?= $this->getMeta();?>
</head>
<style>
    body {
        padding: 10px;
    }

    a {
        padding: 10px;
    }
</style>

<ul class="nav">
    <li><a href="/">Главная</a></li>
    <li><a href="/about">about</a></li>
    <li><a href="/close">close</a></li>
    <li><a href="/services/test">services</a></li>
    <li><a href="/logout">logout</a></li>
    <li><a href="/login">login</a></li>
    <li><a href="/registration">registration</a></li>
</ul>

<?= $content ?>

</body>
</html>