@extends('layouts.app')

@section('styles')
<style>
    .calendar-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        box-shadow: 0 5px 15px rgba(0,0,0,0.14);
        border-radius: 12px;
        overflow: hidden;
    }
    .month-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #4a6baf 0%, #3f5c9a 100%);
        color: white;
        padding: 18px 24px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .month-navigation h2 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .nav-buttons {
        display: flex;
        gap: 10px;
    }
    .nav-buttons a {
        color: white;
        background-color: rgba(255,255,255,0.2);
        border: none;
        padding: 8px 18px;
        border-radius: 6px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .nav-buttons a:hover {
        background-color: rgba(255,255,255,0.3);
        transform: translateY(-2px);
    }
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        background-color: white;
    }
    .calendar-header {
        padding: 14px 0;
        text-align: center;
        font-weight: 600;
        background-color: #f0f4f9;
        border-bottom: 1px solid #e5e9f2;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }
    .calendar-day {
        min-height: 140px;
        border-right: 1px solid #e5e9f2;
        border-bottom: 1px solid #e5e9f2;
        padding: 8px;
        transition: background-color 0.2s;
        position: relative;
    }
    .calendar-day:nth-child(7n) {
        border-right: none;
    }
    .calendar-day:hover {
        background-color: #f8fafd;
    }
    .day-number {
        display: inline-flex;
        width: 32px;
        height: 32px;
        text-align: center;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        margin-bottom: 8px;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }
    .today .day-number {
        background-color: #4a6baf;
        color: white;
        box-shadow: 0 2px 6px rgba(74, 107, 175, 0.4);
    }
    .other-month {
        background-color: #f9fafb;
    }
    .other-month .day-number {
        color: #c0c7d2;
    }
    .appointments-container {
        max-height: calc(140px - 40px);
        overflow-y: auto;
        scrollbar-width: thin;
        position: relative;
    }
    .appointments-container::-webkit-scrollbar {
        width: 4px;
    }
    .appointments-container::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.2);
        border-radius: 4px;
    }
    .cita {
        display: flex;
        flex-direction: column;
        font-size: 0.78rem;
        margin-bottom: 6px;
        padding: 6px 8px;
        border-radius: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #333;
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
        border-left: 4px solid;
        position: relative;
    }
    .cita:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    .cita-time {
        font-weight: bold;
        font-size: 0.75rem;
        margin-bottom: 2px;
    }
    .cita-pet {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
    }
    .cita-consulta { 
        background-color: #e6f0ff; 
        border-left-color: #4285f4;
    }
    .cita-vacunacion { 
        background-color: #e6f9ed; 
        border-left-color: #34a853;
    }
    .cita-desparasitacion { 
        background-color: #fff8e6; 
        border-left-color: #fbbc04;
    }
    .cita-cirugia { 
        background-color: #fde7ea; 
        border-left-color: #ea4335;
    }
    .cita-control { 
        background-color: #f0f0f2; 
        border-left-color: #5f6368;
    }
    .cita-emergencia { 
        background-color: #ea4335; 
        color: white; 
        border-left-color: #b31412;
    }
    .calendar-actions {
        padding: 18px;
        background-color: #f9fafb;
        border-top: 1px solid #e5e9f2;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .calendar-actions .right-actions {
        display: flex;
        gap: 10px;
    }
    .legend {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        padding: 18px;
        background-color: white;
        border-top: 1px solid #e5e9f2;
    }
    .legend-item {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        padding: 4px 10px;
        border-radius: 20px;
        background-color: #f8f9fa;
        transition: transform 0.2s;
    }
    .legend-item:hover {
        transform: translateY(-2px);
    }
    .legend-color {
        width: 16px;
        height: 16px;
        margin-right: 8px;
        border-radius: 4px;
        border-left: 4px solid;
    }
    .more-indicator {
        font-size: 0.75rem;
        text-align: center;
        background-color: #f2f3f5;
        color: #5f6368;
        margin-top: 5px;
        cursor: pointer;
        padding: 3px;
        border-radius: 12px;
        transition: background-color 0.2s;
    }
    .more-indicator:hover {
        background-color: #e5e7eb;
    }
    .day-label {
        position: absolute;
        top: 8px;
        right: 8px;
        font-size: 0.7rem;
        color: #9aa0a8;
    }
    .btn {
        transition: all 0.2s;
    }
    .btn:hover {
        transform: translateY(-2px);
    }
    .btn-outline-secondary {
        border-color: #d1d5db;
    }
    .btn-primary {
        background: linear-gradient(135deg, #4a6baf 0%, #3f5c9a 100%);
        border: none;
        box-shadow: 0 2px 6px rgba(74, 107, 175, 0.4);
    }
    .today-indicator {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        border: 2px solid #4a6baf;
        pointer-events: none;
        opacity: 0.5;
        border-radius: 4px;
    }
    .weekday-highlight {
        position: absolute;
        top: 0;
        right: 0;
        width: 10px;
        height: 10px;
        border-radius: 0 0 0 10px;
    }
    .weekday-saturday {
        background-color: #fbbc04;
    }
    .weekday-sunday {
        background-color: #ea4335;
    }
    .month-selector {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .month-selector select {
        background-color: rgba(255,255,255,0.2);
        border: none;
        color: white;
        border-radius: 6px;
        padding: 6px 12px;
        appearance: none;
        cursor: pointer;
        outline: none;
    }
    .month-selector select option {
        color: #333;
    }
    @media (max-width: 768px) {
        .calendar-day {
            min-height: 120px;
            padding: 5px;
        }
        .legend {
            gap: 8px;
        }
        .legend-item {
            font-size: 0.75rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="calendar-wrapper">
                <div class="month-navigation">
                    <div class="nav-buttons">
                        <a href="{{ route('citas.calendar', ['month' => $prevMonth, 'year' => $prevYear]) }}">
                            <i class="fas fa-chevron-left"></i> Anterior
                        </a>
                        <a href="{{ route('citas.calendar', ['month' => date('m'), 'year' => date('Y')]) }}">
                            <i class="fas fa-calendar-day"></i> Hoy
                        </a>
                    </div>
                    
                    <h2>{{ $monthName }} {{ $year }}</h2>
                    
                    <div class="nav-buttons">
                        <a href="{{ route('citas.calendar', ['month' => $nextMonth, 'year' => $nextYear]) }}">
                            Siguiente <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="calendar-grid">
                    <div class="calendar-header">Lunes</div>
                    <div class="calendar-header">Martes</div>
                    <div class="calendar-header">Miércoles</div>
                    <div class="calendar-header">Jueves</div>
                    <div class="calendar-header">Viernes</div>
                    <div class="calendar-header">Sábado</div>
                    <div class="calendar-header">Domingo</div>
                    
                    @foreach ($calendarDays as $day)
                        <div class="calendar-day {{ $day['today'] ? 'today' : '' }} {{ $day['currentMonth'] ? '' : 'other-month' }}">
                            @if($day['today'])
                                <div class="today-indicator"></div>
                            @endif
                            
                            @if($day['weekday'] == 6)
                                <div class="weekday-highlight weekday-saturday"></div>
                            @elseif($day['weekday'] == 0)
                                <div class="weekday-highlight weekday-sunday"></div>
                            @endif
                            
                            <div class="day-number">
                                {{ $day['dayNumber'] }}
                            </div>
                            
                            @if ($day['currentMonth'])
                                <div class="appointments-container">
                                    @php $visibleCitas = 3; $count = 0; @endphp
                                    @foreach ($day['citas'] as $cita)
                                        @if ($count < $visibleCitas)
                                            <a href="{{ route('citas.show', $cita->idCita) }}" class="cita cita-{{ strtolower(preg_replace('/\s+/', '-', $cita->tipoCita)) }}">
                                                <span class="cita-time">{{ \Carbon\Carbon::parse($cita->fecha)->format('H:i') }}</span>
                                                <span class="cita-pet">{{ $cita->mascota->nombre }}</span>
                                            </a>
                                            @php $count++; @endphp
                                        @endif
                                    @endforeach
                                    
                                    @if (count($day['citas']) > $visibleCitas)
                                        <div class="more-indicator" onclick="alert('Ver todas las citas del {{ $day}} / {{ $month }}/{{ $year }}')">
                                            +{{ count($day['citas']) - $visibleCitas }} más
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-color cita-consulta" style="background-color: #e6f0ff; border-left-color: #4285f4;"></div>
                        <span>Consulta</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color cita-vacunacion" style="background-color: #e6f9ed; border-left-color: #34a853;"></div>
                        <span>Vacunación</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color cita-desparasitacion" style="background-color: #fff8e6; border-left-color: #fbbc04;"></div>
                        <span>Desparasitación</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color cita-cirugia" style="background-color: #fde7ea; border-left-color: #ea4335;"></div>
                        <span>Cirugía</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color cita-control" style="background-color: #f0f0f2; border-left-color: #5f6368;"></div>
                        <span>Control</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color cita-emergencia" style="background-color: #ea4335; border-left-color: #b31412;"></div>
                        <span>Emergencia</span>
                    </div>
                </div>

                <div class="calendar-actions">
                    <div class="view-options">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary active">Mes</button>
                            <button type="button" class="btn btn-outline-secondary">Semana</button>
                            <button type="button" class="btn btn-outline-secondary">Día</button>
                        </div>
                    </div>
                    <div class="right-actions">
                        <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list"></i> Ver Lista
                        </a>
                        <a href="{{ route('citas.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nueva Cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Agregar tooltips a las citas para mostrar más información al pasar el mouse
    const citas = document.querySelectorAll('.cita');
    citas.forEach(cita => {
        const mascota = cita.querySelector('.cita-pet').textContent;
        const hora = cita.querySelector('.cita-time').textContent;
        const tipo = cita.classList[1].replace('cita-', '').replace(/-/g, ' ');
        
        cita.setAttribute('title', `${hora} - ${mascota} - ${tipo}`);
        
        // Si tienes Bootstrap 5 con tooltips
        // new bootstrap.Tooltip(cita);
    });
    
    // Hacer que los indicadores de "más citas" muestren todas las citas del día
    const moreIndicators = document.querySelectorAll('.more-indicator');
    moreIndicators.forEach(indicator => {
        indicator.addEventListener('click', function() {
            // Aquí podrías implementar un modal para mostrar todas las citas del día
            // Por ahora solo usamos el alert definido en el onclick
        });
    });
    
    // Botones de vista (no funcionan aún, solo para la interfaz)
    const viewButtons = document.querySelectorAll('.view-options .btn');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            // Aquí implementarías el cambio de vista (mes, semana, día)
        });
    });
});
</script>
@endsection