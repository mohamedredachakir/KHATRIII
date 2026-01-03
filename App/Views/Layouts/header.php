<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EL-CUADERNO | The Living Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,400;0,700;1,600&family=Inter:wght@300;600&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        paper: '#f4ecd8', 
                        ink: '#1a1a1b',
                        gold: '#af8c42',
                    },
                    fontFamily: {
                        book: ['Crimson Pro', 'serif'],
                        ui: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* إضافة نسيج الورق القديم للخلفية بالكامل */
        body {
            background-color: #f4ecd8;
            /* نسيج ورق قديم احترافي */
            background-image: url("https://www.transparenttextures.com/patterns/old-map.png");
            background-attachment: fixed;
            min-height: 100vh;
        }

        /* تأثير الظل الجانبي لتبدو الصفحة كأنها داخل كتاب */
        .page-texture-overlay {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.05) 100%);
            pointer-events: none;
            z-index: 10;
        }

        /* تخصيص الروابط */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: #af8c42;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }
    </style>
</head>
<body class="font-book text-ink antialiased">
    <div class="page-texture-overlay"></div>
    <div class="fixed inset-0 border-[8px] md:border-[15px] border-[#2c1810] pointer-events-none z-[100] shadow-2xl opacity-95"></div>