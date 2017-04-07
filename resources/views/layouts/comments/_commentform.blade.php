<form method="POST" action="/Comment/{{$post->id}}">

    <div class="form-group">

        <textarea name="content" class="form-control" rows="5" required></textarea>

    </div>
    <div class="form-group">

        <button type="submit" class="btn btn-primary">
        Add Comment
        </button>

    </div>

    @include('layouts/_alert')

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

</form>