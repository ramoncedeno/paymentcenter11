<!-- Incluye el archivo CSS de Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Livewire Component -->
<div class="container mt-5">
    <!-- Tabla con clases mejoradas de Bootstrap -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">List of users</h4>
        </div>
        <div class="table-responsive">

            <table class="table table-striped table-hover">

                <thead class="table-primary">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">created_at</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at}} </td>

                        </tr>
                    @endforeach
                </tbody>


            </table>

        </div>

        <!-- Paginación -->
        <div class="card-footer d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}

        </div>

        <a href="{{ route('export.user') }}" class="btn btn-primary">Download </a>
    </div>
</div>
