@extends(site()->partial('core::%s.layouts.blank'))

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    {{ $page->title }}
                </h4>
            </div>
        	<div class="panel-body">
                {!! $page->content !!}
        	</div>
        </div>
    </div>

@stop