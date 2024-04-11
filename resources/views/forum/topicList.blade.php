@extends('layouts/public')
@section('content')
    <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">

        <h2 class="text-xl font-semibold text-black dark:text-white">{{ $category->name }} </h2>
        <span
            id="docs-card"
            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <h2 class="text-xl font-semibold text-black dark:text-white">Topics </h2>
            @forelse ($topics as $topic)
                <span
                    id="docs-card"
                    class="flex flex-col items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300  focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900  "
                    style = "width:100%;padding-top:20px;padding-bottom:20px;padding-left:15px"
                >
                <a href = "#" style="color:cornflowerblue">{{ $topic->subject }}</a> {{ $topic->user->name }}
                </span>
            @empty
                <p>No Topics</p>
            @endforelse
            @auth
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
              <a href = "{{ route('forum_addTopic',['categoryId' => $category->id]) }}">Add Topic</a>
            </button>
            @endauth
        </span>
        {{ $topics->links() }}
    </div>


@endsection


