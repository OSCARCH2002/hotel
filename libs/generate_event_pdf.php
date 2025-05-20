<?php
require('../libs/fpdf.php');

// Obtener el ID del evento
$eventoId = isset($_GET['eventoId']) ? intval($_GET['eventoId']) : 0;

if($eventoId > 0) {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "567890";
    $dbname = "propuesta";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Obtener datos del evento y cliente
        $stmt = $conn->prepare("
            SELECT e.*, c.nombre, c.apellidos, c.telefono 
            FROM evento e 
            JOIN cliente c ON e.id_cliente = c.id 
            WHERE e.id = :id
        ");
        $stmt->execute(['id' => $eventoId]);
        $evento = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($evento) {
            // Crear PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            
            // Logo (ajusta la ruta según tu estructura)
            $pdf->Image('../../assets/images/logo.png',10,10,30);
            $pdf->Ln(20);
            
            // Título
            $pdf->Cell(0,10,'Comprobante de Reserva de Evento',0,1,'C');
            $pdf->Ln(10);
            
            // Datos del cliente
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,10,'Datos del Cliente:',0,1);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(0,10,'Nombre: '.$evento['nombre'].' '.$evento['apellidos'],0,1);
            $pdf->Cell(0,10,'Telefono: '.$evento['telefono'],0,1);
            $pdf->Ln(10);
            
            // Datos del evento
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,10,'Detalles del Evento:',0,1);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(0,10,'ID del Evento: '.$evento['id'],0,1);
            $pdf->Cell(0,10,'Fecha del Evento: '.$evento['fecha_evento'],0,1);
            $pdf->Cell(0,10,'Numero de Personas: '.$evento['num_personas'],0,1);
            $pdf->Ln(15);
            
            // Mensaje final
            $pdf->SetFont('Arial','I',10);
            $pdf->Cell(0,10,'Gracias por elegir Hotel Quinta Micaela para su evento especial.',0,1,'C');
            
            // Salida del PDF
            $pdf->Output('I', 'Comprobante_Evento_'.$eventoId.'.pdf');
            exit;
        } else {
            die("Evento no encontrado");
        }
    } catch(PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
} else {
    die("ID de evento no válido");
}