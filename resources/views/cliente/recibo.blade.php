<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo {{ $numeroPedido }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #222;
            padding: 40px;
        }

        .header {
            display: table;
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 3px solid #1a3aff;
            padding-bottom: 15px;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
        }

        .header-left h1 {
            font-size: 28px;
            color: #1a3aff;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .header-left p {
            font-size: 11px;
            color: #888;
            margin-top: 3px;
        }

        .header-right {
            display: table-cell;
            text-align: right;
            vertical-align: middle;
        }

        .header-right h2 {
            font-size: 18px;
            color: #333;
        }

        .header-right p {
            font-size: 11px;
            color: #888;
            margin-top: 3px;
        }

        .badge {
            display: inline-block;
            background: #1a3aff;
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 25px;
        }

        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .info-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .info-col h4 {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-col p {
            font-size: 13px;
            color: #222;
            margin-bottom: 4px;
        }

        .info-col strong {
            color: #1a3aff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead tr {
            background: #1a3aff;
            color: white;
        }

        th {
            padding: 10px 12px;
            text-align: left;
            font-size: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        tbody tr:nth-child(even) {
            background: #f4f6ff;
        }

        .totales {
            float: right;
            width: 280px;
        }

        .totales table {
            margin-bottom: 0;
        }

        .totales td {
            border: none;
            padding: 6px 12px;
        }

        .totales .fila-total {
            background: #1a3aff;
            color: white;
            font-weight: 700;
            font-size: 15px;
            border-radius: 4px;
        }

        .footer {
            clear: both;
            margin-top: 50px;
            border-top: 1px solid #eee;
            padding-top: 15px;
            text-align: center;
            font-size: 11px;
            color: #aaa;
        }

        .nota {
            background: #f4f6ff;
            border-left: 4px solid #1a3aff;
            padding: 12px 16px;
            margin: 25px 0;
            border-radius: 0 6px 6px 0;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-left">
            <h1>🐻 BEAR FITNESS</h1>
            <p>No Pain, No Gain · Cali, Valle del Cauca</p>
            <p>info@bearfitness.com · +57 300 123 4567</p>
        </div>
        <div class="header-right">
            <h2>RECIBO DE PEDIDO</h2>
            <p><strong>N°:</strong> {{ $numeroPedido }}</p>
            <p><strong>Fecha:</strong> {{ $fecha }}</p>
        </div>
    </div>

    <div class="badge">✅ PEDIDO CONFIRMADO</div>

    <div class="info-grid">
        <div class="info-col">
            <h4>Cliente</h4>
            <p><strong>{{ $cliente }}</strong></p>
            <p>{{ auth()->user()->email }}</p>
        </div>
        <div class="info-col">
            <h4>Detalles del pedido</h4>
            <p>Pedido: <strong>{{ $numeroPedido }}</strong></p>
            <p>Fecha: <strong>{{ $fecha }}</strong></p>
            <p>Estado: <strong style="color:#1a3aff;">Pendiente de entrega</strong></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{ $producto->nombre }}</strong></td>
                <td>{{ ucfirst($producto->categoria) }}</td>
                <td>$ {{ number_format($producto->precio_venta, 2) }}</td>
                <td>{{ $cantidad }}</td>
                <td>$ {{ number_format($subtotal, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="totales">
        <table>
            <tr>
                <td>Subtotal:</td>
                <td style="text-align:right;">$ {{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr>
                <td>IVA (19%):</td>
                <td style="text-align:right;">$ {{ number_format($iva, 2) }}</td>
            </tr>
            <tr class="fila-total">
                <td>TOTAL:</td>
                <td style="text-align:right;">$ {{ number_format($total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="nota">
        <strong>📌 Nota:</strong> Este es un recibo hipotético generado por el sistema Bear Fitness.
        Para coordinar la entrega de tu pedido comunícate al <strong>+57 300 123 4567</strong>
        o escríbenos a <strong>info@bearfitness.com</strong>
    </div>

    <div class="footer">
        Bear Fitness © {{ date('Y') }} · Todos los derechos reservados · Cali, Valle del Cauca, Colombia
    </div>

</body>

</html>