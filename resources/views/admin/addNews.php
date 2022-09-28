<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавление новости</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
        crossorigin="anonymous">
    <style>
        .sign-in-form {
            margin: auto;
        }
        #fullDescription {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            height: 100px;
        }
    </style>
</head>
<body>
<header>
    <?php include_once "menu.php"; ?>
</header>
<div class="container text-center">
    <div class="row">
        <h1>Страница добавления новости</h1>
        <form method="post" class="sign-in-form mt-5 mt-md-5 col-lg-4 col-md-5 col-sm-8">

            <label class="visually-visible">Название новости</label>
            <input type="text" id="newsName" name="newsName" class="form-control mt-3">
            <br>
            <label class="visually-visible">Подробное описание новости</label>
            <input type="text" id="fullDescription" name="fullDescription" class="form-control mt-9">
            <br>
            <label class="visually-visible">Краткое описание новости</label>
            <input type="text" id="shortDescription" name="shortDescription" class="form-control mt-3">
            <br>

            <button class="w-75 btn btn-lg btn-primary mt-1" type="submit">Добавить новость</button>

        </form>
    </div>
</div>
</body>
