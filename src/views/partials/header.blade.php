<!-- HEADER -->
        <header id="header">
            <div id="logo-group">

                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo" style="margin-top: 10px;">
                   @if($skin && $skin != "smart-style-0")
                        <img src="{{asset('/packages/vis/builder/img/logo-w.png')}}" alt="VIS-A-VIS">
                   @else
                        <img src="{{asset('/packages/vis/builder/img/logo.png')}}" alt="VIS-A-VIS">
                   @endif
                </span>
                <!-- END LOGO PLACEHOLDER -->

            </div>

            <!-- pulled right: nav area -->
            <div class="pull-right">

                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->

            <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="/admin/logout" title="Выход" data-action="userLogout" data-logout-msg="Вы можете увеличить безопасноть, закрыв браузер после выхода"><i class="fa fa-sign-out"></i></a> </span>
                </div>

                <div id="fullscreen" class="btn-header transparent pull-right">
                		<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>


                <!-- end logout button -->

                <!-- search mobile button (this is hidden till mobile view port) -->
                <div id="search-mobile" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
                </div>
                <!-- end search mobile button -->

                <!-- multiple lang dropdown : find all flags in the image folder -->




                @include('admin::partials.change_lang')

                <!-- end multiple lang -->

            </div>
            <!-- end pulled right: nav area -->

        </header>
        <!-- END HEADER -->