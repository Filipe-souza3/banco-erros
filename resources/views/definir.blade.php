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
         section {}
         .btn-definir{text-decoration:none; color: black}
         .btn-definir:hover{color:black}

         #clip-text{
            width:100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;}
        .justif-text{text-align:justify}

        #div-img{
            box-sizing:border-box;
            padding:0;}

        #imgs{
            height:7rem;
            width:0 auto;
            margin-top:1rem;}

        #img-btn-modal{
            background-image:url("/storage/imgs-static/fechar.png");
            height:2rem;
            width:2rem;
            background-size:100%;
            background-position:center;
            background-repeat:no-repeat;
            border-radius:50%;
            border:none;
            opacity:0.4;
            transition:all 0.5s;}

        #img-btn-modal:hover{opacity:1;}
        #div-img-modal{}
        #img-modal{max-height:74vh;
           max-width:100%; width:auto;}

    </style>
</head>
<body>
    <header class="container">
        <img class="col-4 col-md-2 col-sm-2 offset-4 offset-md-5 offset-sm-6 pt-5" src="{{asset('/imgs-statica/logo.png')}}" alt="">
    </header>
    <section class="container mt-4">
            <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 col-12">
                <div class="row offset-lg-10 col-lg-2 offset-md-9 col-md-3 offset-8 col-4">
                    <label class="form-label col-md-6 col-6 text-end">
                        <a class="btn-definir" href="{{route('adm.editar',['classificacao'=>$classificacao])}}">Editar</a>
                    </label>
                    <label class="form-label col-md-6 col-6 text-end">
                        <a class="btn-definir" href="{{route('adm.listar')}}">Lista</a>
                    </label>
                </div>
            </div>
            <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 col-12 d-flex flex-wrap">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="col-12 col-md-12 col-lg-12">
                        <label for="" class="form-label"><b>Nome:</b></label>
                        <label for="" class="form-label">{{$ocorrencia->nome}}</label>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <label for="" class="form-label"><b>Setor:</b></label>
                        <label for="" class="form-label">{{$ocorrencia->setor}}</label>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <label for="" class="form-label"><b>Data:</b></label>
                        <label for="" class="form-label">{{$ocorrencia->created_at->format('d/m/y')}}</label>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-6">
                    <div>
                        <label for="" class="form-label"><b>Frequência:</b></label>
                        <label class="form-label">{{$classificacao->freq}}</label>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <label  class="form-label" for="resultado" class="form-label"><b>Resultado:</b></label>
                            @if ($ocorrencia->status==1)
                            <label for="" class="form-label">Resolvido</label>
                            @else
                            <label for="" class="form-label">Pendente</label>
                            @endif
                    </div>
                </div>
            </div>

        <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 col-12 d-flex flex-wrap mb-5">
            <div class="col-lg-6 col-md-6 col-12">
                <label for="" class="form-label"><b>Observação usuário:</b></label>
                <label class="form-label justif-text">{{$ocorrencia->ocorrido}}</label style="background-color: blueviolet;">
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <label for="Nome" class="form-label"><b>Resolução:</b></label>
                <label class="form-label justif-text">{{$classificacao->resolucao}}</label style="background-color: blueviolet;">
            </div>

            @if(isset($imagens))
                <label for="" class="form-label mt-3"><b>Imagens:</b></label>
                <div class="col-lg-12 col-md-12 col-12 d-flex flex-wrap">
                    @foreach ($imagens as $img)
                    <div class=" col-lg-3 col-md-4 col-6" id="div-img">
                        <img id="imgs" src="/storage/{{$img->caminho_img}}" class="img-thumbnail col-12" onclick="modalImg('{{$img->caminho_img}}')">
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <script>
        function modalImg(img){
            $("#img-modal").attr("src","/storage/"+img);
            $("#exampleModal").modal();
        }
    </script>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clip-text">{{$ocorrencia->nome}}</h5>
                    <button type="button" id="img-btn-modal" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <div id="div-img-modal" class="row d-flex justify-content-center">
                        <img id="img-modal" src="">
                    </div>
                </div>
                <div class="modal-footer">{{$ocorrencia->setor." - ".$ocorrencia->created_at->format('d/m/y')}}</div>
            </div>
        </div>
    </div>

 <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>

