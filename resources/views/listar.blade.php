<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('/imgs-statica/l.png')}}">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Administrador</title>
    <style>
       html, body{height:100%;margin:0;padding:0;}
        #pesquisar{height:2rem;}

        #btn-pesquisar{
            width:1.5rem;
            background-image:url("storage/imgs-static/lupa.svg");
            background-size:contain;
            background-repeat:no-repeat;
            opacity:0.5;
            transition: all 0.5s;}
        #btn-pesquisar:hover{opacity:1;}

        #paginacao{color: black;}

        #btn-add{color:black;text-decoration:none}

        #clip-text{
            max-width:5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        #clip-text-content{
            max-width:8rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        thead{background-color:rgb(241, 241, 241) }
        #div-icon-conf{
            display:flex;
            flex-wrap: wrap;
            height:10px;}
            #img-lixo, #img-edit{max-height:70%;opacity:0.7;transition:all 0.5s}
            #img-edit:hover{opacity:1;}
            #img-lixo:hover{cursor:pointer; opacity:1;}

        @media (max-width: 600px)
        {
            #logo-tesla{margin-bottom:3rem;}
            #div-table{overflow:auto; }
        }

    </style>
</head>
<body>
    <section class="container">
        <header class="col-md-12 pt-4 row justify-content-between">
            <a href="{{route('adm.listar')}}"  class="col-md-2 col-sm-5 col-4 offset-md-0 offset-sm-0 offset-4">
                <img id="logo-tesla" src="{{asset('/imgs-statica/logo.png')}}" alt="logo tesla" class="col-12">
            </a>
            <form action="{{route('lista.pesquisa')}}" method="get" role="search" class="col-md-3 offset-md-3 col-sm-5 offset-sm-7">
                {{-- @csrf --}}
                <div id="div-pesquisar" class="row mt-2 d-flex justify-content-center">
                    <div class="col-md-10 col-sm-9 col-10">
                        <input type="text" id="pesquisar" name="pesquisar" class="form-control" placeholder="Pesquisar">
                    </div>
                    <button id="btn-pesquisar" class="btn col-md-1" type="submit"></button>
                </div>
            </form>
        </header>
        <p class="container text-end mt-5"><a id="btn-add" class="pt-2" href="{{route('index')}}">Adicionar</a></p>
        <div id="div-table" class="mt-1">

            <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Obs</th>
                    <th scope="col">categoria</th>
                    <th scope="col">Freq</th>
                    <th scope="col">Status</th>
                    <th scope="col">Data</th>
                    <th scope="col">Conf</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ocorrencia as $oc)
                  <tr>
                    <th scope="row">{{$oc->id}}</th>
                    <td id="clip-text">{{$oc->nome}}</td>
                    <td>{{$oc->setor}}</td>
                    <td id="clip-text-content">{{$oc->ocorrido}}</td>
                    <td id="clip-text-content">{{$oc->categoria}}</td>
                    <td>
                        @if(isset($arrayClassificacao))
                            {{$arrayClassificacao[$oc->id]}}
                        @endif
                    </td>
                    <td>@if($oc->status==1)
                            Resolvido
                        @else
                            Pendente
                        @endif
                    </td>
                    <td>{{$oc->created_at->format('d/m/y')}}</td>
                    <td>

                        <div class="row">
                            <div class="col-12" id="div-icon-conf">
                            <a id="href-edit" href="{{Route('adm.exibir',['ocorrencia'=>$oc])}}" class="col-lg-4 col-md-4 col-6 ps-0 pe-0">
                                <img class="" id="img-edit" src="{{asset('/imgs-statica/engrenagem.svg')}}">
                            </a>

                            <div id="div-lixo" class="col-lg-4 col-md-4 col-6 ps-0 pe-0">
                                <img class="" id="img-lixo" src="{{asset('/imgs-statica/lixo.svg')}}" onclick="confirmacao('{{$oc}}')">
                            </div>

                            </div>
                        </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
        <div id="paginacao">
            <nav aria-label="">
                <ul class="pagination d-flex justify-content-center ">
                    @if ($ocorrencia->previousPageUrl())
                    <li class="page-item"><a class="page-link text-dark" href="{{$ocorrencia->previousPageUrl();}}">Anterior</a></li>
                    @endif

                    @if ($ocorrencia->hasMorePages())
                    <li class="page-item" ><a class="page-link text-dark" href="{{$ocorrencia->nextPageUrl();}}">Próximo</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </section>

    <script>
        function confirmacao(){
            $("#exampleModal").modal();
        }
    </script>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title  col-12">Certeza que deseja excluir?</h5>

                </div>
                <div class="modal-body" id="modal-body">
                    <div id="div-img-modal" class="row d-flex justify-content-center">
                        <button class="offset-0 col-4 btn btn-success">Confirmar</button>
                        <button class="offset-1 col-4 btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>
