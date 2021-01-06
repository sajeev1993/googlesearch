@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search on google</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form method="POST" action="{{ route('search') }}">
                    {{csrf_field()}}
                        <div class="row">
                            <input type="text" class="form-control" name="search_word" @if(isset($searchWord)) value="{{$searchWord}}" else value="" @endif required>
                        </div><br>

                        <div class="row">
                            <!-- <button type="submit" class="btn btn-primary">Search</button>
                            
                            <p class="text-right"><a href="{{ route('pdfview') }}" type="submit" class="btn btn-raised btn-raised-primary btn-lg btn-rounded m-1">Download PDF</a></p> -->
                            <input type="submit" class="btn btn-primary" value="Search" name="submitbtn">&nbsp;&nbsp;&nbsp;
                            <input type="submit" class="btn btn-primary text-right" value="Download" name="submitbtn">
                        </div><br><br>
                        
                        

                        @if(isset($results))

                            @foreach($results as $result)

                                <div>
                                    <a href="{{$result->link}}" style="color:blue">{!!$result->htmlTitle!!}</a>
                                    <p>{!!$result->htmlSnippet!!}</p>
                                </div>
                                
                            @endforeach

                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
