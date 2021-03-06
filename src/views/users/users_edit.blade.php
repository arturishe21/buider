@extends('admin::layouts.default')

@section('ribbon')
   <ol class="breadcrumb">
        <li><a href="/admin">{{__cms("Главная")}}</a></li>
        <li><a href="/admin/tb/users">{{__cms("Пользователи")}}</a></li>
        <li>{{$user->first_name}} {{$user->last_name}}</li>
   </ol>
@stop

@section('scripts')
<script src="{{asset('packages/vis/builder/tb-user.js')}}"></script>
<script>
    TBUser.admin_uri = '{{\Config::get('builder::admin.uri')}}';
    TBUser.id_user   = '{{$user->id}}';
    $("title").text("{{$user->first_name}} {{$user->last_name}} - {{{ __cms(Config::get('builder::admin.caption')) }}}");
</script>
@stop

@section('main')
    <div id="content">
        

<div class="widget-body no-padding">
    <form id="user-update-form" method="post" class="smart-form" novalidate="novalidate" action="{{ url(\Config::get('builder::admin.uri') .'/tb/users/update') }}">
        
    <ul class="nav nav-tabs tabs-pull-right bordered">
        <li class="pull-right">
            <a href="#l3" data-toggle="tab">{{__cms("Группы")}}</a>
        </li>
        <li class="pull-right">
            <a href="#l1" data-toggle="tab">{{__cms("Права")}}</a>
        </li>
        <li class="active">
            <a href="#l2" data-toggle="tab" class="active">{{__cms("Профайл")}}</a>
        </li>
    </ul>
    
    <div class="tab-content padding-10">
        <div class="tab-pane" id="l1">
            <div class="widget-body no-padding" style="margin: -10px;">
                
            <?php $permissions = \Config::get('builder::users.permissions', array()); ?>
            @foreach ($permissions as $ident => $info)
            <header style="margin:0px 0 0; padding-left: 10px;">{{$info['caption']}}</header>
            
            <fieldset style="padding: 14px 14px 5px;">
                <section>
                    <div class="row">
                @foreach ($info['rights'] as $id => $caption)
                    <?php 
                    $type = $ident .'.'. $id;
                    // HACK: 0 stands for inheritance, that doesnt saving to db
                    $perm = isset($userPermissions[$type]) ? $userPermissions[$type] : 0;
                    ?>
                    <div class="col col-3">
                        <label class="label">{{$caption}}:</label>
                        <label class="radio">
                            <input type="radio" name="permissions[{{$ident}}][{{$id}}]" value="1" @if($perm === 1) checked="checked" @endif>
                            <i></i>Разрешить</label>
                        <label class="radio">
                            <input type="radio" name="permissions[{{$ident}}][{{$id}}]" value="-1" @if($perm === -1) checked="checked" @endif>
                            <i></i>Запретить</label>
                        <label class="radio">
                            <input type="radio" name="permissions[{{$ident}}][{{$id}}]" value="0" @if($perm === 0) checked="checked" @endif>
                            <i></i>Наследовать</label>
                    </div>
                @endforeach
                    </div>
                </section>
            </fieldset>
            <hr>
            @endforeach
            </div>
        </div>
        
        <!-- start tab 2 -->
        <div class="tab-pane active" id="l2">
            <div class="widget-body no-padding" style="margin: -10px;">

                    <fieldset>
                        <div class="row">
                            <section class="col col-2">
                                <img id="tbu-avatar"  src="{{ $user->image ? glide($user->image,['h'=>150]) : '/packages/vis/builder/img/blank_avatar.gif' }}" style="max-width: 150px">
                                <input id="tbu-image-input" type="hidden" name="image" value="{{$user->image}}">
                                <br>
                                <div class="input input-file" style="width:150px;">
                                    <span class="button" style="width: 114px;top: 5px;line-height: 21px;text-align: center;">
                                        <input type="file" id="file" accept="image/*" onchange="TBUser.uploadImage('{{$user->id}}', this.files[0]);">
                                        {{__cms("Загрузить")}}
                                    </span>
                                    <input type="text" placeholder="" readonly="">
                                </div>
                            </section>
                            
                            <section class="col col-10">
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                            <input type="text" name="first_name" placeholder="{{__cms("Имя")}}" value="{{$user->first_name}}">
                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                            <input type="text" name="last_name" placeholder="{{__cms("Фамилия")}}" value="{{$user->last_name}}">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
                                            <input type="email" name="email" placeholder="E-mail" value="{{$user->email}}" autocomplete="off">
                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-prepend fa fa-lock"></i>
                                            <input type="password" name="password" placeholder="{{__cms("Пароль")}}" value="" autocomplete="off">
                                        </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="checkbox">
                                            <input type="checkbox" 
                                                name="activated"
                                                @if ($user->isActivated())
                                                    checked="checked"
                                                @endif
                                                ><i></i>
                                            {{__cms("Активен")}}
                                        </label>
                                    </section>
                                </div>    
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="checkbox">
                                            <input type="checkbox" 
                                                @if ($user->is_subscribed)
                                                    checked="checked"
                                                @endif
                                                name="is_subscribed"><i></i>
                                           {{__cms("Подписан на рассылку")}}
                                        </label>
                                    </section>
                                </div>
                            </section>
                        </div>
                    </fieldset>    
            </div>
        </div>
        <!-- end tab 2 -->
        
        
        <div class="tab-pane" id="l3">
            <div class="widget-body no-padding" style="margin: -10px;">
                <header style="margin:0px 0 0; padding-left: 10px;">{{__cms("Группы пользователя")}}</header>
                <fieldset style="padding: 14px 14px 5px;">
                    <section>
                        <div class="row">
                            <div class="col col-4">
                                @foreach ($groups as $group)
                                <label class="checkbox">
                                    <input type="checkbox" 
                                           @if (in_array($group->name, $userGroups, true))
                                            checked="checked" 
                                           @endif
                                           name="groups[{{ $group->id }}]">
                                    <i></i>{{ $group->name }}</label>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </fieldset> 
            </div>
        </div>
        
        </div>

        <div class="modal-footer" style="padding-top: 15px">
            <i class="fa fa-gear fa-41x fa-spin" style="display: none"></i>
                <button class="btn btn-success btn-sm" type="button" onclick="TBUser.doEdit('{{$user->id}}');">
                <span class="glyphicon glyphicon-floppy-disk"></span>
                    {{__cms("Сохранить")}}
                </button>
            <a href="{{ url(\Config::get('builder::admin.uri') .'/tb/users') }}" style="margin-left: 10px">
                <button class="btn btn-default" data-dismiss="modal" type="button"> {{__cms("Отмена")}} </button>
            </a>
        </div>
    </form>


    </div>
@stop