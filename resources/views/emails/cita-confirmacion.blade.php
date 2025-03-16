<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .confirmation-card {
            max-width: 650px;
            margin: 40px auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .confirmation-header {
            background-color: #4e73df;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .confirmation-body {
            padding: 30px;
        }
        .confirmation-details {
            background-color: #f1f5ff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .pet-icon {
            font-size: 24px;
            margin-right: 10px;
        }
        .thank-you {
            text-align: center;
            margin-top: 30px;
            color: #4e73df;
        }
        .detail-item {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }
        .detail-item i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
            color: #4e73df;
        }
        .success-badge {
            background-color: #1cc88a;
            color: white;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 20px;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="confirmation-card">
            <div class="confirmation-header">
                <h1><i class="fas fa-calendar-check"></i> Confirmación de Cita</h1>
            </div>
            <div class="confirmation-body">
                <h2>Hola {{ $cita->dueno->nombre }},</h2>
                <div class="success-badge">
                    <i class="fas fa-check-circle"></i> Cita agendada con éxito
                </div>
                
                <div class="confirmation-details">
                    <h4><i class="fas fa-info-circle"></i> Detalles de la Cita:</h4>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <strong>Fecha:</strong><br>
                                    {{ $cita->fecha }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <i class="fas fa-paw"></i>
                                <div>
                                    <strong>Mascota:</strong><br>
                                    {{ $cita->mascota->nombre }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <i class="fas fa-stethoscope"></i>
                                <div>
                                    <strong>Tipo de Cita:</strong><br>
                                    {{ $cita->tipoCita }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <i class="fas fa-user-md"></i>
                                <div>
                                    <strong>Veterinario:</strong><br>
                                    {{ $cita->veterinario->nombre }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-4">
                    <i class="fas fa-info-circle"></i> Por favor, llegue 10 minutos antes de su hora programada.
                </div>
                
                <div class="thank-you">
                    <h3><i class="fas fa-heart"></i> Gracias por confiar en nosotros</h3>
                    <p class="mb-0">¿Preguntas? Contáctenos al teléfono: (123) 456-7890</p>
                </div>
                
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-home"></i> Volver al inicio
                    </a>
                    <a href="#" class="btn btn-outline-secondary">
                        <i class="fas fa-calendar"></i> Ver mis citas
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>