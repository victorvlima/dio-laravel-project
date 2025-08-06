<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Usuário</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('users.index') }}">
                <i class="fas fa-users"></i> Sistema de Usuários
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-list"></i> Listar Usuários
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user"></i> Detalhes do Usuário
                        </h4>
                        <div>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning me-2">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Mensagens --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Informações do Usuário --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <strong><i class="fas fa-id-badge text-primary"></i> ID:</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                <span class="badge bg-primary">{{ $user->id }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <strong><i class="fas fa-user text-info"></i> Nome:</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $user->name }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <strong><i class="fas fa-envelope text-warning"></i> Email:</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                                    {{ $user->email }}
                                                </a>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <strong><i class="fas fa-calendar-plus text-success"></i> Criado em:</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $user->created_at->format('d/m/Y H:i:s') }}
                                                <small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <strong><i class="fas fa-calendar-edit text-secondary"></i> Atualizado em:</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $user->updated_at->format('d/m/Y H:i:s') }}
                                                <small class="text-muted">({{ $user->updated_at->diffForHumans() }})</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Ações --}}
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning me-md-2">
                                        <i class="fas fa-edit"></i> Editar Usuário
                                    </a>
                                    
                                    <form action="{{ route('users.destroy', $user->id) }}" 
                                          method="POST" 
                                          style="display: inline-block;"
                                          onsubmit="return confirm('Tem certeza que deseja deletar este usuário?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Deletar Usuário
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
</body>
</html>