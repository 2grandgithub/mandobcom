<!-- START PANEL WITH STATIC CONTROLS -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> {{$panel_title??''}} </h3>
        <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li> 
                </ul>
            </li>
            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
        </ul>
    </div>
    <div class="panel-body" id="{{$panel_body_id??''}}">

        {{$body??''}}

</div><!--End panel-body-->
</div>
