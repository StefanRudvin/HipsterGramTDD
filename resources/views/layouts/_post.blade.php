<div class="panel panel-default">
    <div class="panel-heading">

        <div class="text-right">
            {{ $post->User->username }}
            <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a>
        </div>

        <div class="pull-right">
            {{ $post->created_at->diffforHumans() }}
        </div>

        <div class="text-center"><h3>{{ $post->title }}</h3></div>

        <div class="panel-body">
        {{ $post->content }}
        </div>
        
        <div class="pull-right">
            <a href="{{ $post->id }}/edit ">Edit</a>
        </div>

        <div class="pull-left">
            <a href="/posts/like/{{ $post->id }}">{{ $post->likesCount() }}</a>
        </div>
        
        <div class="text-center">
            -
        </div>

    </div>
</div>