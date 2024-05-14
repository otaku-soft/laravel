<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Category Creator
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Categories</h2>
                    <br/>
                    <ul id="categoryList">
                        @foreach ($section->categories()->orderBy("order")->get() as $category)
                            <li class="p-4 border">
                                <span data-categoryId="{{ $category->id }}">{{ $category->name }}</span><br/>
                                <x-normal-link href="javascript:editCategoryModal({{ $category->id }})">
                                    Edit
                                </x-normal-link>
                                |
                                <x-normal-link href="javascript:deleteCategoryModal({{ $category->id }})">
                                    Delete
                                </x-normal-link>
                            </li>
                        @endforeach
                    </ul>
                    <br/>
                    <x-secondary-button onclick="saveOrder()">
                        Save Order
                    </x-secondary-button>
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-category')">
                        Add Category
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="edit-category">
        <div class ="p-6" id="edit-category-contents">
        </div>
    </x-modal>
    <x-modal name="delete-category">
        <div class ="p-6" id="delete-category-contents">
        </div>
    </x-modal>
    <x-modal name="add-category">
        <div class ="p-6">
            <form id="addCategoryForm">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add Category</h2>
                <x-input-label for="name" value="Name" class="sr-only" />

                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Name"
                    required
                />
                <x-input-label for="description" value="Description" class="sr-only" />

                <x-text-input
                    id="description"
                    name="description"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Description"
                    required
                />
                <input type="hidden" name="section_id" value = "{{$section->id }}" />
                <br/>
                <x-primary-button>
                    Add
                </x-primary-button>
            </form>
        </div>
    </x-modal>
</x-app-layout>
<script>
$( document ).ready(function() {
    $( "#categoryList" ).sortable();
});
$( "#addCategoryForm" ).on( "submit", function( event ) {
    event.preventDefault();
    $.post( "{{ route('forumCreator_addCategory') }}", $(this).serializeArray())
        .done(function( data ) {
            window.location = "";
        });
});
function saveOrder()
{
    let sections = $("[data-categoryId]");
    let ids = [];
    for (section of sections)
    {
        ids.push(parseInt(section.getAttribute("data-categoryId")));
    }
    $.post( "{{ route('forumCreator_orderCategories') }}",{ids: ids,section_id:{{ $section->id }}})
        .done(function( data ) {
        });
}
function editCategoryModal(id)
{
    $.post( "{{ route('forumCreator_editCategoryModal') }}",{id: id})
        .done(function( data ) {
            $("#edit-category-contents").html(data);
            window.dispatchEvent(new CustomEvent('open-modal', {detail: 'edit-category', 'bubbles': true}));
        });
}
function deleteCategoryModal(id)
{
    $.post( "{{ route('forumCreator_deleteCategoryModal') }}",{id: id})
        .done(function( data ) {
            $("#delete-category-contents").html(data);
            window.dispatchEvent(new CustomEvent('open-modal', {detail: 'delete-category', 'bubbles': true}));
        });
}
</script>
