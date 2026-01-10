<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
// $user = $_SESSION['user'];
// $user_articles = fetchUserArticles($user['id']); 
?>

<style>
    .profile-card {
        background-color: #fbf9f4;
        border: 1px solid #e2dcc8;
        border-radius: 2.5rem;
        padding: 3rem;
    }
    .icon-code {
        font-family: serif;
        font-weight: bold;
    }
</style>

<main class="relative z-20 max-w-7xl mx-auto px-6 md:px-10 mt-16 mb-24">
    
    <div class="border-b border-[#2c1810]/10 pb-10 mb-16">
        <h1 class="font-book text-6xl font-bold italic tracking-tighter text-ink leading-tight">Your <span class="text-gold">Identity</span></h1>
        <p class="font-book text-ink/50 italic text-lg uppercase tracking-widest text-[10px]">Managing your status in the archives</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <div class="lg:col-span-1 space-y-8">
            <div class="profile-card shadow-sm flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-[#2c1810] flex items-center justify-center text-gold text-4xl font-black border-4 border-gold/20 mb-6">
                    <?= strtoupper(substr($user['username'] ?? 'U', 0, 1)) ?>
                </div>
                
                <h2 class="font-book text-3xl font-bold italic text-ink"><?= htmlspecialchars($user['username'] ?? 'Citizen') ?></h2>
                <p class="font-ui text-[10px] uppercase font-black tracking-[0.3em] text-gold mb-4"><?= htmlspecialchars($user['role'] ?? 'Reader') ?></p>
                
                <div class="w-full pt-6 mt-6 border-t border-[#2c1810]/5 space-y-4 text-left">
                    <div class="flex flex-col">
                        <span class="font-ui text-[9px] uppercase font-black text-ink/30">Email Address</span>
                        <span class="font-book text-sm text-ink italic"><?= htmlspecialchars($user['email'] ?? 'Not set') ?></span>
                    </div>
                </div>

                <a href="/editprofile" class="mt-8 w-full py-3 bg-[#2c1810] text-paper rounded-full font-ui text-[10px] uppercase font-black tracking-widest hover:bg-gold transition-colors text-center">
                    Edit Profile
                </a>
            </div>

            <?php if (isset($user['role']) && $user['role'] === 'reader'): ?>
            <div class="profile-card border-dashed border-2 border-gold/30 bg-gold/5 text-center p-8">
                <h4 class="font-book text-xl font-bold italic text-ink mb-2">Ready to Write?</h4>
                <p class="font-book text-xs text-ink/50 mb-6 italic">Upgrade your status to Author and start etching your victories.</p>
                <form action="/update-role" method="POST">
                    <button type="submit" class="font-ui text-[10px] uppercase font-black text-gold hover:text-ink transition-colors tracking-widest">
                        Become an Author &#10142;
                    </button>
                </form>
            </div>
            <?php endif; ?>
        </div>

        <div class="lg:col-span-2">
            <div class="flex items-center space-x-4 mb-8">
                <span class="h-px w-10 bg-gold"></span>
                <h3 class="font-book text-3xl font-bold italic text-ink">My Chronicles</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php if (!empty($user_articles)): ?>
                    <?php foreach($user_articles as $article): ?>
                    <article class="bg-paper/40 border border-[#2c1810]/5 rounded-[2rem] p-8 flex flex-col h-[320px] hover:shadow-xl transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <span class="font-ui text-[9px] uppercase font-black tracking-widest text-gold italic">Entry #<?= $article['id'] ?></span>
                            <span class="font-ui text-[9px] font-black text-ink/30"><?= date('M Y', strtotime($article['create_at'])) ?></span>
                        </div>
                        
                        <div class="flex-grow">
                            <h4 class="font-book text-2xl font-bold italic text-ink mb-3 line-clamp-2"><?= htmlspecialchars($article['title']) ?></h4>
                            <p class="font-book text-sm text-ink/60 italic line-clamp-3 leading-relaxed">
                                <?= htmlspecialchars(strip_tags($article['content'])) ?>
                            </p>
                        </div>

                        <div class="pt-6 mt-6 border-t border-[#2c1810]/5 flex items-center space-x-6">
                            <div class="flex items-center space-x-2 text-ink/30">
                                <span class="icon-code text-lg">&hearts;</span>
                                <span class="font-ui text-[10px] font-black"><?= number_format($article['likes_count'] ?? 0) ?></span>
                            </div>
                            <div class="flex items-center space-x-2 text-ink/30">
                                <span class="icon-code text-md">&#10002;</span>
                                <span class="font-ui text-[10px] font-black"><?= number_format($article['comments_count'] ?? 0) ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full py-20 text-center opacity-30">
                        <span class="icon-code text-4xl block mb-4">&#9998;</span>
                        <p class="font-book italic text-xl">No manuscripts etched yet...</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>