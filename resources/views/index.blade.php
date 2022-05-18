<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('/imgs-statica/l.png')}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Banco de erros</title>
    <style>
        html, body{height:100%;}
            .container{
                height:100%;
                background-color:white;
                display:flex;
                justify-content:center;
                align-items: center;}
                .btn-definir{
                    color:black;
                    text-decoration:none}
                    .btn-definir:hover{color:black}
    </style>

</head>
<body>
    <section class="container">
        <div id="div-form" class="col-md-6 ">
            <img id="logo-tesla" src="{{asset('/imgs-statica/logo.png')}}" class="mb-3 col-4 offset-4" alt="">
            <p class="text-end col-2 offset-10"><a class="btn-definir " href="{{route('adm.listar')}}">Lista</a></p>
            <form action="{{route('ocorrencia.store')}}" method="POST" class="needs-validation"  novalidate>
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-7">
                        <label for="Nome" class="form-label">Nome</label>
                        <input type="text" maxlength="60" class="form-control" id="input-nome" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="mb-3 col-md-5">
                        <label for="setor" class="form-label">Setor</label>
                        <select name="setor" class="form-select" aria-label="Default select example" required>
                            <option selected value="">Setores</option>
                            <option value="vendas">Vendas</option>
                            <option value="rh">Recursos Humanos</option>
                            <option value="finaceiro">Financeiro</option>
                            <option value="tecnico">Técnico</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ocorrido" class="form-label">Categoria/Palavras-chave</label>
                    <input type="text" maxlength="100" name="categoria" class="form-control" placeholder="Adicione algumas palavras separando por espaço" required>
                </div>
                <div class="mb-3">
                    <label for="ocorrido" class="form-label">Problema</label>
                    <textarea maxlength="500" name="ocorrido" class="form-control" id="textarea-ocorrido" rows="3" placeholder="O que está acontecendo ?" required></textarea>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button id="btn-enviar" type="submit" class="btn btn-outline-success">Enviar</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
    </script>

</body>
</html>
