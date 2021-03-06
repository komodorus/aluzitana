@extends('adminlte::page')

@section('title', 'Banners')

@section('content_header')
    @component('dashboard.components.validation')
    @endcomponent
    <h1>Banners</h1>
@endsection

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Listagem</h3>
        <a href="#" data-toggle="modal" data-target="#addBanner" class="btn btn-flat btn-primary btn-sm" style="margin-left: 15px;">
            Banner <i class="fa fa-plus-square fa-fw" aria-hidden="true"></i>
        </a>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th></th>
                            <th>
                                Banner
                            </th>
                            <th>
                                Titulo
                            </th>
                            <th>
                                Ativo
                            </th>
                            <th>
                                Ação
                            </th>
                        </thead>
                        <tbody id="banners">
                            @foreach ($banners as $banner)
                                <tr data-id="{{ $banner->id }}">
                                    <td style="width: 5%; vertical-align: middle"><i class="fa fa-bars my-handle" aria-hidden="true"></i></td>
                                    <td style="width: 25%">
                                        <a href="{{ asset('storage/' . $banner->path) }}" data-lightbox="banners" style="min-width: 100%;">
                                            <img src="{{ asset('storage/' . $banner->path) }}" style="height: 15%;" alt=""> 
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle">
                                        <span style="margin-left: 0 auto; display: inline-block">{{ $banner->title }}</span>
                                    </td>
                                    <td style="width: 5%; vertical-align: middle">
                                        <label class="switch" style="margin-left: auto; display: inline-block;">
                                            <input id="switch" data-id="{{ $banner->id }}" type="checkbox" {{ $banner->active ? 'checked' : ''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td style="width: 5%; vertical-align: middle; text-align: center;">
                                        <a href="#" onClick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir o banner?')){document.getElementById('delete-tabloide-{{ $banner->id }}').submit()}" data-toggle="tooltip" title="Apagar">
                                            <i class="fa fa-times text-danger fa-fw" aria-hidden="true"></i>
                                        </a>
                                        <form id="delete-tabloide-{{ $banner->id }}" action="{{ route('dashboard.banners.destroy', $banner->id) }}" class="hidden" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                    </td>
                                </tr>                          
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addBanner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Banner</h4>
                </div>
                <form action="{{ route('dashboard.about.banner') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="#title">Titulo</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <label for="#banner">Banner</label>
                            <input type="file" class="form-control" name="banner" id="banner">
                            <p class="help-block"><i class="fa fa-info-circle" aria-hidden="true"></i> Tamanho sugerido: 1920x500</p>
                        </div>
                        <div class="form-group">
                            <label for="#link">Link</label>
                            <input type="url" class="form-control" name="link" id="link">
                            <p class="help-block"><i class="fa fa-info-circle" aria-hidden="true"></i> Opcional</p>
                        </div>
                        <div class="checkbox">
                            <label for="#active">
                                <input type="checkbox" name="active" id="active" checked> Ativo
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="#external_link">
                                <input type="checkbox" name="external_link" id="external_link"> Abrir em outra aba
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="category" value="2">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <style>
        .my-handle:hover{
            cursor: pointer;
        }
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 55px;
            height: 25px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }

        input:checked + .slider {
            background-color: #2196f3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196f3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
@endsection

@section('js')
    <script>
        var base_url = "{{ env('APP_URL') }}";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip(); 

            var el = $('#banners')[0];
            console.log(el);
            var sort = Sortable.create(el, {
                group: "name",  // or { name: "...", pull: [true, false, clone], put: [true, false, array] }
                sort: true,  // sorting inside list
                delay: 0, // time in milliseconds to define when the sorting should start
                touchStartThreshold: 0, // px, how many pixels the point should move before cancelling a delayed drag event
                disabled: false, // Disables the sortable if set to true.
                store: null,  // @see Store
                animation: 150,  // ms, animation speed moving items when sorting, `0` — without animation
                handle: ".my-handle",  // Drag handle selector within list items
                filter: ".ignore-elements",  // Selectors that do not lead to dragging (String or Function)
                preventOnFilter: true, // Call `event.preventDefault()` when triggered `filter`

                // Called by any change to the list (add / update / remove)
                onSort: function (/**Event*/evt) {
                    var itemEl = evt.item;  // dragged HTMLElement
                    evt.to;    // target list
                    evt.from;  // previous list
                    evt.oldIndex;  // element's old index within old parent
                    evt.newIndex;  // element's new index within new parent
                    var li = $('#banners tr');
                    var newOrder = [];

                    $.each(li, function(index, value){
                        return  newOrder.push($(value).data('id'));
                    });
                    
                    
                    $.post(base_url + '/api/about-banners/order', {'order[]': newOrder}, function(status, response){
                        console.log(response);
                    });
                }
            });
            $('#body').summernote({
                height: 150
            });

            $('.switch').on('click', 'input[type="checkbox"]' ,function(){
                var toggler = $(this);
                var id = toggler.data('id');
                var checked = toggler.prop("checked");
            
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post(base_url + '/api/about-banners/toggle/' + id, function(data, status){
                    checked ? toastr.success("Perfil ativado") : toastr.error("Perfil desativado")
                });
            });
        });
    </script>
@endsection