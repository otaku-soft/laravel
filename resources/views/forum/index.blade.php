@extends('layouts/public')
@section('content')
    <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">

            @foreach ($sections as $section)
            <h2 class="text-xl font-semibold text-black dark:text-white">{{ $section->name }} </h2>

            <span
                id="docs-card"
                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
            >

                @foreach ($section->categories()->orderBy("order")->get() as $category)
                    <span
                            id="docs-card"
                            class="flex flex-col items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300  focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900  "
                            style = "width:100%;padding-top:4px;padding-bottom:12px;padding-left:15px"
                        >
                            <a href = "" style="color:cornflowerblue"> <b>{{ $category->name }}</b></a>
                            <p class = "mt-4 text-sm/relaxed" style="padding-left:2px">
                            {{ $category->description }}
                            </p>
                    </span>
                @endforeach
            </span>
            @endforeach
    </div>
@endsection
