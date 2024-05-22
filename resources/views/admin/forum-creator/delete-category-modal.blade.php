<span class="text-lg font-medium text-gray-900 dark:text-gray-100">Delete {{ $category->name }} / {{ $category->description }} ?</span>

<br/><br/>
<x-primary-button onclick="deleteCategory()">
    Confirm
</x-primary-button>
<script>
    function deleteCategory()
    {
        $.post("{{ route('forumCreator_deleteCategory') }}", {id: {{$category->id }}}).done(function (data)
        {
            window.location = "";
        });
    }
</script>
