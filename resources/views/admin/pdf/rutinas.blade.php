<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Rutinas</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #222; }
        .header { display:table; width:100%; border-bottom: 3px solid #1a3aff; padding-bottom:12px; margin-bottom:20px; }
        .header-left { display:table-cell; vertical-align:middle; }
        .header-left h1 { font-size:20px; color:#1a3aff; }
        .header-left p  { font-size:11px; color:#666; margin-top:4px; }
        .header-right { display:table-cell; text-align:right; vertical-align:middle; }
        .header-right h3 { font-size:14px; color:#FFD700; background:#0a0a0a; padding:6px 12px; border-radius:4px; display:inline-block; }
        table { width:100%; border-collapse:collapse; margin-top:10px; }
        thead tr { background-color:#1a3aff; color:white; }
        th, td { border:1px solid #ddd; padding:8px 10px; text-align:left; }
        tbody tr:nth-child(even) { background:#f4f6ff; }
        .footer { margin-top:25px; border-top:1px solid #ccc; padding-top:8px; font-size:10px; color:#888; text-align:right; }
        .resumen { margin-top:15px; font-size:11px; color:#444; }
        .resumen span { font-weight:bold; color:#1a3aff; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <h1>Reporte de Rutinas Semanales</h1>
            <p>Bear Fitness — Plan de entrenamiento</p>
        </div>
        <div class="header-right">
            <h3>🐻 BEAR FITNESS</h3>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Día</th>
                <th>Nivel</th>
                <th>Duración</th>
                <th>Grupo Muscular</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rutinas as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->nombre }}</td>
                <td>{{ ucfirst($r->dia) }}</td>
                <td>{{ ucfirst($r->nivel) }}</td>
                <td>{{ $r->duracion_minutos }} min</td>
                <td>{{ $r->grupo_muscular ?? '—' }}</td>
                <td>{{ $r->activo ? 'Activo' : 'Inactivo' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;">Sin rutinas.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="resumen">
        Total rutinas: <span>{{ $rutinas->count() }}</span>
    </div>

    <div class="footer">
        Generado el {{ date('d/m/Y H:i') }} — Bear Fitness
    </div>
</body>
</html>
