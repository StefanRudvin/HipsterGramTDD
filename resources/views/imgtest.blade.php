@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">IMgtest</div>

                <div class="panel-body">
                    Img yoo

                    <form method="POST" action="/avatars" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <input type="file" name="avatar">

                        </input>



                        <button type="submit">Submit </button>


                    </form>
                    

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
