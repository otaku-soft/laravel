<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Users
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="pb-3">User List</h2>


                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td>
                                    Email
                                </td>
                                <td>
                                    Actions
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        <a href="javascript:editUserModal({{ $user->id }})"
                                           class="link-secondary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-modal name="edit-user">
        <div class="p-6" id="edit-user-contents">
        </div>
    </x-modal>
</x-app-layout>
<script>
    function editUserModal(id)
    {
        $.post("{{ route('users_editModal') }}", {id: id}).done(function (data)
        {
            $("#edit-user-contents").html(data);
            window.dispatchEvent(new CustomEvent('open-modal', {detail: 'edit-user', 'bubbles': true}));
        });
    }
</script>
<style>
    td {
        line-height: 2em;
    }
</style>
