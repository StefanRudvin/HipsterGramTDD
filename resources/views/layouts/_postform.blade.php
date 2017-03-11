
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            

<div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3> {{ $header }} </h3>
                </div>

            </div>

<form method="POST" action={{ $action }} enctype="multipart/form-data">
    
    {{ $method }}

    <div class="form-group">

        <h3>Title</h3>

        <textarea name="title" class="form-control" required>{{ $title }}</textarea>

    </div>

    <div class="form-group">

        <h3>Content</h3>

        <input type="file" name="image">

        <textarea name="content" class="form-control" rows="12" required>{{ $content }}</textarea>

    </div>
    <div class="form-group">

        <button type="submit" class="btn btn-primary">
        {{ $btnName }}
        </button>

    </div>

    @if (count($errors))

    @include('layouts/_alert')

    @endif


    <input type="hidden" name="_token" value="{{ csrf_token() }}">

</form>


        </div>
    </div>
</div>