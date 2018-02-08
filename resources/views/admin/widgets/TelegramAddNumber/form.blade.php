<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    @switch ($step)
                        @case(2)
                        <h6 class="panel-title txt-dark">{{__('panel.telegram.code')}}
                            <small>
                                {{__('panel.telegram.enter_code')}}
                            </small>
                        </h6>
                        @break
                        @case(3)
                        <h6 class="panel-title txt-dark">{{__('panel.telegram.info_to_enroll')}}
                            <small>
                                {{__('panel.telegram.info_to_enroll')}}
                            </small>
                        </h6>
                        @break
                        @case(4)
                        <h6 class="panel-title txt-dark">{{__('panel.telegram.password')}}
                            <small>
                                {{__('panel.telegram.pass_to_enroll')}}
                            </small>
                        </h6>
                        @break
                        @default
                        <h6 class="panel-title txt-dark">{{__('panel.telegram.add_account')}}
                            <small>
                                {{__('panel.telegram.enter_to_enroll')}}
                            </small>
                        </h6>
                        @break
                    @endswitch
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        <form action="{{route('addTelegramAccount.store')}}" method="post">
                            {{csrf_field()}}
                            @switch ($step)
                                @case(2)
                                <input type="hidden" name="step" value="3">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('panel.telegram.code')}}</label>
                                    <input type="text" class="form-control"
                                           placeholder="{{__('panel.telegram.enter_code')}}" value="">
                                </div>
                                @break
                                @case(3)
                                <input type="hidden" name="step" value="3">

                                @break
                                @case(4)
                                <input type="hidden" name="step" value="4">

                                @break

                                @default
                                <input type="hidden" name="step" value="2">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('panel.telegram.telephone')}}</label>
                                    <input type="text" class="form-control"
                                           placeholder="{{__('panel.telegram.telephone')}}" value="">
                                </div>
                                @break
                            @endswitch
                            <blockquote>{{__('panel.press_enter_to_pass')}}</blockquote>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->