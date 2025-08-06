<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    
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
                            <i class="fas fa-user-edit"></i> Editar Usuário
                        </h4>
                        <div>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info me-2">
                                <i class="fas fa-eye"></i> Visualizar
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Mensagens de Sucesso --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Mensagens de Erro --}}
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Erros de Validação --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <h6><i class="fas fa-exclamation-triangle"></i> Corrija os seguintes erros:</h6>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Informações Atuais --}}
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Editando usuário:</h6>
                            <strong>{{ $user->name }}</strong> ({{ $user->email }})
                            <br><small>Criado em: {{ $user->created_at->format('d/m/Y H:i') }}</small>
                        </div>

                        {{-- Formulário --}}
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i> Nome Completo
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       placeholder="Digite o nome completo"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       placeholder="Digite o email"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Nova Senha
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Digite a nova senha (deixe em branco para manter a atual)">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i> Deixe em branco para manter a senha atual. Mínimo 8 caracteres se alterar.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock"></i> Confirmar Nova Senha
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Confirme a nova senha">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                        <i class="fas fa-eye" id="eyeIconConfirm"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Atualizar Usuário
                                </button>
                            </div>
                        </form>
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
                if (!alert.classList.contains('alert-info')) { // Não esconder o alert de informações
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }
            });
        }, 5000);

        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Toggle password confirmation visibility
        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const passwordConfirm = document.getElementById('password_confirmation');
            const eyeIconConfirm = document.getElementById('eyeIconConfirm');
            
            if (passwordConfirm.type === 'password') {
                passwordConfirm.type = 'text';
                eyeIconConfirm.classList.remove('fa-eye');
                eyeIconConfirm.classList.add('fa-eye-slash');
            } else {
                passwordConfirm.type = 'password';
                eyeIconConfirm.classList.remove('fa-eye-slash');
                eyeIconConfirm.classList.add('fa-eye');
            }
        });

        // Real-time password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const passwordConfirm = this.value;
            
            if (passwordConfirm && password && password !== passwordConfirm) {
                this.classList.add('is-invalid');
                if (!document.getElementById('password-match-error')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.id = 'password-match-error';
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> As senhas não coincidem';
                    this.parentNode.appendChild(errorDiv);
                }
            } else {
                this.classList.remove('is-invalid');
                const errorDiv = document.getElementById('password-match-error');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
        });
    </script>
</body>
</html>