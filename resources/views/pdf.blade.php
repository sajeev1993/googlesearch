
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">                  

                        @if(isset($results))

                            @foreach($results as $result)

                                <div>
                                    <a href="{{$result->link}}" style="color:blue">{!!$result->htmlTitle!!}</a>
                                    <p>{!!$result->htmlSnippet!!}</p>
                                </div>
                                
                            @endforeach

                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
