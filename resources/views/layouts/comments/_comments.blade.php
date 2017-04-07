@foreach ($comments as $comment)
    <div class="panel panel-default">
        <div class="panel-heading">

            <div class="pull-right">
                {{ $comment->created_at->diffforHumans() }}
            </div>

            <div class="panel-body">
                {{ $comment->content }}

                <div class="text-center">
                    
                </div>
     
                <div class="pull-right">
                    <a href="/user/{{ $comment->user->id }}">{{ $comment->user->name }}
                    </a>
                </div>
                <div class="pull-left">
                    <a href="/Comment/like/{{ $comment->id }}">{{ $comment->likesCount() }}
                    </a>
                </div>

                <div class="text-center">
                    
                </div>
            </div>

        </div>
    </div>
@endforeach