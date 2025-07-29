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
    
<style>
    :root {
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
        --body-bg: #f5f7ff;
        --text-color: #212529;
        --card-bg: #ffffff;
        --meter-bg: #80808040;
        --dl-color: #8f16fa;
        --ul-color: #00c5ff;
    }
    
    [data-bs-theme="dark"] {
        --body-bg: #121225;
        --text-color: #f8f9fa;
        --card-bg: #1e1e2e;
        --meter-bg: #2a2a3a;
        --primary-color: #5c7cff;
        --secondary-color: #7070bb;
        --ping-color: #9370db;
        --jitter-color: #3cb371;
        --dl-color: #b56aff;
        --ul-color: #5affb5;
    }
    
    body {
        background-color: var(--body-bg);
        color: var(--text-color);
        transition: background-color 0.3s ease, color 0.3s ease;
        background-image: 
            radial-gradient(circle at 75% 30%, rgba(74, 107, 255, 0.15) 0%, transparent 25%),
            linear-gradient(135deg, rgba(100,149,237,0.08) 0%, rgba(0,0,0,0) 50%, rgba(100,149,237,0.08) 100%),
            linear-gradient(45deg, rgba(138,43,226,0.08) 0%, rgba(0,0,0,0) 50%, rgba(138,43,226,0.08) 100%);
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        position: relative;
        overflow-x: hidden;
    }

    /* Efeitos de luz animados */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(ellipse at center, rgba(74,107,255,0.2) 0%, rgba(74,107,255,0) 70%);
        pointer-events: none;
        z-index: -1;
        animation: pulse 8s infinite alternate;
    }

    /* Raios de luz aleatórios */
    body::after {
        content: "";
        position: fixed;
        top: -50%;
        left: -50%;
        right: -50%;
        bottom: -50%;
        background: 
            linear-gradient(45deg, rgba(255,255,255,0.02) 0%, transparent 50%, rgba(255,255,255,0.02) 100%),
            repeating-linear-gradient(
                45deg,
                transparent 0%,
                transparent 7%,
                rgba(74, 107, 255, 0.05) 7%,
                rgba(74, 107, 255, 0.05) 8%
            ),
            repeating-linear-gradient(
                -45deg,
                transparent 0%,
                transparent 7%,
                rgba(138, 43, 226, 0.05) 7%,
                rgba(138, 43, 226, 0.05) 8%
            );
        z-index: -1;
        animation: shine 12s infinite alternate, moveBackground 30s infinite linear;
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.2; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.05); }
    }

    @keyframes shine {
        0% { opacity: 0.05; }
        100% { opacity: 0.15; }
    }

    @keyframes moveBackground {
        0% { transform: translate(0, 0); }
        25% { transform: translate(-5%, 5%); }
        50% { transform: translate(-10%, 0); }
        75% { transform: translate(-5%, -5%); }
        100% { transform: translate(0, 0); }
    }

    /* Efeitos de partículas melhorados */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2; /* Mais baixo que os pseudo-elementos do body */
        overflow: hidden;
        pointer-events: none;
    }
    
    .particle {
        position: absolute;
        background: rgba(74, 107, 255, 0.4);
        border-radius: 50%;
        filter: blur(1px);
        animation: float linear infinite;
        will-change: transform;
    }
    
    @keyframes float {
        0% {
            transform: translateY(100vh) translateX(0) scale(0.5);
            opacity: 0;
        }
        10% {
            opacity: 0.8;
        }
        90% {
            opacity: 0.8;
        }
        100% {
            transform: translateY(-20vh) translateX(20px) scale(1.2);
            opacity: 0;
        }
    }

    /* Top bar */
    .top-bar {
        background: linear-gradient(90deg, var(--body-bg) 0%, var(--body-bg) 20%, var(--primary-color) 100%);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
    }

    .logo {
        height: 40px;
        transition: all 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .theme-toggle {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: var(--text-color);
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .theme-toggle:hover {
        transform: scale(1.1);
    }

    #startStopBtn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        transition: all 0.3s;
        font-weight: 600;
    }

    #startStopBtn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    #startStopBtn.running {
        background-color: var(--danger-color);
    }

    .test-card {
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .test-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

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
        color: #6c757d;
    }

    #ipArea {
        margin-top: 20px;
        font-size: 0.9rem;
        color: #6c757d;
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
    }
.particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -2;
    overflow: hidden;
    pointer-events: none;
}

.particle {
    position: absolute;
    border-radius: 50%;
    filter: blur(1px);
    animation: float linear forwards;
    will-change: transform;
    box-shadow: 0 0 15px 2px currentColor;
}

@keyframes float {
    0% {
        transform: translateY(0) translateX(0) scale(1);
        opacity: 0.8;
    }
    100% {
        transform: translateY(-120vh) translateX(20px) scale(1.2);
        opacity: 0;
    }
}
</style>
</head>
<body>
    <!-- Container de partículas DEVE vir primeiro -->
    <div class="particles" id="particlesContainer"></div>

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
            <div class="test-card text-center ping-jitter-card">
                <div class="test-name">Ping</div>
                <div id="pingText" class="small-meter-value" style="color: var(--ping-color)">-</div>
                <div class="unit">ms</div>
            </div>
            
            <!-- Jitter -->
            <div class="test-card text-center ping-jitter-card">
                <div class="test-name">Jitter</div>
                <div id="jitText" class="small-meter-value" style="color: var(--jitter-color)">-</div>
                <div class="unit">ms</div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <!-- Download -->
            <div class="col-md-5 col-sm-6 mb-3">
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
            <div class="col-md-5 col-sm-6 mb-3">
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
        
        <div class="text-center mt-3" id="ipArea">
            <span id="ip" class="text-muted"></span>
        </div>
    </div>
    
    
<script>
document.addEventListener('DOMContentLoaded', function() {
    const particlesContainer = document.getElementById('particlesContainer');
    if (!particlesContainer) return;
    
    // Configurações Turbo
    const settings = {
        particleCount: 2,  // Mais partículas inicialmente
        creationInterval: 500,  // Mais frequente
        minSize: 1,
        maxSize: 5,
        animationDuration: {min: 1, max: 5},  // Mais rápido
        colors: [
            'rgba(74, 107, 255, 0.8)',
            'rgba(100, 149, 237, 0.8)',
            'rgba(138, 43, 226, 0.8)',
            'rgba(255, 0, 136, 8)',
            'rgba(165, 59, 255, 0.8)',
            'rgba(165, 59, 255, 8)',
            'rgba(32, 194, 255, 0.8)',
            'rgba(253, 169, 101, 8)',
            'rgba(38, 134, 255, 0.8)'
        ]
    };

    // Função Turbo para criar partículas
    function createParticle(initial = false) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * (settings.maxSize - settings.minSize) + settings.minSize;
        const posX = Math.random() * window.innerWidth;
        const duration = Math.random() * 
            (settings.animationDuration.max - settings.animationDuration.min) + 
            settings.animationDuration.min;
        
        // Posicionamento inicial instantâneo
        if(initial) {
            particle.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${posX}px;
                bottom: ${Math.random() * 100}px;
                background: ${settings.colors[Math.floor(Math.random() * settings.colors.length)]};
                animation: float ${duration}s linear forwards;
                opacity: 0.8;
            `;
        } else {
            particle.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${posX}px;
                bottom: 0;
                background: ${settings.colors[Math.floor(Math.random() * settings.colors.length)]};
                animation: float ${duration}s linear forwards;
                opacity: 0;
            `;
            setTimeout(() => { particle.style.opacity = '0.8'; }, 10);
        }
        
        particlesContainer.appendChild(particle);
        setTimeout(() => particle.remove(), duration * 1000);
    }

    // Cria várias partículas IMEDIATAMENTE distribuídas pela tela
    for (let i = 0; i < settings.particleCount; i++) {
        createParticle(true);  // true para partículas iniciais
    }
    
    // Continua criando novas partículas
    setInterval(() => createParticle(), settings.creationInterval);
    
    // Redimensionamento responsivo
    window.addEventListener('resize', () => {
        particlesContainer.innerHTML = '';
        for (let i = 0; i < settings.particleCount; i++) {
            createParticle(true);
        }
    });
});
</script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script type="text/javascript">
        function I(i){return document.getElementById(i);}

        // Configuração do tema
        function setupTheme() {
            const themeToggle = document.getElementById('themeToggle');
            
            // Verifica se há um tema salvo, caso contrário usa light como padrão
            const savedTheme = localStorage.getItem('theme') || 'light';
            
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
            
            if (c.width !== cw || c.height !== ch) {
                c.width = cw;
                c.height = ch;
            }
            ctx.clearRect(0, 0, cw, ch);

            // 1. Marcadores principais (0, 200, 400, 600, 800, 1000)
            ctx.beginPath();
            ctx.strokeStyle = "rgba(255, 255, 255, 0.5)";
            ctx.lineWidth = 2 * sizScale;
            ctx.font = `${10 * sizScale}px Arial`;
            ctx.fillStyle = meterTextColor; // Usa a cor definida para os números
            ctx.textAlign = "center";
            
            [0, 200, 400, 600, 800, 1000].forEach(speed => {
                const markAmount = speed / 1000;
                const angle = -Math.PI * 1.1 + markAmount * Math.PI * 1.2;
                
                ctx.moveTo(
                    c.width/2 + Math.cos(angle) * (c.height/1.8 - 30 * sizScale),
                    c.height - 58 * sizScale + Math.sin(angle) * (c.height/1.8 - 30 * sizScale)
                );
                ctx.lineTo(
                    c.width/2 + Math.cos(angle) * (c.height/1.8 - 15 * sizScale),
                    c.height - 58 * sizScale + Math.sin(angle) * (c.height/1.8 - 15 * sizScale)
                );
                
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