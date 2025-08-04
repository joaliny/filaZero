@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Header com gradiente -->
    <header class="bg-gradient-primary py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-white mb-0 fw-bold display-5">
                    <i class="fas fa-hospital me-2"></i>FilaZero
                </h1>
                <a href="{{ route('admin.hospitais.create') }}" class="btn btn-success">Novo Hospital</a>

                <div class="text-white">
                    <span id="current-time" class="me-3"></span>
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-sync-alt me-2"></i>Atualizado em tempo real
                    </span>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="container py-5">
        <!-- Painel de controle -->
        <div class="row mb-5">
            <div class="col-md-8 mx-auto">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-0 fw-semibold text-primary">Painel de Filas Hospitalares</h2>
                            <div class="d-flex">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" id="searchHospital" class="form-control border-start-0" placeholder="Pesquisar hospital...">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-filter me-2"></i>Filtrar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Estatísticas -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                                            <i class="fas fa-check-circle text-success fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-muted">Baixa Ocupação</h6>
                                            <h3 class="mb-0 fw-bold">{{ $hospitais->where('fila.quantidade', '<=', 5)->count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                                            <i class="fas fa-exclamation-triangle text-warning fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-muted">Média Ocupação</h6>
                                            <h3 class="mb-0 fw-bold">{{ $hospitais->where('fila.quantidade', '>', 5)->where('fila.quantidade', '<=', 15)->count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                                            <i class="fas fa-times-circle text-danger fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-muted">Alta Ocupação</h6>
                                            <h3 class="mb-0 fw-bold">{{ $hospitais->where('fila.quantidade', '>', 15)->count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de hospitais -->
        <div class="row g-4" id="hospitalList">
            @foreach($hospitais as $hospital)
            @php
                $quantidade = $hospital->fila->quantidade ?? 0;
                if($quantidade <= 5){
                    $badgeColor = 'bg-success';
                    $statusText = 'Baixa ocupação';
                    $icon = 'fa-check-circle';
                } elseif($quantidade <= 15){
                    $badgeColor = 'bg-warning text-dark';
                    $statusText = 'Média ocupação';
                    $icon = 'fa-exclamation-triangle';
                } else {
                    $badgeColor = 'bg-danger';
                    $statusText = 'Alta ocupação';
                    $icon = 'fa-times-circle';
                }
                
                $tempoEspera = $quantidade * 10; // Exemplo: 10 minutos por pessoa
            @endphp
            <div class="col-xl-3 col-lg-4 col-md-6 hospital-card">
                <div class="card border-0 shadow-sm h-100 hover-scale">
                    <div class="card-header bg-white border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $hospital->nome }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ $hospital->endereco ?? 'Endereço não informado' }}
                                </p>
                            </div>
                            <span class="badge {{ $badgeColor }} px-3 py-2">
                                <i class="fas {{ $icon }} me-1"></i> {{ $statusText }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="mb-0 fw-bold">{{ $quantidade }}</h2>
                                <small class="text-muted">Pacientes aguardando</small>
                            </div>
                            <div class="text-end">
                                <h2 class="mb-0 fw-bold">{{ $tempoEspera }} min</h2>
                                <small class="text-muted">Tempo estimado</small>
                            </div>
                        </div>
                        
                        <!-- Barra de progresso -->
                        <div class="progress mb-3" style="height: 10px;">
                            @php
                                $progress = min(100, ($quantidade / 20) * 100);
                            @endphp
                            <div class="progress-bar {{ str_replace('bg-', 'bg-', $badgeColor) }}" 
                                 role="progressbar" 
                                 style="width: {{ $progress }}%" 
                                 aria-valuenow="{{ $progress }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="far fa-clock me-1"></i>
                                Atualizado: {{ $hospital->fila->atualizado_em ?? 'N/D' }}
                            </small>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-info-circle me-1"></i> Detalhes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>

<!-- Scripts -->
<script>
    // Atualizar hora atual
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = 
            `${now.toLocaleTimeString()} - ${now.toLocaleDateString()}`;
    }
    setInterval(updateTime, 1000);
    updateTime();

    // Filtro de pesquisa
    document.getElementById('searchHospital').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        document.querySelectorAll('.hospital-card').forEach(card => {
            const name = card.querySelector('.card-header h5').textContent.toLowerCase();
            card.style.display = name.includes(filter) ? 'block' : 'none';
        });
    });

    // Efeito hover nos cards
    document.querySelectorAll('.hover-scale').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.transition = 'transform 0.3s ease';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }
    
    .hover-scale {
        transition: all 0.3s ease;
    }
    
    .hover-scale:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .progress {
        border-radius: 10px;
    }
    
    .progress-bar {
        border-radius: 10px;
    }
</style>
@endsection