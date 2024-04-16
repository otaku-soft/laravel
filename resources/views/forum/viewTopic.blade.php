@extends('layouts/public')
@section('content')

        <h2>{{ $topic->subject }}</h2>
            <table class="table table-dark table-bordered">
                <tr>
                    <th>User</th>
                    <th>Message</th>
                </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->message }}</td>
                </tr>
            @endforeach
            </table>
        @auth

            <form style = "width:100%" id="addPostForm" method="post">
                <label for="message">Your message</label>
                <textarea name="message" rows="4" class="form-control" placeholder="Write your thoughts here..." required></textarea>
                <br/>
                <button class="btn btn-primary" type ="submit">
                  Add Reply
                </button>
            </form>
        @endauth
        {{ $posts->links() }}
    <script>
        $( "#addPostForm" ).on( "submit", function( event ) {
            event.preventDefault();
            $.post( "{{ route('forum_addPost') }}", $(this).serializeArray())
                .done(function( data ) {
                    window.location = data.url;
                });
        });
    </script>
@endsection

