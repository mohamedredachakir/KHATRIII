<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Scroll Not Found | QRAYATHON</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;600&display=swap');
        .font-royal { font-family: 'Cinzel', serif; }
        .bg-king { background-color: #1a1a2e; }
        .text-gold { color: #c5a059; }
        .border-gold { border-color: #c5a059; }
        .gold-shadow { box-shadow: 0 4px 15px rgba(197, 160, 89, 0.3); }
    </style>
</head>
<body class="bg-king h-screen flex items-center justify-center text-white overflow-hidden">

    <div class="text-center p-8 relative z-10">
        <div class="absolute inset-0 opacity-5 flex items-center justify-center -z-10">
            <i class="fas fa-scroll text-[25rem]"></i>
        </div>

        <h1 class="text-9xl font-royal text-gold mb-2 animate__animated animate__fadeInDown">404</h1>
        
        <h2 class="text-2xl font-royal mb-6 tracking-[0.3em] uppercase">Manuscript Missing</h2>
        
        <p class="text-gray-400 max-w-sm mx-auto mb-12 leading-relaxed italic">
            "Not all who wander are lost, but this page certainly is."
        </p>

        <div class="flex justify-center">
            <a href="/" 
               class="group relative inline-flex items-center gap-4 px-10 py-4 bg-transparent border-2 border-gold text-gold font-bold rounded-full overflow-hidden transition-all duration-500 hover:bg-gold hover:text-king gold-shadow">
                
                <i class="fas fa-home transition-transform group-hover:scale-110"></i>
                <span class="tracking-[0.2em] uppercase">Back to Home</span>
                
                <div class="absolute inset-0 bg-white/10 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
            </a>
        </div>

        <div class="mt-8">
            <a href="index.php?url=books" class="text-gray-500 hover:text-white text-xs uppercase tracking-widest transition">
                View Available Archives Instead
            </a>
        </div>
    </div>

    <div class="fixed top-0 left-0 w-32 h-32 border-t-4 border-l-4 border-gold/20 m-8"></div>
    <div class="fixed bottom-0 right-0 w-32 h-32 border-b-4 border-r-4 border-gold/20 m-8"></div>

</body>
</html>