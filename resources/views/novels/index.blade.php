@extends('rrm::admin.layout')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            @if (Session::has('success'))
                @include('rrm::admin.layout.success',['msg'=>Session::get('success')])
            @endif
            @if (Session::has('error'))
                @include('rrm::admin.layout.error',['msg'=>Session::get('error')])
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            搜索
                        </header>
                        <div class="panel-body">
                            <form class="form-inline" role="form" action="{{route('admin.novels.index')}}" method="get">
                                <div class="form-group">
                                    <label class="sr-only">关键词</label>
                                    <input type="text" name="keyword" class="form-control" placeholder="关键词"
                                           value="{{old('keyword')}}">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">类别</label>
                                    <select name="classify_id" class="form-control">
                                        <option value="" @if(old('classify_id') != null) selected="selected" @endif>
                                            请选择类别
                                        </option>
                                        @foreach($classify as $k => $v)
                                            <option
                                                @if(old('classify_id') != null && old('classify_id') == $v['id']) selected="selected"
                                                @endif value="{{$v['id']}}">{{$v['label']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">状态</label>
                                    <select name="status" class="form-control">
                                        <option value="" @if(old('status') != null) selected="selected" @endif>状态
                                        </option>
                                        <option
                                            @if(old('status') != null && old('status') == 0) selected="selected"
                                            @endif value="0">隐藏
                                        </option>
                                        <option
                                            @if(old('status') != null && old('status') == 1) selected="selected"
                                            @endif value="1">可见
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">是否推荐</label>
                                    <select name="recommend" class="form-control">
                                        <option value="" @if(old('recommend') != null) selected="selected" @endif>是否推荐
                                        </option>
                                        <option
                                            @if(old('recommend') != null && old('recommend') == 0) selected="selected"
                                            @endif value="0">未推荐
                                        </option>
                                        <option
                                            @if(old('recommend') != null && old('recommend') == 1) selected="selected"
                                            @endif value="1">推荐
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">查找</button>
                                @can('admin.novels.create')<a type="button" class="btn btn-success"
                                                              onClick="location.href='{{route('admin.novels.create')}}'">新增文章</a>@endcan

                            </form>

                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            @lang('rrm::base.Controller',['model'=>'文章'])
                        </header>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> 编号</th>
                                <th><i class="fa fa-bullhorn"></i> 配图</th>
                                <th><i class="fa fa-bullhorn"></i> 标题</th>
                                <th><i class="fa fa-bullhorn"></i> 类别</th>
                                <th><i class="fa fa-question-circle"></i> 状态</th>
                                <th><i class="fa fa-question-circle"></i> 推荐</th>
                                <th><i class="fa fa-bookmark"></i> 阅读量</th>
                                <th><i class="fa fa-bookmark"></i> 点赞量</th>
                                <th><i class="fa fa-bookmark"></i> 创建时间</th>
                                <th><i class="fa fa-bookmark"></i> 更新时间</th>
                                <th><i class="fa fa-bookmark"></i> 操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $v)
                                <tr>
                                    <td>{{$v['id']}}</td>
                                    <td>
                                        @if($v['img'])
                                            <img src="{{$v['img']}}" width="200px">
                                        @endif
                                    </td>
                                    <td>{{$v['title']}}</td>
                                    <td>{{$v['classify_text']}}</td>
                                    <td>
                                        @if ($v['status'] == 1)
                                            <p class="green-text">{{$v['status_text']}}</p>
                                        @else
                                            <p class="red-text">{{$v['status_text']}}</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($v['recommend'] == 1)
                                            <p class="green-text">{{$v['recommend_text']}}</p>
                                        @else
                                            <p class="red-text">{{$v['recommend_text']}}</p>
                                        @endif
                                    </td>
                                    <td>{{$v['view']}}</td>
                                    <td>{{$v['like']}}</td>
                                    <td>{{$v['created_at']}}</td>
                                    <td>{{$v['updated_at']}}</td>
                                    <td>
                                        @can('admin.novels.update')
                                            <a href="{{route('admin.novels.update',['id' => $v['id']])}}"
                                               class="btn btn-success btn-xs">修改</a>
                                        @endcan
                                        @can('admin.novels.delete')
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" href="#myModal6"
                                                    onclick="deleteData({{$v['id']}},'【{{$v['title']}}】')">
                                                删除
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include('rrm::admin.layout.pagination',['data'=>$data,'append'=>['keyword'=>old('keyword'),'status'=>old('status'),'recommend'=>old('recommend')]])

                    </section>
                </div>
            </div>
        </section>
    </section>
    @include('rrm::admin.layout.table_modal',['id'=>'myModal6','action'=>route('admin.novels.delete'),'model'=>'文章'])
@endsection

@section('css')
    <style>
        .btn-table-right {
            float: right;
        }

        .red-text {
            color: crimson;
        }

        .green-text {
            color: #00a9b4;
        }
    </style>
@endsection

@section('js')

    <script>
    </script>
@endsection
