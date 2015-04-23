<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{trans('common.pianke')}} | Pianke.</title>

    <link href="{{$static}}/css/bootstrap.css" rel="stylesheet">
    <link href="{{$static}}/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{$static}}/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="{{$static}}/css/animate.css" rel="stylesheet">
    <link href="{{$static}}/css/style.css" rel="stylesheet">
    @yield('css')

</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div style="float:left; margin:0 10px;"><span>
                        <img width="50" height="50" alt="image" class="img-circle" src="{{$static}}{{\Session::get('adminlogin')->photo}}">
                             </span></div>
                    <div class="dropdown profile-element"> 
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{\Session::get('adminlogin')->name}} [ID: {{\Session::get('adminlogin')->id}}]</strong>
                             </span> <span class="text-muted text-xs block">{{\Session::get('adminlogin')->role->name}} <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{action('\Pianke\Http\Controllers\AdminHomeController@getProfile')}}">{{trans('common.changeprofile')}}</a></li>
                                <li><a href="{{action('\Pianke\Http\Controllers\AdminHomeController@getChangepass')}}">{{trans('common.changepass')}}</a></li>
                                <li><a href="{{action('\Pianke\Http\Controllers\AdminHomeController@getUploadphoto')}}">{{trans('common.changephoto')}}</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:noticeMute()" id="mutecontrol">{{trans('admin.mute')}}</a></li>
                                <li><a href="javascript:sideMsg()" id="sidebarcontrol">{{trans('admin.sidebar')}}</a></li>
                                <li class="divider"></li>
                                <li><a href="{{action('\Pianke\Http\Controllers\AdminLoginController@getLogout')}}">{{trans('common.logout')}}</a></li>
                            </ul>
                    </div>

                    <div class="logo-element">
                        {{trans('common.pianke')}}
                    </div>
                </li>
                @if ('\\'.\Route::currentRouteAction() == '\Pianke\Http\Controllers\AdminHomeController@getIndex')
                <li class="active">
                @else
                <li>
                @endif
                <a href="{{action('\Pianke\Http\Controllers\AdminHomeController@getIndex')}}"><i class="fa fa-home large"></i> <span class="nav-label">{{trans('admin.homeindex')}}</span></a>
                </li>
                @foreach ($menu as $mitem)
                <li id = "{{$mitem['name']}}">
                <a href="#"><i class="{{$mitem['icon']}}"></i> <span class="nav-label">{{$mitem['name']}}</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                @foreach ($mitem['list'] as $submitem)
                @if ('\\'.\Route::currentRouteAction() == $submitem['route'])
                <li class="active">
                <script type="text/javascript">
                document.getElementById("{{$mitem['name']}}").className = 'active';
                </script>
                @else
                <li>
                @endif
                <a href="{{action($submitem['route'])}}">{{$submitem['name']}}</a></li>
                @endforeach
                </ul>
                </li>
                @endforeach
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <!--<form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>-->
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown" id="msgarea">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i>  <span class="label label-warning" id="msgnum"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages" id="msgbox">

                        </ul>
                    </li>
                    <li class="dropdown" id="alertarea">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  <span class="label label-primary" id="alertnum"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts" id="alertbox">

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:if(confirm('现在要退出系统吗?'))window.location='{{action("\Pianke\Http\Controllers\AdminLoginController@getLogout")}}'">
                            <i class="fa fa-sign-out"></i> {{trans('common.logout')}}
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="sidebard-panel" id="sidebarmsg" style="display: none;">
            <div>
                <h4>Messages <span class="badge badge-info pull-right">16</span></h4>
                <div class="feed-element">
                    <a href="#" class="pull-left">
                        <img alt="image" class="img-circle" src="{{$static}}/img/nophoto.jpg">
                    </a>
                    <div class="media-body">
                        There are many variations of passages of Lorem Ipsum available.
                        <br>
                        <small class="text-muted">Today 4:21 pm</small>
                    </div>
                </div>

            </div>
        </div>
        @yield('content')
        <div class="footer">
            <div class="pull-right" id="showsimple">
                By Dong Shuai
            </div>
            <div>
                <strong>Copyright</strong> Pianke &copy; 2015-2025
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{$static}}/js/jquery-2.1.1.js"></script>
<script src="{{$static}}/js/bootstrap.min.js"></script>
<script src="{{$static}}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{$static}}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{$static}}/js/plugins/toastr/toastr.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="{{$static}}/js/inspinia.js"></script>
<script src="{{$static}}/js/jquery.cookie.js"></script>
@yield('js')
<script type="text/javascript">
    //返回提示信息弹窗
    toastr.options = {
          "closeButton": true,
          "debug": false,
          "progressBar": true,
          "positionClass": "toast-top-right",
          "onclick": null,
          "showDuration": "400",
          "hideDuration": "1000",
          "timeOut": "3000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
    }
    @if (\Session::has('notice'))
    @if (\Session::get('notice.type') == 'success')
    toastr.success("{{\Session::get('notice.msg')}}","{{\Session::get('notice.title')}}")
    @elseif (\Session::get('notice.type') == 'info')
    toastr.info("{{\Session::get('notice.msg')}}","{{\Session::get('notice.title')}}")
    @elseif (\Session::get('notice.type') == 'warning')
    toastr.warning("{{\Session::get('notice.msg')}}","{{\Session::get('notice.title')}}")
    @else
    toastr.error("{{\Session::get('notice.msg')}}","{{\Session::get('notice.title')}}")
    @endif
    @endif

    //闪标题
    var flag=false;
    var newflag = false;
    var nflag = new Array();
    var msgold;
    function newMsgCount(){
        if(newflag) {
            if(flag){
                flag=false;
                $("title").html("【 New 】{{trans('common.pianke')}} | Pianke.");
            }else{
                flag=true;
                $("title").html("【&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;】{{trans('common.pianke')}} | Pianke.");
            }
        }else{
            $("title").html("{{trans('common.pianke')}} | Pianke.");
        }
    }
    //提示音设置
    function noticeMute(){
        if($.cookie('mute') == 1){
            $.cookie('mute',0,{expires: 9999, path: '/'});
            $('#mutecontrol').html("{{trans('admin.mute')}}");
        }else{
            $.cookie('mute',1,{expires: 9999, path: '/'})
            $('#mutecontrol').html("{{trans('admin.mute')}} <i class='fa fa-check'></i>");
        }
    }
    if(!$.cookie('mute')) {
        $.cookie('mute',0,{expires: 9999, path: '/'});
    }else{
        if($.cookie('mute') == 1){
            $('#mutecontrol').html("{{trans('admin.mute')}} <i class='fa fa-check'></i>");
        }else{
            $('#mutecontrol').html("{{trans('admin.mute')}}");
        }
    }

    //信息边栏设置
    function sideMsg(){
        if($.cookie('sidebar') == 1){
            $.cookie('sidebar',0,{expires: 9999, path: '/'});
            $('#sidebarcontrol').html("{{trans('admin.sidebar')}}");
        }else{
            $.cookie('sidebar',1,{expires: 9999, path: '/'})
            $('#sidebarcontrol').html("{{trans('admin.sidebar')}} <i class='fa fa-check'></i>");
        }
        sidebaract();
    }

    function sidebaract(){
        if($.cookie('sidebar') == 1){
            $('#page-wrapper').addClass("sidebar-content");
            $("#sidebarmsg").css('display','block');
        }else{
            $('#page-wrapper').removeClass("sidebar-content");
            $("#sidebarmsg").css('display','none');
        }
    }
    if(!$.cookie('sidebar')) {
        $.cookie('sidebar',0,{expires: 9999, path: '/'});
    }else{
        if($.cookie('sidebar') == 1){
            $('#sidebarcontrol').html("{{trans('admin.sidebar')}} <i class='fa fa-check'></i>");
        }else{
            $('#sidebarcontrol').html("{{trans('admin.sidebar')}}");
        }
        sidebaract();
    }


    //通知信息轮询
    function showUnreadNews() {
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "/home/notice",
                dataType: "json",
                success: function(msg) {
                    var data=eval("("+msg+")")
                    $.each(data, function(id, title) {
                        list = "";
                        if(title.num > 0){
                            $("#"+id+"num").html(title.num);
                            nflag[id] = true;
                        }else{
                            $("#"+id+"num").html('');
                            nflag[id] = false;
                        }
                        olen = 0;
                        $.each(title.list, function(id, title){
                            list += "<li><a href='/home/process-notice?k="+id+"' class='pull-left'>"
                            list += "<div class='dropdown-messages-box'>"
                            list += "<div class='media-body'>"
                            list += title.text
                            list += " <small class='text-muted'>["+title.time+"]</small>"
                            list += "</div></div></a></li>"
                            olen ++;

                        });
                        tmplist = '';
                        if(olen) {
                            tmplist += '<li></li><li><div class="text-center link-block">'
                            tmplist += '<a href="/home/process-notice?k=all_'+id+'">'
                            tmplist += '<strong>{{trans('admin.readall')}}</strong>'
                            tmplist += '</a></div></li>'
                            list = tmplist+list;
                        }else{
                            tmplist += '<li><div class="text-center link-block">'
                            tmplist += '<strong>{{trans('admin.nonewmsg')}}</strong>'
                            tmplist += '</div></li>'
                            list = tmplist+list;
                        }
                        $("#" + id + "box").html(list);
                    });
                    if(nflag['msg'] || nflag['alert']){
                        newflag = true;
                    }else{
                        newflag = false;
                    }
                    if(msgold != msg && $.cookie('mute') != 1){
                        msgold = msg;
                        if(data['msg']['num']+data['alert']['num'] > 0){
                            $('#chatAudio')[0].play();
                        }
                    }
                }
            });
        });
    }
    showUnreadNews();
    setInterval('newMsgCount()',800);
    setInterval('showUnreadNews()',5000);
</script>
</body>

</html>
