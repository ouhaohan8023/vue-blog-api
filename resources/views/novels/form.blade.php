@extends('rrm::admin.layout')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        @include('rrm::admin.layout.create_header',['model'=>'rrm::novels.model'])
                        <div class="panel-body">
                            <form role="form" method="post"
                                  action="{{request('id',false)?route('admin.novels.update',['id' => request('id')]):route('admin.novels.create')}}"
                                  enctype="multipart/form-data"
                                  id="novel-form"
                            >
                                @csrf
                                <div class="form-group @error('title') has-error @enderror">
                                    <label for="title">@lang('rrm::novels.title')</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           @if(old('title')) value="{{old('title')}}"
                                           @endif @isset($data['title']) value="{{$data['title']}}" @endisset >
                                    @error('title')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('classify_id') has-error @enderror">
                                    <label for="classify_id">@lang('rrm::novels.classify_id')</label>
                                    <select class="form-control m-bot15" id="classify_id" name="classify_id"
                                            @if(old('classify_id')) value="{{old('classify_id')}}"
                                            @endif @isset($data['classify_id']) value="{{$data['classify_id']}}" @endisset >
                                        @foreach($classify as $k => $v)
                                            <option value="{{$v['id']}}" @if(old('classify_id') == $v['id']) checked
                                                    @endif @isset($data['classify_id']) @if($data['classify_id']==$v['id']) value="{{$data['classify_id']}}" @endif @endisset>{{$v['label']}}</option>
                                        @endforeach
                                    </select>
                                    @error('classify_id')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('tags') has-error @enderror">
                                    <label for="tags">@lang('rrm::novels.tags')</label>
                                    <input name="tags" id="tags" class="tagsinput"
                                           @if(old('tags')) value="{{old('tags')}}" @endif
                                           @isset($data['tags']) value="{{$data['tags']}}" @endisset
                                           style="display: none;">
                                    @error('tags')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>是否公开</label>
                                    <input type="checkbox" name="status" class="js-switch-small js-check-change-1"
                                           value="1"
                                           @isset($data['status']) @if($data['status']==1) checked @endif @endisset/>
                                </div>
                                <div class="form-group">
                                    <label>是否推荐</label>
                                    <input type="checkbox" name="recommend" class="js-switch-small-2 js-check-change-2"
                                           value="1"
                                           @isset($data['recommend']) @if($data['recommend']==1) checked @endif @endisset/>
                                </div>

                                <div class="form-group @error('content') has-error @enderror">
                                    <label for="title">@lang('rrm::novels.content')</label>
                                    @include('components.editor',['name'=>'content'])
                                    @error('content')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group last">
                                    <label class="control-label col-md-3">@lang('rrm::novels.img')</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img
                                                    @if(isset($data['img']))
                                                    src="{{asset('storage/'.$data['img'])}}"
                                                    @else
                                                    src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                    @endif
                                                    alt=""/>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail"
                                                 style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> @lang('rrm::novels.choose image')</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> @lang('rrm::novels.change')</span>
                                                   <input type="file" class="default" name="img"/>
                                                   </span>
                                                <a href="#" class="btn btn-danger fileupload-exists"
                                                   data-dismiss="fileupload"><i
                                                        class="fa fa-trash"></i> @lang('rrm::novels.remove')</a>
                                            </div>
                                            @error('img')
                                            <span class="help-block" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="btn btn-success">@if(request('id',false)) @lang('rrm::base.update') @else @lang('rrm::base.create') @endif</button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>

    <!-- Modal -->
    <div class="modal fade modal-dialog-center" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">操作提示</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
                        <a href="{{route('admin.novels.index')}}" class="btn btn-default">返回列表</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-dialog-center" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">操作提示</h4>
                    </div>
                    <div class="modal-body2">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_panel/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_panel/assets/summernote/dist/summernote.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin_panel/assets/switchery/switchery.css')}}"/>
    <style>


    </style>
@endsection

@section('js')
    <script type="text/javascript"
            src="{{asset('admin_panel/assets/bootstrap-fileupload/bootstrap-fileupload.js?20191036')}}"></script>
    <script type="text/javascript"
            src="{{asset('admin_panel/assets/summernote/dist/summernote.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('admin_panel/js/jquery.tagsinput.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('js/switchery.js')}}"></script>
    <script>
        $('.summernote').summernote({
            height: 200,                 // set editor height

            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor

            focus: true                 // set focus to editable area after initializing summernote
        });

        $("#novel-form").submit(function () {
            var formData = new FormData();
            formData.append("_token", $("input[name='_token']").val());
            formData.append("title", $("input[name='title']").val());
            formData.append("classify_id", $('#classify_id option:selected').val());
            formData.append("content", $('.summernote').summernote('code'));
            formData.append("img", $("input[name='img']")[0].files[0]);
            formData.append("tags", $("input[name='tags']").val());
            formData.append("status", $("input[name='status']").val());
            formData.append("recommend", $("input[name='recommend']").val());
            $.ajax({
                url: window.location,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (msg) {
                    if (msg.code === 200) {
                        $('.modal-body').html('新增成功')
                        $('#myModal').modal('show')
                    } else {
                        $('.modal-body2').html('新增失败' + msg.msg)
                        $('#myModal2').modal('show')

                    }
                },
                error: function (msg) {
                    $('.modal-body2').html('新增失败' + msg.responseText)
                    $('#myModal2').modal('show')
                }
            });
            return false;
        });

        $(".tagsinput").tagsInput();

        Switchery(document.querySelector('.js-switch-small'), {size: 'small'});
        Switchery(document.querySelector('.js-switch-small-2'), {size: 'small'});


    </script>
@endsection
