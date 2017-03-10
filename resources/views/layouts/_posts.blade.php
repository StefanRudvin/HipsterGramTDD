@foreach ($posts as $post)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                {{ $post->created_at->diffforHumans() }}
            </div>
            <a href="{{ $post->path() }}">
            <h3>
                {{ str_limit($post->title, $limit = 150, $end = '...') }}
            </h3>
            </a>
            
        </div>

        <div class="panel-body">
            {{ str_limit($post->content, $limit = 150, $end = '...') }}
            <div class="text-center">

                <div class="pull-right">
                    <a href="/user/{{ $post->user->id }}"> {{$post->user->name}}</a>
                </div>
                <div class="pull-left">
                    <a href="/posts/like/{{ $post->id }}">{{ $post->likesCount() }}</a>
                </div>
            </div>
        </div>
    </div>
@endforeach