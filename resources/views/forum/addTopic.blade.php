@extends('layouts/public')
@section('content')
    <h2>Add {{ $category->name }} Topic </h2>

    <form style="width:100%" id="addTopicForm" method="post">
        <label for="subject">Subject</label>
        <input type="text" name="subject" class="form-control" placeholder="Subject" required/>
        <br/>
        <label for="message">Your message</label>
        <textarea name="message" rows="4" class="form-control" placeholder="Write your message here"
                  required></textarea>
        <br/>
        <button class="btn btn-primary" type="submit">
            Add Topic
        </button>
    </form>
    <script>
        $("#addTopicForm").on("submit", function (event)
        {
            event.preventDefault();
            $.post("{{ route('forum_addTopicSaved') }}", $(this).serializeArray()).done(function (data)
            {
                window.location = data.url;
            });
        });
    </script>
@endsection
