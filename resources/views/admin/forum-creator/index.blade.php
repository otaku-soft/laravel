<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Forum Creator
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Sections</h2>
                    <br/>
                    <ul id="sectionList">
                        @foreach ($sections as $section)
                            <li class="p-4 border">
                                <span data-sectionId="{{ $section->id }}">{{ $section->name }}</span><br/>
                                <x-normal-link href="javascript:editSectionModal({{ $section->id }})">
                                    Edit
                                </x-normal-link>
                                |
                                <x-normal-link href="javascript:deleteSectionModal({{ $section->id }})">
                                    Delete
                                </x-normal-link>
                                |
                                <x-normal-link :href="route('forumCreator_categoryIndex',['section_id' => $section->id])">
                                    Manage Categories
                                </x-normal-link>
                            </li>
                        @endforeach
                    </ul>
                    <br/>
                    <x-secondary-button onclick="saveOrder()">
                        Save Order
                    </x-secondary-button>
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-section')">
                        Add Section
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="edit-section">
        <div class ="p-6" id="edit-section-contents">
        </div>
    </x-modal>
    <x-modal name="delete-section">
        <div class ="p-6" id="delete-section-contents">
        </div>
    </x-modal>
    <x-modal name="add-section">
        <div class ="p-6">
            <form id="addSectionForm">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add Section</h2>
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
                <br/>
                <x-primary-button  x-on:click="addSection()">
                    Add
                </x-primary-button>
            </form>
        </div>
    </x-modal>
    <script>
        $( document ).ready(function() {
            $( "#sectionList" ).sortable();

        });
        $( "#addSectionForm" ).on( "submit", function( event ) {
            event.preventDefault();
            $.post( "{{ route('forumCreator_addSection') }}", $(this).serializeArray())
                .done(function( data ) {
                    window.location = "";
                });
        });
        function saveOrder()
        {
            let sections = $("[data-sectionId]");
            let ids = [];
            for (section of sections)
            {
               ids.push(parseInt(section.getAttribute("data-sectionId")));
            }
            $.post( "{{ route('forumCreator_reorderSections') }}",{ids: ids})
                .done(function( data ) {
                });
        }
        function editSectionModal(id)
        {
            $.post( "{{ route('forumCreator_editModal') }}",{id: id})
                .done(function( data ) {
                    $("#edit-section-contents").html(data);
                    window.dispatchEvent(new CustomEvent('open-modal', {detail: 'edit-section', 'bubbles': true}));
                });
        }
        function deleteSectionModal(id)
        {
            $.post( "{{ route('forumCreator_deleteSectionModal') }}",{id: id})
                .done(function( data ) {
                    $("#delete-section-contents").html(data);
                    window.dispatchEvent(new CustomEvent('open-modal', {detail: 'delete-section', 'bubbles': true}));
                });
        }
    </script>
</x-app-layout>
