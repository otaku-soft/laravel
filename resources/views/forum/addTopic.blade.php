@extends('layouts/public')
@section('content')
<div class="grid gap-6 lg:grid-cols-1 lg:gap-8">
    <h2 class="text-xl font-semibold text-black dark:text-white">Add {{ $category->name }} Topic </h2>
    <span
        id="docs-card"
        class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
    >
        <form style = "width:100%" id="addTopicForm" method="post">
            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
            <input type="text" name="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Subject" required />
            <br/>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
            <textarea name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
            <br/>
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type ="submit">
              Add Topic
            </button>
        </form>
    </span>
</div>
<script>
$( "#addTopicForm" ).on( "submit", function( event ) {
    event.preventDefault();
    $.post( "{{ route('forum_addTopicSaved') }}", $(this).serializeArray())
        .done(function( data ) {
            window.location = "{{ route('forum_topicList',['category_id' => $category->id]) }}";
        });
});
</script>
@endsection
