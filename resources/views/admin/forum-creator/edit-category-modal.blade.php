<form id="editCategoryForm">
    <x-input-label for="name" value="Name" class="sr-only"/>
    <input type="hidden" name="id" value="{{ $category->id }}"/>
    <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full"
            placeholder="Name"
            value="{{ $category->name }}"
            required
    />
    <x-input-label for="description" value="Description" class="sr-only"/>

    <x-text-input
            id="description"
            name="description"
            type="text"
            class="mt-1 block w-full"
            placeholder="Description"
            value="{{ $category->description }}"
            required
    />
    <br/>
    <x-primary-button>
        Save
    </x-primary-button>
</form>
<script>
    $("#editCategoryForm").on("submit", function (event)
    {
        event.preventDefault();
        $.post("{{ route('forumCreator_editCategory') }}", $(this).serializeArray()).done(function (data)
        {
            window.location = "";
        });
    });
</script>
