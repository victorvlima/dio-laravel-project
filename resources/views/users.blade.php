<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-users"></i> Sistema de Usuários
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Lista de Usuários</h4>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Novo Usuário
                        </a>
                    </div>

                    <div class="card-body">
                        {{-- Mensagens de Sucesso/Erro --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Tabela de Usuários --}}
                        @if(!empty($users) && $users->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Data de Criação</th>
                                            <th scope="col" class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        {{-- Botão Visualizar --}}
                                                        <a href="{{ route('users.show', $user->id) }}" 
                                                           class="btn btn-sm btn-outline-info" 
                                                           title="Visualizar">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        
                                                        {{-- Botão Editar --}}
                                                        <a href="{{ route('users.edit', $user->id) }}" 
                                                           class="btn btn-sm btn-outline-warning" 
                                                           title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        {{-- Botão Deletar com Modal --}}
                                                        <button type="button" 
                                                                class="btn btn-sm btn-outline-danger" 
                                                                title="Deletar"
                                                                onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Paginação (se estiver usando) --}}
                            @if(method_exists($users, 'links'))
                                <div class="d-flex justify-content-center">
                                    {{ $users->links() }}
                                </div>
                            @endif

                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Nenhum usuário encontrado</h5>
                                <p class="text-muted">Comece criando o primeiro usuário!</p>
                                <a href="{{ route('users.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Criar Primeiro Usuário
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-user-times fa-3x text-danger mb-3"></i>
                        <h5>Tem certeza que deseja deletar este usuário?</h5>
                        <p class="text-muted">
                            <strong id="deleteUserName"></strong><br>
                            <span id="deleteUserEmail"></span>
                        </p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Atenção:</strong> Esta ação não pode ser desfeita!
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Sim, Deletar
                        </button>
                    </form>
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
    <script>
        function confirmDelete(userId, userName, userEmail) {
            // Preencher dados no modal
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteUserEmail').textContent = userEmail;
            
            // Configurar o formulário
            const form = document.getElementById('deleteForm');
            form.action = `/users/${userId}`;
            
            // Mostrar o modal
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        // Confirmação simples (alternativa ao modal)
        function simpleConfirmDelete(userId, userName) {
            if (confirm(`Tem certeza que deseja deletar o usuário "${userName}"?\n\nEsta ação não pode ser desfeita!`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/users/${userId}`;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>