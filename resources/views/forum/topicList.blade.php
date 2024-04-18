@extends('layouts/public')
@section('content')

    <h1>{{ $category->name }}</h1>

            @forelse ($topics as $topic)
                @if ($loop->first)
                    <table class="table table-dark table-bordered">
                        <tr>
                            <th>Subject</th>
                            <th>User</th>
                        </tr>
                @endif
                <tr>
                    <td>
                        <a href = "{{ route('forum_viewTopic',['topic_id' => $topic->id]) }}" class="link-secondary">{{ $topic->subject }}</a>
                    </td>
                    <td>
                        {{ $topic->user->name }}

                    </td>
                </tr>
                @if ($loop->last)
                    </table>
                @endif
            @empty
                <p>No Topics</p>
            @endforelse
            @auth
            <button class="btn btn-primary" onclick = "window.location='{{ route('forum_addTopic',['categoryId' => $category->id]) }}'">
              Add Topic
            </button>
            @else
                You must  <a href = "{{route('login') }}" class="link-secondary">log in</a> to post new topic
            @endauth
    <br/><br/>

    {{ $topics->links() }}


@endsection


