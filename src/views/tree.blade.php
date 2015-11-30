@extends('admin::layouts.default')

@section('title')
  {{__cms('Структура сайта')}}
@stop

@section('ribbon')
   <ol class="breadcrumb">
        <li><a href="/admin">{{__cms('Главная')}}</a></li>
        <li>{{__cms('Структура сайта')}}</li>
   </ol>
@stop

@section('main')
   @include('admin::tree_ajax')
@stop

@section('scripts_header')
    <script src="/packages/vis/builder/js/plugin/jstree/jstree.min.js"></script>
    <script src="{{ asset('packages/vis/builder/js/plugin/resizableColumns/jquery.resizableColumns.js') }}"></script>
    <script src="{{ asset('packages/vis/builder/js/plugin/resizableColumns/store.js') }}"></script>

    <script src="{{ asset('packages/vis/builder/tb-tree.js') }}"></script>

    <script>
        $(document).on('click', 'a.node_link', function (e) {

            var href = $(this).attr('href');
            doAjaxLoadContent(href);
            e.preventDefault();
        });
    </script>
@stop
