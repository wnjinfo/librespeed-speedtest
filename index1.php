<?php
// Obter o endereço IP do servidor
$server_ip = $_SERVER['SERVER_ADDR'];
$real_server_ip = $_SERVER['SERVER_ADDR'] ?? $_SERVER['LOCAL_ADDR'] ?? gethostbyname(gethostname());
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speedtest Terra Fibra</title>
    <link rel="shortcut icon" href="favicon.ico">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script type="text/javascript" src="speedtest.js"></script>
    
    <style>
        :root {
            --primary-color: #8f16fa;
            --secondary-color: #6a11cb;
            --success-color: #00c5fc;
            --danger-color: #ffc107;
            --warning-color: #ff0786;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
            --text-color: #495057;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--text-color);
            min-height: 100vh;
            padding-bottom: 2rem;
        }
        
        .logo {
            max-width: 180px;
            height: auto;
            margin: 2rem 0;
            transition: var(--transition);
        }
        
        .logo:hover {
            transform: scale(1.03);
        }
        
        .page-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }
        
        .test-btn {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            font-weight: 100;
            font-size: 1.2rem;
            box-shadow: var(--box-shadow);
            cursor: pointer;
            overflow: hidden;
            transition: var(--transition);
            margin: 2rem auto;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }
        
        .test-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            opacity: 0;
            z-index: -1;
            transition: var(--transition);
        }
        
        .test-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        
        .test-btn:hover:before {
            opacity: 1;
        }
        
        .test-btn.running {
            background: linear-gradient(135deg, var(--danger-color), #c82333);
        }
        
        .test-btn.running:before {
            background: linear-gradient(135deg, #c82333, var(--danger-color));
        }
        
        .test-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .test-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            border-left: 4px solid var(--primary-color);
            height: 100%;
        }
        
        .test-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .test-card.upload {
            border-left-color: var(--success-color);
        }
        
        .test-card.ping {
            border-left-color: var(--warning-color);
        }
        
        .test-card.jitter {
            border-left-color: var(--danger-color);
        }
        
        .test-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
            display: center;
            align-items: center;
        }
        
        .test-title i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .test-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }
        
        #dlText {
            color: var(--primary-color);
        }
        
        #ulText {
            color: var(--success-color);
        }
        
        #pingText {
            color: var(--warning-color);
        }
        
        #jitText {
            color: var(--danger-color);
        }
        
        .test-unit {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .server-info {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            margin-top: 2rem;
        }
        
        .server-info h5 {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 0.5rem;
        }
        
        .server-info p {
            margin-bottom: 0.5rem;
        }
        
        .server-info strong {
            color: var(--primary-color);
        }
        
        footer {
            margin-top: 3rem;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .test-btn {
                width: 120px;
                height: 120px;
                font-size: 1rem;
            }
            
            .test-value {
                font-size: 2rem;
            }
        }
        /* Adicione isso ao seu estilo */
@media (max-width: 768px) {
    .test-card {
        margin-bottom: 1.5rem !important;
    }
    
    .col-sm-6 {
        padding-left: 8px;
        padding-right: 8px;
    }
    
    .row {
        margin-left: -8px;
        margin-right: -8px;
    }
}

/* Aumente o espaçamento entre as colunas */
.row {
    row-gap: 1.5rem;
}
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="text-center">
            <img src="logo.svg" alt="Terra Fibra" class="logo">
            <br>
            <h2 class="page-title"></h2>
            
            <button id="startStopBtn" class="test-btn" onclick="startStop()">
                <span id="btnText">Iniciar Teste</span>
            </button>
            
            <div class="test-container">
                <div class="row">
                    <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="test-card">
                            <div class="test-title">
                                <i class="fas fa-cloud-download-alt fa-bounce"></i> Download
                            </div>
                            <div id="dlText" class="test-value">-</div>
                            <div class="test-unit">Mbit/s</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="test-card upload">
                            <div class="test-title">
                                <i class="fas fa-cloud-upload-alt fa-bounce"></i> Upload
                            </div>
                            <div id="ulText" class="test-value">-</div>
                            <div class="test-unit">Mbit/s</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="test-card ping">
                            <div class="test-title">
                                <i class="fas fa-exchange-alt fa-beat"></i> Ping
                            </div>
                            <div id="pingText" class="test-value">-</div>
                            <div class="test-unit">ms</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="test-card jitter">
                            <div class="test-title">
                                <i class="fas fa-random fa-spin"></i> Jitter
                            </div>
                            <div id="jitText" class="test-value">-</div>
                            <div class="test-unit">ms</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="server-info" data-aos="fade-up">
                <h5>Informações do Servidor</h5>
                <p>Servidor: <strong><a href="https://speedtest.tvfinternet.com.br" class="text-decoration-none">TERRA FIBRA LTDA - GO, Brazil</a></strong></p>
                <p>Seu IP (cliente): <strong><span id="ip">-</span></strong></p>
            </div>
        </div>
        
        <footer class="mt-5">
            <p>© 2019 - <?php echo date('Y'); ?> Terra Fibra GO - Todos os direitos reservados.                
            </p>
            <p>
                <font size='-15'>Serviço de teste de velocidade baseado no projeto <a href="https://github.com/librespeed/speedtest">librespeed ©</a> | Desenvolvido por Wanderlei Neves Junior</a></font>
            </p>
        </footer>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script type="text/javascript">
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // INITIALIZE SPEEDTEST
        var s = new Speedtest();
        s.setParameter("telemetry_level", "basic");
        
        s.onupdate = function(data) {
            I("ip").textContent = data.clientIp;
            I("dlText").textContent = (data.testState == 1 && data.dlStatus == 0) ? "..." : data.dlStatus;
            I("ulText").textContent = (data.testState == 3 && data.ulStatus == 0) ? "..." : data.ulStatus;
            I("pingText").textContent = data.pingStatus;
            I("jitText").textContent = data.jitterStatus;
        };
        
        s.onend = function(aborted) {
            I("startStopBtn").classList.remove("running");
            I("btnText").textContent = "Iniciar Teste";
            
            if(aborted) {
                initUI();
            } else {
                var dlSpeed = parseFloat(I("dlText").textContent);
                // You can add custom logic here based on speed results
            }
        };
        
        function startStop() {
            if(s.getState() == 3) {
                s.abort();
            } else {
                s.start();
                I("startStopBtn").classList.add("running");
                I("btnText").textContent = "Parar Teste";
            }
        }
        
        function initUI() {
            I("dlText").textContent = "-";
            I("ulText").textContent = "-";
            I("pingText").textContent = "-";
            I("jitText").textContent = "-";
            I("ip").textContent = "-";
        }
        
        function I(id) {
            return document.getElementById(id);
        }
        
        // Automatically start the test when the page loads
        window.onload = function() {
            startStop();
        };
    </script>
</body>
</html>
