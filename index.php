<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Teste de velocidade Terra Fibra Goiás">
    <link rel="shortcut icon" href="favicon.ico">
    <title>Speedtest Terra Fibra - GO</title>
    
    <!-- IMPEDE CACHE NA PAGINA -->
    <?php
    // Impede caching na página atual
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    
    // Função para adicionar timestamp a arquivos estáticos
    function asset($file) {
        $path = "assets/{$file}";
        if (file_exists($path)) {
            return $path . '?v=' . filemtime($path);
        }
        return $path;
    }
    ?>
    
    <!-- Uso na página --
    <link rel="stylesheet" href="<?php echo asset('style.css'); ?>">
    <script src="<?php echo asset('script.js'); ?>"></script>
    <!-- IMPEDE CACHE NA PAGINA -->
    
    
    
    
        
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Script do Speedtest -->
    <script type="text/javascript" src="speedtest.js"></script>
    
    <!-- Script do Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
<style>
    :root {
        /* Cores base */
        --primary-color: #4a6bff;
        --secondary-color: #6060AA;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
        --info-color: #17a2b8;
        --ping-color: #6a5acd;
        --jitter-color: #20b2aa;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
        
        /* Cores do tema light */
        --body-bg: #f5f7ff;
        --text-color: #212529;
        --card-bg: rgba(255, 255, 255, 0.85);
        --meter-bg: #80808040;
        --dl-color: #8f16fa;
        --ul-color: #00c5ff;
        
        /* Fundos e overlays */
        --bg-image: url('fundo2.gif');
        --bg-overlay: rgba(255, 255, 255, 0.6);
        --bg-blur: blur(1px);
    }
    
    [data-bs-theme="dark"] {
        /* Cores do tema dark */
        --body-bg: #121225;
        --text-color: #f8f9fa;
        --card-bg: rgba(30, 30, 46, 0.50);
        --meter-bg: #fff;
        --primary-color: #5c7cff;
        --secondary-color: #7070bb;
        --ping-color: #b56aff;
        --jitter-color: #00c5ff;
        --dl-color: #b56aff;
        --ul-color: #00c5ff;
        
        /* Fundos e overlays */
        --bg-image: url('fundo2.gif');
        --bg-overlay: rgba(255, 255, 255, 0.3);
        --bg-blur: blur(3px);
    }
    
    /* Estilos base */
    body {
        background-color: var(--body-bg);
        color: var(--text-color);
        background-image: var(--bg-image);
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        position: relative;
        min-height: 100vh;
        transition: background-color 0.5s ease, color 0.5s ease;
        margin: 0;
        padding: 0;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* Camada de overlay com blur */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--bg-overlay);
        backdrop-filter: var(--bg-blur);
        z-index: -1;
        pointer-events: none;
        transition: all 0.5s ease;
    }

    /* Barra superior */
    .top-bar {
        background: linear-gradient(90deg, var(--body-bg) 0%, var(--body-bg) 20%, var(--primary-color) 100%);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        padding: 0.5rem 1rem;
    }

    .navbar {
        padding: 0;
    }

    /* Logo */
    .logo {
        height: 40px;
        transition: all 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    /* Botão de tema */
    .theme-toggle {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: var(--text-color);
        cursor: pointer;
        transition: transform 0.3s ease;
        padding: 0.5rem;
    }

    .theme-toggle:hover {
        transform: scale(1.1);
    }

    /* Botão principal */
    #startStopBtn {
        background-color: var(--primary-color);
        color: white;
        border: 1px solid var(--card-bg) !important;
        transition: all 0.3s;
        font-weight: 600;
        padding: 0.5rem 1.5rem;
    }

    #startStopBtn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        border: 1px solid var(--card-bg) !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    #startStopBtn.running {
        background-color: var(--danger-color);
    b   order: 1px solid var(--card-bg) !important;
    }

    /* Cards de teste */
    .test-card {
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        backdrop-filter: blur(4px);
        border: 1px solid var(--card-bg) !important;
    }

    .test-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    /* Medidores */
    .meter-container {
        position: relative;
        height: 150px;
        margin-bottom: 10px;
    }

    .meter-value {
        font-size: 1.8rem;
        font-weight: bold;
        margin-top: 5px;
    }

    .small-meter-value {
        font-size: 1.5rem;
        font-weight: bold;
        margin-top: 5px;
    }

    .test-name {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--primary-color);
    }

    .unit {
        font-size: 0.8rem;
        color: var(--text-color);
        opacity: 0.7;
    }

    /* Layout */
    .container {
        padding-top: 5rem;
        padding-bottom: 2rem;
    }

    #ipArea {
        margin-top: 20px;
        font-size: 0.9rem;
        color: var(--text-color);
        opacity: 0.8;
    }

    .ping-jitter-row {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
    }

    .ping-jitter-card {
        flex: 1;
        min-width: 120px;
        max-width: 160px;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .top-bar {
            background: linear-gradient(90deg, var(--body-bg) 0%, var(--body-bg) 30%, var(--primary-color) 100%);
        }
        
        .meter-value {
            font-size: 1.5rem;
        }
        
        .small-meter-value {
            font-size: 1.3rem;
        }
        
        .test-name {
            font-size: 0.9rem;
        }
        
        .ping-jitter-card {
            min-width: 100px;
        }
        
        body::before {
            backdrop-filter: blur(5px);
        }
        
        [data-bs-theme="dark"] body::before {
            backdrop-filter: blur(3px);
        }
        
        .test-card {
            backdrop-filter: blur(2px);
        }
    }

    @media (max-width: 576px) {
        .container {
            padding-top: 6rem;
        }
        
        #startStopBtn {
            width: 100%;
        }
    }
/* Logo - Adicione isso ao seu CSS existente */
.logo {
    height: 40px;
    transition: all 0.3s ease;
    filter: brightness(1); /* Valor padrão para o tema light */
}

[data-bs-theme="dark"] .logo {
    filter: brightness(0) invert(1) drop-shadow(0 0 32px rgba(255, 255, 255, 0.7));
}

.logo:hover {
    transform: scale(1.05);
    filter: brightness(1.1) drop-shadow(0 0 4px rgba(255, 255, 255, 0.9));
}

[data-bs-theme="dark"] .logo:hover {
    filter: brightness(0) invert(1) drop-shadow(0 0 6px rgba(255, 255, 255, 1));
}

/* TEMA PARA O SWEET ALERT DARK MODE */
.swal2-popup {
    border: 1px solid var(--card-bg) !important;
}
</style>
</head>
<body>
    
    


    <!-- Barra Superior -->
    <nav class="navbar top-bar fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.svg" alt="Terra Fibra Goiás" class="logo" id="logoImage">
            </a>
            <div class="d-flex align-items-center">
                <button class="theme-toggle me-3" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>
                <button class="btn btn-light reload-btn" onclick="window.location.reload()">
                    <i class="fas fa-sync-alt me-2"></i>Recarregar
                </button>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-4">
        <h1 class="text-center mb-4">Speedtest Terra Fibra - GO</h1>
        
        <div class="d-flex justify-content-center mb-4">
            <button id="startStopBtn" class="btn btn-lg px-4 py-2" onclick="startStop()">
                <i class="fas fa-play me-2"></i>Testar
            </button>
        </div>
        
        <div class="ping-jitter-row">
            <!-- Ping -->
            <div class="test-card text-center ping-jitter-card" title='O ping (ou latência) mede o tempo que um pacote de dados leva para ir do seu dispositivo até um servidor e voltar. É medido em milissegundos (ms).' style="cursor: help;"     onclick="showTitleAlert(this)">
                <div class="test-name">Ping</div>
                <div id="pingText" class="small-meter-value" style="color: var(--ping-color)">-</div>
                <div class="unit">ms</div>
            </div>
            
            <!-- Jitter -->
            <div class="test-card text-center ping-jitter-card" title='O jitter é a variação no tempo do ping (instabilidade na latência). Se o ping oscila muito, o jitter é alto.' style="cursor: help;"     onclick="showTitleAlert(this)">
                <div class="test-name">Jitter</div>
                <div id="jitText" class="small-meter-value" style="color: var(--jitter-color)">-</div>
                <div class="unit">ms</div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <!-- Download -->
            <div class="col-md-5 col-sm-6 mb-3" title='Download (ou "baixar", em português) é o processo de transferir dados de um servidor ou outra fonte para o seu dispositivo (computador, celular, tablet, etc.).
            
Exemplo: Assistir um vídeo no YouTube' style="cursor: help;"     onclick="showTitleAlert(this)">
                <div class="test-card">
                    <div class="test-name text-center">Download</div>
                    <div class="meter-container">
                        <canvas id="dlMeter" class="w-100 h-100"></canvas>
                    </div>
                    <div class="text-center">
                        <div id="dlText" class="meter-value">-</div>
                        <div class="unit">Mbit/s</div>
                    </div>
                </div>
            </div>
            
            <!-- Upload -->
            <div class="col-md-5 col-sm-6 mb-3" title='Upload (ou "envio", em português) é o processo de transferir dados do seu dispositivo para um servidor ou outro destino na internet. Enquanto o download traz arquivos para o seu aparelho, o upload faz o inverso: envia fotos, vídeos, documentos ou qualquer arquivo para a nuvem, redes sociais, e-mails, etc.
            
Exemplo: Enviar um arquivo por WhatsApp' style="cursor: help;"     onclick="showTitleAlert(this)">
                <div class="test-card">
                    <div class="test-name text-center">Upload</div>
                    <div class="meter-container">
                        <canvas id="ulMeter" class="w-100 h-100"></canvas>
                    </div>
                    <div class="text-center">
                        <div id="ulText" class="meter-value">-</div>
                        <div class="unit">Mbit/s</div>
                    </div>
                </div>
            </div>
        </div>
        <center>
            <span id="ip" class="col-md-5 col-sm-6 mb-3 text-center mt-3"></span>
        </center>
    </div>

<script>
function showTitleAlert(element) {
    const title = element.getAttribute('title');
    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';

    Swal.fire({
        title: 'Explicação',
        html: title.replace(/\n/g, '<br>'),
        icon: 'info',
        confirmButtonText: 'Entendi',
        confirmButtonColor: '#4a6bff',
        background: isDark ? '#1e1e2e' : '#ffffff', // Cores de fundo
        color: isDark ? '#f8f9fa' : '#212529'     // Cores de texto
        /*background: isDark ? 'var(--card-bg)' : '#fff',
        color: isDark ? 'var(--text-color)' : '#000'*/
    });
}
</script>   
    

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script type="text/javascript">
        function I(i){return document.getElementById(i);}

        // Configuração do tema
        function setupTheme() {
            const themeToggle = document.getElementById('themeToggle');
            
            // Verifica se há um tema salvo, caso contrário usa light como padrão
            const savedTheme = localStorage.getItem('theme') || 'dark';
            
            // Aplica o tema salvo
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
            
            // Atualiza o ícone do botão
            updateThemeIcon(savedTheme);
            
            // Alterna o tema quando o botão é clicado
            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                document.documentElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
                
                // Atualiza as cores dos medidores
                updateMeterColors(newTheme);
                updateUI(true);
            });
        }
        
        function updateThemeIcon(theme) {
            const icon = I('themeToggle').querySelector('i');
            if (theme === 'dark') {
                icon.classList.replace('fa-moon', 'fa-sun');
            } else {
                icon.classList.replace('fa-sun', 'fa-moon');
            }
        }
        
        function updateMeterColors(theme) {
            meterBk = theme === 'dark' ? "#2a2a3a" : "#e9ecef";
            meterTextColor = theme === 'dark' ? "#ffffff" : "#495057";
        }
        
        // Inicializa o tema
        setupTheme();
        
        //INITIALIZE SPEEDTEST
        var s = new Speedtest(); //create speedtest object

        // Cores dos medidores
        var dlColor = getComputedStyle(document.documentElement).getPropertyValue('--dl-color').trim();
        var ulColor = getComputedStyle(document.documentElement).getPropertyValue('--ul-color').trim();
        var meterBk = getComputedStyle(document.documentElement).getPropertyValue('--meter-bg').trim();
        var progColor = getComputedStyle(document.documentElement).getPropertyValue('--prog-color').trim();
        var meterTextColor = getComputedStyle(document.documentElement).getPropertyValue('--meter-text-color').trim();

function drawMeter(c, amount, bk, fg, progress, prog) {
    var ctx = c.getContext("2d");
    var dp = window.devicePixelRatio || 1;
    var cw = c.clientWidth * dp, ch = c.clientHeight * dp;
    var sizScale = ch * 0.0055;
    
    // Ajuste para mobile
    if(window.innerWidth <= 768) {
        sizScale = ch * 0.004;
    }

    if (c.width !== cw || c.height !== ch) {
        c.width = cw;
        c.height = ch;
    }
    ctx.clearRect(0, 0, cw, ch);

    // Obter o tema atual
    const isDarkMode = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    
    // Configurações de cor baseadas no tema
    const markerStyle = {
        text: isDarkMode ? getComputedStyle(document.documentElement).getPropertyValue('--ping-color').trim() : getComputedStyle(document.documentElement).getPropertyValue('--primary-color').trim(),
        line: isDarkMode ? "rgba(147, 112, 219, 0.6)" : "rgba(74, 107, 255, 0.6)"
    };

    // 1. Marcadores principais
    [0, 200, 400, 600, 800, 1000].forEach(speed => {
        const markAmount = speed / 1000;
        const angle = -Math.PI * 1.1 + markAmount * Math.PI * 1.2;
        
        // Linhas dos marcadores
        ctx.beginPath();
        ctx.strokeStyle = markerStyle.line;
        ctx.lineWidth = 2 * sizScale;
        ctx.moveTo(
            c.width/2 + Math.cos(angle) * (c.height/1.8 - 30 * sizScale),
            c.height - 58 * sizScale + Math.sin(angle) * (c.height/1.8 - 30 * sizScale)
        );
        ctx.lineTo(
            c.width/2 + Math.cos(angle) * (c.height/1.8 - 15 * sizScale),
            c.height - 58 * sizScale + Math.sin(angle) * (c.height/1.8 - 15 * sizScale)
        );
        ctx.stroke();
        
        // Texto dos números
        ctx.font = `${15 * sizScale}px Arial`;
        ctx.fillStyle = markerStyle.text;
        ctx.textAlign = "center";
        ctx.fillText(
            speed.toString(),
            c.width/2 + Math.cos(angle) * (c.height/1.8 - 45 * sizScale),
            c.height - 58 * sizScale + Math.sin(angle) * (c.height/1.8 - 45 * sizScale) + 5 * sizScale
        );
    });
            ctx.stroke();

            // 2. Fundo do medidor (trilha)
            ctx.beginPath();
            ctx.strokeStyle = bk;
            ctx.lineWidth = 12 * sizScale;
            ctx.arc(
                c.width/2,
                c.height - 58 * sizScale,
                c.height/1.8 - ctx.lineWidth,
                -Math.PI * 1.1,
                Math.PI * 0.1
            );
            ctx.stroke();

            // 3. Ponteiro central (agulha)
            const angle = -Math.PI * 1.1 + amount * Math.PI * 1.2;
            ctx.beginPath();
            ctx.strokeStyle = "#FF0000";
            ctx.lineWidth = 3 * sizScale;
            ctx.moveTo(c.width/2, c.height - 58 * sizScale);
            ctx.lineTo(
                c.width/2 + Math.cos(angle) * (c.height/1.8 - 25 * sizScale),
                c.height - 58 * sizScale + Math.sin(angle) * (c.height/1.8 - 25 * sizScale)
            );
            ctx.stroke();

            // 4. Medidor ativo
            ctx.beginPath();
            var gradient = ctx.createLinearGradient(
                0, c.height - 100 * sizScale,
                0, c.height
            );
            gradient.addColorStop(0, fg);
            gradient.addColorStop(1, mixColors(fg, "#FFFFFF", 0.5));
            
            ctx.strokeStyle = gradient;
            ctx.lineWidth = 10 * sizScale;
            ctx.lineCap = "round";
            ctx.shadowColor = fg;
            ctx.shadowBlur = 10 * sizScale;
            
            ctx.arc(
                c.width/2,
                c.height - 58 * sizScale,
                c.height/1.8 - ctx.lineWidth,
                -Math.PI * 1.1,
                angle
            );
            ctx.stroke();

            // 5. Valor atual (texto grande no centro)
            ctx.font = `${16 * sizScale}px Arial`;
            ctx.fillStyle = fg;
            ctx.textAlign = "center";
            ctx.fillText(
                Math.round(amount * 1000).toString(),
                c.width/2,
                c.height - 30 * sizScale
            );
            
            // 6. Barra de progresso
            if(typeof progress !== "undefined"){
                ctx.beginPath();
                ctx.fillStyle = prog;
                ctx.globalAlpha = 0.9;
                ctx.fillRect(
                    c.width * 0.3,
                    c.height - 16 * sizScale,
                    c.width * 0.4 * progress,
                    4 * sizScale
                );
                ctx.globalAlpha = 1.0;
            }
        }

        function mixColors(color1, color2, weight) {
            return weight > 0.5 ? color1 : color2;
        }

        function mbpsToAmount(s) {
            const maxSpeed = 1000;
            return Math.min(s / maxSpeed, 1);
        }
        
        function format(d) {
            d = Number(d);
            if (d < 10) return d.toFixed(2);
            if (d < 100) return d.toFixed(1);
            return d.toFixed(0);
        }

        //UI CODE
        var uiData = null;
        
        function startStop() {
            if (s.getState() == 3) {
                //speedtest is running, abort
                s.abort();
                uiData = null;
                I("startStopBtn").className = "btn btn-lg px-4 py-2";
                I("startStopBtn").innerHTML = '<i class="fas fa-play me-2"></i> Testar';
                initUI();
            } else {
                //test is not running, begin
                I("startStopBtn").className = "btn btn-lg px-4 py-2 running";
                I("startStopBtn").innerHTML = '<i class="fas fa-stop me-2"></i> Parar';
                
                s.onupdate = function(data) {
                    uiData = data;
                };
                
                s.onend = function(aborted) {
                    I("startStopBtn").className = "btn btn-lg px-4 py-2";
                    I("startStopBtn").innerHTML = '<i class="fas fa-play me-2"></i> Testar';
                    updateUI(true);
                };
                
                s.start();
            }
        }

        function updateUI(forced) {
            if (!forced && s.getState() != 3) return;
            if (uiData == null) return;
            
            var status = uiData.testState;
            I("ip").textContent = uiData.clientIp;
            
            I("dlText").textContent = (status == 1 && uiData.dlStatus == 0) ? "..." : format(uiData.dlStatus);
            drawMeter(I("dlMeter"), mbpsToAmount(Number(uiData.dlStatus * (status == 1 ? oscillate() : 1))), meterBk, dlColor, Number(uiData.dlProgress), progColor);
            
            I("ulText").textContent = (status == 3 && uiData.ulStatus == 0) ? "..." : format(uiData.ulStatus);
            drawMeter(I("ulMeter"), mbpsToAmount(Number(uiData.ulStatus * (status == 3 ? oscillate() : 1))), meterBk, ulColor, Number(uiData.ulProgress), progColor);
            
            I("pingText").textContent = format(uiData.pingStatus);
            I("jitText").textContent = format(uiData.jitterStatus);
        }

        function oscillate() {
            return 1 + 0.02 * Math.sin(Date.now() / 100);
        }

        window.requestAnimationFrame = window.requestAnimationFrame || 
                                      window.webkitRequestAnimationFrame || 
                                      window.mozRequestAnimationFrame || 
                                      window.msRequestAnimationFrame || 
                                      (function(callback, element) { setTimeout(callback, 1000 / 60); });

        function frame() {
            requestAnimationFrame(frame);
            updateUI();
        }
        
        frame();

        function initUI() {
            drawMeter(I("dlMeter"), 0, meterBk, dlColor, 0);
            drawMeter(I("ulMeter"), 0, meterBk, ulColor, 0);
            I("dlText").textContent = "-";
            I("ulText").textContent = "-";
            I("pingText").textContent = "-";
            I("jitText").textContent = "-";
            I("ip").textContent = "";
        }
        
        setTimeout(function() { initUI(); }, 100);
    </script>
    
    

</body>
</html>