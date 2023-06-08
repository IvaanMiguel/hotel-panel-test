<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{$breadcrumb['main_title']}}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{isset($breadcrumb['ref']) ? route($breadcrumb['ref']) : '#'}}">{{$breadcrumb['main_title']}}</a></li>
                    @if(isset($breadcrumb['second_level']) && $breadcrumb['second_level'] != '')
                        <li class="breadcrumb-item active">{{$breadcrumb['second_level']}}</li>
                    @endif
                </ol>
            </div>

        </div>
    </div>
</div>