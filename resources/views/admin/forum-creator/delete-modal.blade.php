<span class="text-lg font-medium text-gray-900 dark:text-gray-100">Delete {{ $section->name }} / {{ $section->description }} ?</span>

<br/><br/>
<x-primary-button onclick="deleteSection()">
    Confirm
</x-primary-button>
<script>
function deleteSection()
{
    $.post( "{{ route('forumCreator_deleteSection') }}", {id:  {{$section->id }}})
        .done(function( data ) {
            window.location = "";
        });
}
</script>
