<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
// $user = $_SESSION['user'];
?>

<style>
    .profile-card-main {
        background-color: #f2e8cf; 
        border: 1px solid rgba(44, 24, 16, 0.1);
        border-radius: 2.5rem;
        padding: 3rem;
    }

    .concept-section {
        background-color: rgba(44, 24, 16, 0.03);
        border-radius: 1.5rem;
        padding: 2.5rem;
        border-left: 4px solid #d4af37;
        position: relative;
    }

    .icon-code {
        font-family: serif;
        font-weight: bold;
    }
</style>

<main class="relative z-20 max-w-7xl mx-auto px-6 md:px-10 mt-16 mb-24">
    
    <div class="border-b border-[#2c1810]/10 pb-10 mb-16">
        <h1 class="font-book text-6xl font-bold italic tracking-tighter text-ink leading-tight">Reader <span class="text-gold">Archives</span></h1>
        <p class="font-book text-ink/50 italic text-lg uppercase tracking-widest text-[10px]">Your personal sanctuary & status</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <div class="lg:col-span-1 space-y-8">
            <div class="profile-card-main shadow-sm flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-[#2c1810] flex items-center justify-center text-gold text-4xl font-black border-4 border-gold/20 mb-6 shadow-xl">
                    <?= strtoupper(substr($user['username'] ?? 'U', 0, 1)) ?>
                </div>
                
                <h2 class="font-book text-3xl font-bold italic text-ink"><?= htmlspecialchars($user['username'] ?? 'Citizen') ?></h2>
                <p class="font-ui text-[10px] uppercase font-black tracking-[0.3em] text-gold mb-4"><?= htmlspecialchars($user['role'] ?? 'Reader') ?></p>
                
                <div class="w-full pt-6 mt-6 border-t border-[#2c1810]/5 space-y-4 text-left mb-8">
                    <div class="flex flex-col">
                        <span class="font-ui text-[9px] uppercase font-black text-ink/30 tracking-widest">Email Address</span>
                        <span class="font-book text-sm text-ink italic font-bold"><?= htmlspecialchars($user['email'] ?? 'Not set') ?></span>
                    </div>
                </div>

                <a href="/editprofile" class="block w-full py-4 bg-[#2c1810] text-paper rounded-full font-ui text-[10px] uppercase font-black tracking-widest hover:bg-gold hover:text-[#2c1810] transition-all text-center shadow-lg">
                    Edit Profile
                </a>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-12">
            
            <section class="space-y-6">
                <div class="flex items-center space-x-4">
                    <span class="h-px w-10 bg-gold"></span>
                    <h3 class="font-book text-3xl font-bold italic text-ink">The Concept</h3>
                </div>
                <div class="concept-section flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex-grow">
                        <p class="font-book text-lg text-ink/70 italic leading-relaxed">
                            "Victory Age is not just a blog; it is an eternal archive where triumphs are etched in ink. We believe that every success, no matter how small, deserves to be chronicled for generations to come."
                        </p>
                    </div>
                    
                    <?php if ($_SESSION['user']['role'] === 'reader'): ?>
                    <div class="flex-shrink-0">
                        <form action="/update-role" method="POST">
                            <button type="submit" class="whitespace-nowrap px-8 py-4 bg-gold text-[#2c1810] rounded-full font-ui text-[10px] uppercase font-black tracking-widest hover:bg-[#2c1810] hover:text-paper transition-all shadow-xl active:scale-95">
                                Switch to Author &rarr;
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <h4 class="font-book text-xl font-bold italic text-gold">The Golden Rules</h4>
                    <ul class="space-y-4 font-book text-sm text-ink/60 italic">
                        <li class="flex items-start"><span class="mr-2 text-gold">I.</span> Respect the sanctity of the written word.</li>
                        <li class="flex items-start"><span class="mr-2 text-gold">II.</span> No toxic ink; constructive criticism only.</li>
                        <li class="flex items-start"><span class="mr-2 text-gold">III.</span> Every story must be a step toward victory.</li>
                    </ul>
                </div>

                <div class="space-y-6">
                    <h4 class="font-book text-xl font-bold italic text-gold">Joining the Scribes</h4>
                    <ul class="space-y-4 font-book text-sm text-ink/60 italic">
                        <li class="flex items-start"><span class="icon-code text-gold mr-2">&#10003;</span> Must have a verified identity.</li>
                        <li class="flex items-start"><span class="icon-code text-gold mr-2">&#10003;</span> Commitment to high-quality etching.</li>
                        <li class="flex items-start"><span class="icon-code text-gold mr-2">&#10003;</span> Passion for the community's growth.</li>
                    </ul>
                </div>
            </section>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>