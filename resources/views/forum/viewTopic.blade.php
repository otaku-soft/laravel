@extends('layouts/public')
@section('content')
    <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">

        <h2 class="text-xl font-semibold text-black dark:text-white">{{ $topic->subject }}</h2>
            @foreach ($posts as $post)
                <span
                    id="docs-card"
                    class="flex flex-col items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300  focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900  "
                    style = "width:100%;padding-top:20px;padding-bottom:20px;padding-left:15px"
                >
                {{ $post->user->name }} <br/>  {{ $post->message }}
            </span>
            @endforeach
        @auth

        <span
            id="docs-card"
            class="flex flex-col items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300  focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900  "
            style = "width:100%;padding-top:20px;padding-bottom:20px;padding-left:15px"
        >
            <form style = "width:100%" id="addPostForm" method="post">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                <textarea name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                <br/>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type ="submit">
                  Add Reply
                </button>
            </form>
        </span>
        @endauth
        {{ $posts->links() }}

    </div>
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

