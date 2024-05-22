<div class="text-lg font-medium text-gray-900 dark:text-gray-100">
    <form id="editUserForm">
        <div style="font-size:smaller">
            <input type="hidden" name="id" value="{{ $user->id }}"/>
            Username:
            <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Username"
                    value="{{ $user->name }}"
                    required
            />
            Email:
            <x-text-input
                    id="name"
                    name="email"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Email"
                    value="{{ $user->email }}"
                    required
            />
            Role:
            <select name="role" style="width:100%;color:black">
                <option value=""></option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}"
                            @if ($user->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
            <br/><br/>
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
<script>
    $("#editUserForm").on("submit", function (event)
    {
        event.preventDefault();
        $.post("{{ route('users_edit') }}", $(this).serializeArray()).done(function (data)
        {
        });
    });
</script>
