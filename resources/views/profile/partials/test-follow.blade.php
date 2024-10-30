<h2>Test de Suivi d'Utilisateur</h2>

<form action="{{ route('follow.store', ['user' => 2]) }}" method="POST">
    @csrf
    <button type="submit">Suivre l'utilisateur avec ID 2</button>
</form>
