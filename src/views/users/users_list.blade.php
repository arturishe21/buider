@extends('admin::layouts.default')

@section('title')
  Управление пользователями - {{{ Config::get('builder::admin.caption') }}}
@stop

@section('ribbon')
  <ol class="breadcrumb">
      <li><a href="/admin">Главная</a></li>
     <li>Управление пользователями</li>
  </ol>
@stop

@section('main')

  @include("admin::users.user_list_center")

@stop
