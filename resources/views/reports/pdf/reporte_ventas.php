<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data["name"] ?></title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    * {
        font-family: Arial, Helvetica, sans-serif;
    }

    table,
    td,
    th {
        border: 1px solid;
        padding: 2px 5px;
    }
    </style>
</head>

<body>
    <h2><?= $data["name"] ?></h2>
    <table>
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data["user"] as $key => $value) { ?>
            <tr>
                <td><?= $value->num_documento ?></td>
                <td><?= $value->nombre ?></td>
                <td><?= $value->direccion ?></td>
                <td><?= $value->email ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>