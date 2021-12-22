<?php
require_once 'Database.php';

if(isset($_COOKIE['user'])) {
    echo "Hello, " . $_COOKIE['user'];
} else {
?>


<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="utf-8">

    <title>Форма регестрации.</title>
    <meta name="description" content="Article FRUCTCODE.COM. How to send ajax form.">
    <meta name="author" content="fructcode.com">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="ajax.js"></script>

</head>
<body>
<div class="alert alert-secondary" role="alert" id="errors">

</div>

<form action="action_ajax_form.php" method="post" id="ajax_form">
    <div class="mb-3">
        <label class="col-form-label">
            Введите имя:
            <input type="text" name="name"/>
        </label>
    </div>
    <div class="mb-3">
        <label>
            Введите ваш возраст:
            <input type="number" name="age"/>
        </label>
    </div>
    <div class="mb-3">
        <label>
            Введите ваш e-mail:
            <input type="email" name="email"/>
        </label>
    </div>
    <div class="mb-3">
        <label>
            Введите пароль:
            <input type="password" name="password"/>
        </label>
    </div>
    <div class="mb-3">
        <label>
            Повторите пароль:
            <input type="password" name="repeatpassword"/>
        </label>
    </div>
    <div class="mb-3">
        <input class="btn btn-primary" type="submit" id="btn" value="Отправить"/>
    </div>
</form>
</body>
</html>
<table class="table table-success table-striped">
    <tr>
        <th> ID </th>
        <th> Имя </th>
        <th> Email </th>
    <?php
    $data = new Database();

    foreach ($data -> getAll() as $row) {
        echo
            '<tr>
        <td> ' . $row['id'] . '</td>
        <td> ' . $row['name'] . '</td> 
        <td> ' . $row['email'] . '</td>
    </tr>';
            }
    echo
'</table>
<div id="result_form"></div>
</body>
</html>';

}
?>
