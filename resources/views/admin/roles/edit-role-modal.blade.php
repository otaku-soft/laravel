<form id="editRoleForm">
    <x-input-label for="name" value="Name" class="sr-only" />
    <input type="hidden" name="id" value="{{ $role->id }}" />
    <x-text-input
        id="name"
        name="name"
        type="text"
        class="mt-1 block w-full"
        placeholder="Name"
        value="{{ $role->name }}"
        required
    />
    <br/>
    <x-primary-button>
        Save
    </x-primary-button>
</form>
<script>
    $( "#editRoleForm" ).on( "submit", function( event ) {
        event.preventDefault();
        $.post( "{{ route('roles_editRole') }}", $(this).serializeArray())
            .done(function( data ) {
                window.location = "";
            });
    });
</script>
