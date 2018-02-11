@php
if (!isset($menu)) {
    $menu = \App\Extras\TemplateBuilder\MenuGenerator::getMenuFromRoute();
}
@endphp

@if(is_array($menu)&& empty($menu))
@endif    

@if(is_array($menu) && count($menu) > 0)
    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            @php
                $tag_closed = true;
                $tag_closed1 = true;
            @endphp
            @foreach($menu as $key => $item)
                @php
                    $exploded = explode('.',$key);
                    $count = count($exploded);
                @endphp
                @if($count == 1)
                    {{-- Header of the menu --}}
                    <li class="navigation-header">
                        <span>{{__($exploded[0])}}</span>
                        <i class="zmdi zmdi-more"></i>
                    </li>
                    {{-- Menu --}}

                @endif
                @switch($count)
                    @case(2)
                    @if($tag_closed)
                        <li>
                    @else
                        </li>
                        <li>
                        @php
                            $tag_closed = true;
                            $tag_closed1 = true;
                        @endphp
                    @endif
                    @continue
                    @break
                    @case(3)
                    @if($tag_closed)
                        <ul>
                        <li>
                    @else
                        </li>
                        <li>
                        @php
                            $tag_closed1 = true;
                        @endphp
                    @endif
                    @continue
                    @break
                    @case(4)

                    @continue
                    @break
                @endswitch
                @if(is_array($item))
                    @foreach($item as $key => $item )
                        <li>
                            @if(is_array($first_item))
                                <a class="{{(\url()->current() == $first_item[0]['url'])?'active':''}}"
                                   href="{{(count($first_item) > 1)?'javascript:void(0);':$first_item[0]['url']}}"
                                        {!!(count($first_item) > 1)?'data-toggle="collapse" data-target="#'.$first_key.'"':''!!}>
                                    <div class="pull-left"><i class="zmdi {{$first_item[0]['icon']}} mr-20"></i><span
                                                class="right-nav-text">{{$first_item[0]['label']}}</span>
                                    </div>
                                    <div class="pull-right">
                                        @if(count($first_item) > 1)
                                            <i class="zmdi zmdi-caret-down"></i>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                                @if(count($first_item) > 1)
                                    <ul id="{{$first_key}}" class="collapse collapse-level-1">
                                        @unset($first_item[0])
                                        @foreach($first_item as $second_key => $second_item)
                                            <li>
                                                <a class="{{(\url()->current() == $second_item[0]['url'])?'active':''}}"
                                                   href="{{(count($second_item) > 1)?'javascript:void(0);':$second_item[0]['url']}}"
                                                        {!!(count($second_item) > 1)?'data-toggle="collapse" data-target="#'.$second_key.'"':''!!}>
                                                    <div class="pull-left"><span
                                                                class="right-nav-text">{{$second_item[0]['label']}}</span>
                                                    </div>
                                                    <div class="pull-right">
                                                        @if(count($second_item) > 1)
                                                            <i class="zmdi zmdi-caret-down"></i>
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                                @if(count($second_item) > 1)

                                                    <ul id="{{$second_key}}" class="collapse collapse-level-2">
                                                        @unset($second_item[0])
                                                        @foreach($second_item as $third_key => $third_item)
                                                            <li>
                                                                <a href="{{$third_item[0]['url']}}">{{$third_item[0]['label']}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ul>
    </div>
    <!-- /Left Sidebar Menu -->
@endif