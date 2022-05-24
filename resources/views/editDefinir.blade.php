<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('/imgs-statica/l.png')}}">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Classificação</title>
    <style>
        html,body{height:100%;margin:0;padding:0;}
        header{}
        header img{}
        section{}
        .btn-definir a{text-decoration:none}
        .btn-definir:hover{color:black}
        .justif-text{text-align: justify}
        #div-img{
            position:relative;
            box-sizing:border-box;
            padding:0;}
        #imgs{height:7rem;margin-top:1rem;}
        #btn-close{
            position:absolute;
            right:0;
            margin-top:0.5rem;}
        #href-img{
            height:70%;
            width:70%;
            height:100%;
            width:100%;
            margin-top:0.5rem}
        #btn-close{
            width:1rem;
            height:1rem;}
        #btn-close img{
            width:100%;
            height:100%;
            opacity:0.6;
            transition:all 0.5s;}
        #btn-close img:hover{opacity:1}
    </style>
</head>
<body>
    <header class="container">
        <img class="col-4 col-md-2 col-sm-2 offset-4 offset-md-5 offset-sm-6 pt-5" src="{{asset('/imgs-statica/logo.png')}}" alt="">
    </header>
    <section class="container mt-5 pb-5">
        <form   @if(isset($classificacao))
                    action="{{route('classificacao.update',['ocorrenciaid'=>$ocorrencia->id])}}"
                @else
                    action="{{route('classificacao.store',['ocorrenciaid'=>$ocorrencia->id])}}"
                @endif method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
            <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 col-12 d-flex flex-wrap">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label"><b>Nome:</b></label>
                        <label class="form-label" for="">{{$ocorrencia->nome}}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label"><b>Setor:</b></label>
                        <label class="form-label" for="">{{$ocorrencia->setor}}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label"><b>Data:</b></label>
                        <label class="form-label" for="">{{$ocorrencia->created_at->format('d/m/y')}}</label>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-6">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="row">
                            <label class="form-label col-lg-3 col-md-5 col-12" for=""><b>Frequência:</b></label>
                            <div class="col-lg-4 col-md-6 col-12">
                                @if (isset($classificacao))
                                    <input class="form-control" type="number" name="freq" required
                                    @if(isset($classificacao->freq))
                                        @if (!is_null($classificacao->freq))
                                            value="{{$classificacao->freq}}"
                                        @endif
                                    @else
                                        value=0
                                    @endif>
                                @else
                                0
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12 mt-3">
                        <div class="row">
                        <label  class="form-label col-lg-3 col-md-3 col-12" for="resultado" class="form-label"><b>Resultado:</b></label>
                        <div class="col-lg-4">
                        <input type="radio" @if($ocorrencia->status==1) checked="checked" @endif class="col-lg-2 col-md-1" name="situacao" value=1>
                        <label for="" class="form-label col-lg-9 col-md-9">Resolvido</label>
                        </div>
                        <div class="col-lg-4">
                        <input type="radio" @if($ocorrencia->status==0) checked="checked" @endif class="col-lg-2 col-md-1" name="situacao" value=0>
                        <label for="" class="form-label col-lg-9 col-md-9">Pendente</label>
                        </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 col-12 d-flex flex-wrap">
                <div class="col-lg-6 col-md-6 col-12">
                    <label for="" class="form-label col-lg-12 col-md-12"><b>Observação usuário:</b></label>
                    <label class="justif-text">{{$ocorrencia->ocorrido}}</label style="background-color: blueviolet;">
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <label for="Nome" class="form-label"><b>Resolução:</b></label>
                    <textarea class="form-control" id="" name="resolucao" rows="8" placeholder="Descreva a solução do problema" required>@if(isset($classificacao)){{$classificacao->resolucao}}@endif</textarea>
                </div>
            </div>


            @if (isset($imagens))
            <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 col-12 d-flex flex-wrap">
                <label for="" class="form-label col-12 mt-3"><b>Imagens:</b></label>
                @foreach ($imagens as $img)
                <div class="col-lg-3 col-md-4 col-6" id="div-img">
                    <div class="" id="btn-close"><a href="{{route('adm.excluir.img',['imagem'=>$img])}}" id="href-img"><img src="{{asset('/imgs-statica/fechar.png')}}" alt=""></a></div>
                    <img id="imgs" src="/storage/{{$img->caminho_img}}" class="img-thumbnail col-12">
                </div>
                @endforeach
            </div>
            @endif

            <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8">
                <label for="" class="form-label mt-3"><b>Anexar images:</b></label>
                <div class="custom-file col-lg-12 col-md-12">
                    <input type="file" name="caminho_img[]" id="caminho_img" class="custom-file-input form-control" multiple>
                </div>
            </div>

            <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 mt-3 d-flex flex-wrap">
                <button type="submit" class="btn btn-outline-success col-lg-2 col-md-3 col-4 me-2">Salvar</button>
        </form>

        <a href="{{route('adm.listar')}}" class="btn btn-outline-danger col-lg-2 col-md-3 col-4" tabindex="-1" role="button" aria-disabled="true">Cancelar</a>

            {{-- </div> --}}
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
