@extends('layouts/public')
@section('content')

    <h2>{{ $topic->subject }}</h2>
    <table class="table table-dark table-bordered">
        <tr>
            <th>User</th>
            <th>Message</th>
        </tr>
        @foreach ($posts as $post)
            <tr @if($loop->last) id="lastPost" @endif>
                @if ($posts->currentPage() === $posts->lastPage() && $loop->last && $post->user->id === Auth::id())
                    <td><a href="javascript:editLastMessageModal()">{{ $post->user->name }}</a></td>
                    <td><a href="javascript:editLastMessageModal()">{{ $post->message }}</a></td>
                @else
                    <td>{{ $post->user->name }} </td>
                    <td>{{ $post->message }}</td>
                @endif
            </tr>
        @endforeach
    </table>
    @auth

        <form style="width:100%" id="addPostForm" method="post">
            <label for="message">Your message</label>
            <textarea name="message" rows="4" class="form-control" placeholder="Write your thoughts here..."
                      required></textarea>
            <br/>
            <button class="btn btn-primary" type="submit">
                Add Reply
            </button>
        </form>
    @else
        <br/>
        You must  <a href="{{route('login') }}" class="link-secondary">log in</a> to post reply
    @endauth
    {{ $posts->links() }}
    <div style="display:none" id="editMessage">
        <form id="editMessageForm" method="post">
            <textarea name="message" id="editMessageTextArea" rows="4" class="form-control"
                      placeholder="Write your thoughts here..." required>{{ $post->message }}</textarea>
            <button type="submit" id="editMessageFormButton" style="display:none"></button>
        </form>
    </div>
    @if (request()->get('addedPost'))
        <script>
            $('html, body').scrollTop($("#lastPost").offset().top);
        </script>
    @endif
    <script>
        $("#addPostForm").on("submit", function (event)
        {
            event.preventDefault();
            $.post("{{ route('forum_addPost') }}", $(this).serializeArray())
            .done(function (data)
            {
                window.location = data.url + "&addedPost=1"
            });
        });
    </script>
    <script>
        function editLastMessageModal()
        {
            bootbox.confirm({
                title: 'Edit Message',
                message: $("#editMessage").html(),
                size: 'large',
                buttons: {
                    cancel:
                    {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm:
                    {
                        label: '<i class="fa fa-check"></i> Save'
                    }
                },
                callback: function (result)
                {
                    $(".bootbox-body").find("#editMessageForm").on("submit", function (event)
                    {
                        event.preventDefault();
                    });
                    if (result)
                    {
                        let message = $(".bootbox-body").find("#editMessageTextArea").val();
                        $(".bootbox-body").find("#editMessageFormButton").click();
                        if (message)
                        {
                            $.post("{{ route('forum_editMessage') }}", {message: message}).done(function (data)
                            {
                                window.location = data.url + "&addedPost=1"
                            });
                            return true;
                        }
                        return false;
                    }
                }
            });
        }
    </script>
@endsection

