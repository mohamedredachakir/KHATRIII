<?php
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
?>;

<main class="relative z-20 max-w-7xl mx-auto px-6 md:px-10 mt-16 md:mt-24">
    
    <section class="text-center space-y-8 mb-32">
        <div class="inline-block px-4 py-1 border border-gold/30 rounded-full mb-4">
            <span class="text-[10px] uppercase tracking-[0.5em] font-ui font-bold text-gold">The Sovereign Era of Writing</span>
        </div>
        
        <h1 class="text-5xl md:text-8xl font-book font-bold italic leading-tight tracking-tighter">
            Where Every Word <br> 
            <span class="text-gold">Claims Victory.</span>
        </h1>
        
        <p class="max-w-2xl mx-auto font-book text-xl md:text-2xl text-ink/70 leading-relaxed italic">
            "EL-CUADERNO is not just a blog; it is a digital sanctuary for thinkers, dreamers, and victors. A place where the ink of history meets the technology of tomorrow."
        </p>

        <div class="flex justify-center space-x-6 pt-6">
            <a href="register.php" class="bg-gold text-paper px-10 py-4 rounded-full font-ui text-xs font-black uppercase tracking-widest hover:bg-ink hover:text-white transition-all shadow-xl">
                Join the Legion
            </a>
            <a href="#about" class="border border-ink/20 px-10 py-4 rounded-full font-ui text-xs font-black uppercase tracking-widest hover:border-gold hover:text-gold transition-all">
                The Manifesto
            </a>
        </div>
    </section>

    <section id="about" class="grid grid-cols-1 md:grid-cols-2 gap-20 py-20 border-t border-ink/5">
        <div class="space-y-6">
            <h2 class="font-book text-4xl font-bold italic">The Scribe's Vision</h2>
            <p class="font-book text-lg text-ink/80 leading-loose">
                In an age of fleeting thoughts, **EL-CUADERNO** was born to preserve the weight of the written word. We believe that an article is a battle for truth, and every author is a knight defending their ideas. 
            </p>
            <ul class="space-y-4 font-ui text-sm uppercase tracking-widest font-bold text-gold">
                <li><span class="mr-4 text-ink">I.</span> Freedom of Expression</li>
                <li><span class="mr-4 text-ink">II.</span> Artistic Integrity</li>
                <li><span class="mr-4 text-ink">III.</span> Legacy of Victory</li>
            </ul>
        </div>
        <div class="relative group">
            <div class="absolute inset-0 border border-gold/20 rounded-2xl rotate-3 group-hover:rotate-0 transition-transform duration-700"></div>
            <div class="bg-paper p-10 rounded-2xl shadow-2xl relative z-10 border border-ink/5">
                <h3 class="font-book text-2xl font-bold mb-4 italic">Why El-Cuaderno?</h3>
                <p class="font-book text-ink/70 leading-relaxed italic">
                    Because your stories deserve more than a scroll. They deserve a monument. Our platform offers a distraction-free, cinematic environment for both creators (Authors) and explorers (Readers).
                </p>
                <div class="mt-8 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gold rounded-full flex items-center justify-center text-paper font-bold italic">V</div>
                    <span class="text-xs uppercase font-black tracking-widest font-ui">Authentic Chronicles</span>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-32 space-y-12">
        <div class="flex justify-between items-end border-b border-ink/10 pb-6">
            <h2 class="font-book text-4xl font-bold italic">Latest Chronicles</h2>
            <a href="articles.php" class="text-xs font-ui font-bold uppercase tracking-widest text-gold hover:text-ink transition-colors">View All Chapters &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="group cursor-pointer">
                <div class="h-64 bg-ink/5 rounded-2xl mb-6 overflow-hidden border border-ink/5 relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-paper to-transparent opacity-40 group-hover:opacity-10 transition-opacity"></div>
                    <img src="https://images.unsplash.com/photo-1544640808-32ca72ac7f37" alt="Old Manuscript" class="w-full h-full object-cover filter sepia-[.3] group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="space-y-4">
                    <span class="text-[10px] font-ui font-black uppercase text-gold tracking-widest">History</span>
                    <h3 class="font-book text-2xl font-bold group-hover:text-gold transition-colors italic leading-snug">The Conquest of the Unwritten.</h3>
                    <p class="text-sm text-ink/60 font-book italic line-clamp-2">How our ancestors paved the way for modern chronicles through the art of the quill...</p>
                    <div class="flex items-center space-x-3 pt-2">
                        <div class="w-8 h-8 rounded-full bg-gold/20 flex items-center justify-center font-bold text-[10px]">RA</div>
                        <span class="text-[10px] font-ui font-bold uppercase tracking-widest opacity-60">Royal Archiver</span>
                    </div>
                </div>
            </div>

            <div class="group cursor-pointer">
                <div class="h-64 bg-ink/5 rounded-2xl mb-6 overflow-hidden border border-ink/5 relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-paper to-transparent opacity-40 group-hover:opacity-10 transition-opacity"></div>
                    <img src="https://images.unsplash.com/photo-1512486130939-2c4f79935e4f" alt="Artistic Desk" class="w-full h-full object-cover filter sepia-[.3] group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="space-y-4">
                    <span class="text-[10px] font-ui font-black uppercase text-gold tracking-widest">Literature</span>
                    <h3 class="font-book text-2xl font-bold group-hover:text-gold transition-colors italic leading-snug">The Golden Ink of Madrid.</h3>
                    <p class="text-sm text-ink/60 font-book italic line-clamp-2">Exploring the deep literary roots that define the spirit of El-Cuaderno in the modern era...</p>
                    <div class="flex items-center space-x-3 pt-2">
                        <div class="w-8 h-8 rounded-full bg-gold/20 flex items-center justify-center font-bold text-[10px]">SC</div>
                        <span class="text-[10px] font-ui font-bold uppercase tracking-widest opacity-60">Senior Cardinal</span>
                    </div>
                </div>
            </div>

            <div class="bg-[#2c1810] rounded-2xl p-10 flex flex-col justify-center items-center text-center space-y-6">
                <div class="w-16 h-16 border-2 border-gold rounded-full flex items-center justify-center rotate-12">
                    <span class="text-gold text-2xl">❦</span>
                </div>
                <h3 class="text-paper font-book text-3xl italic">Your Story Awaits.</h3>
                <p class="text-paper/60 font-book text-sm italic">Become a creator and leave your mark in the annals of Victory.</p>
                <a href="register.php" class="w-full py-4 bg-gold text-[#2c1810] font-ui font-black uppercase text-[10px] tracking-widest rounded-full hover:bg-paper transition-all">
                    Start Writing
                </a>
            </div>
        </div>
    </section>

</main>



<?php require_once __DIR__ . '/../Layouts/footer.php';?>
