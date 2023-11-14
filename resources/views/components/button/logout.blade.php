<form action="{{ route('logout.account') }}" method="POST">
    @csrf
    <button type="submit">Log out</button>
</form>