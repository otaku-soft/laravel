<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Roles
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="pb-3">Role List</h2>
                    <ul id="sectionList" class="pb-3">
                        @foreach ($roles as $role)
                            <li class="p-4 border">
                                {{ $role->name }}
                                <x-primary-button style="float:right;" onclick="setForumPermissionsModal({{ $role->id }})">
                                    Set Forum Permissions
                                </x-primary-button>
                                @if ($role->name !== "admin")
                                <x-primary-button style="float:right;margin-right:5px" onclick="editRoleModal({{ $role->id }})">
                                    Edit
                                </x-primary-button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <x-primary-button x-data=""  x-on:click.prevent="$dispatch('open-modal', 'add-role')">
                        Add Role
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="add-role">
        <div class ="p-6">
            <form id="addRoleForm">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add Role</h2>
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Name"
                    required
                />
                <br/>
                <x-primary-button>
                    Add
                </x-primary-button>
            </form>
        </div>
    </x-modal>
    <x-modal name="edit-role">
        <div class ="p-6" id="edit-role-contents">
        </div>
    </x-modal>
    <x-modal name="set-forum-permissions">
        <div class ="p-6" id="set-forum-permissions-contents">
        </div>
    </x-modal>
</x-app-layout>

<script>
    $( "#addRoleForm" ).on( "submit", function( event ) {
        event.preventDefault();
        $.post( "{{ route('roles_addRole') }}", $(this).serializeArray())
            .done(function( data ) {
                window.location = "";
            });
    });
    function editRoleModal(id)
    {
        $.post( "{{ route('roles_editRoleModal') }}",{id: id})
            .done(function( data ) {
                $("#edit-role-contents").html(data);
                window.dispatchEvent(new CustomEvent('open-modal', {detail: 'edit-role', 'bubbles': true}));
            });
    }
    function setForumPermissionsModal(id)
    {
        $.post( "{{ route('roles_setForumPermissions') }}",{id: id})
            .done(function( data ) {
                $("#set-forum-permissions-contents").html(data);
                window.dispatchEvent(new CustomEvent('open-modal', {detail: 'set-forum-permissions', 'bubbles': true}));
            });
    }
</script>
