<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';

// $article = fetchArticleById($_GET['id']);
// $comments = getCommentsByArticleId($_GET['id']);
?>

<main class="relative z-20 max-w-4xl mx-auto px-6 py-16 md:py-24">
    
    <a href="/articles" class="inline-flex items-center space-x-2 text-ink/40 hover:text-gold transition-colors mb-12 group">
        <span class="text-lg group-hover:-translate-x-1 transition-transform">←</span>
        <span class="font-ui text-[10px] uppercase font-black tracking-[0.2em]">Return to Chronicles</span>
    </a>

    <div class="border-l-2 border-gold/30 pl-8 mb-16 space-y-4">
        <span class="font-ui text-[10px] uppercase tracking-[0.4em] text-gold font-black">Discussing Manuscript</span>
        <h1 class="font-book text-4xl md:text-5xl font-bold italic text-ink"><?= htmlspecialchars($article['title'] ?? 'The Echoes of Victory') ?></h1>
        <p class="font-book text-ink/50 italic text-sm line-clamp-2"><?= htmlspecialchars(strip_tags($article['content'] ?? '...')) ?></p>
    </div>

    <section class="mb-20">
        <div class="bg-paper/40 backdrop-blur-md border border-[#2c1810]/5 rounded-[2rem] p-8 md:p-12 shadow-xl">
            <div class="flex items-center space-x-4 mb-8">
                <span class="h-px w-8 bg-gold"></span>
                <h2 class="font-ui text-[12px] uppercase font-black tracking-[0.3em] text-ink">Add to the Discourse</h2>
            </div>

            <form action="/addcomment" method="POST" class="space-y-6">
                <input type="hidden" name="id_article" value="<?= $_GET['id'] ?>">
                
                <div class="relative">
                    <textarea name="content" required rows="4" 
                              placeholder="Your thoughts, scribe? Let them be etched here..." 
                              class="w-full bg-transparent border-b border-[#2c1810]/10 py-4 font-book text-xl italic focus:outline-none focus:border-gold transition-all placeholder:text-ink/10 resize-none text-ink/80"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-10 py-4 bg-[#2c1810] text-paper rounded-full font-ui text-[10px] uppercase font-black tracking-[0.3em] hover:bg-gold hover:text-[#2c1810] transition-all transform hover:-translate-y-1 active:scale-95 shadow-lg">
                        Seal Comment
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="space-y-10">
        <div class="flex items-center justify-between mb-12 border-b border-[#2c1810]/5 pb-6">
            <h3 class="font-book text-2xl font-bold italic text-ink">
                Discourse <span class="text-gold opacity-50 ml-2">#<?= count($comments ?? []) ?></span>
            </h3>
            <div class="text-ink/30 font-ui text-[10px] uppercase tracking-widest font-black">Sorted by Time</div>
        </div>

        <?php if (!empty($comments)): ?>
            <?php foreach($comments as $comment): ?>
            <div class="group relative space-y-4 pb-10 border-b border-[#2c1810]/5 last:border-0">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-gold/10 flex items-center justify-center font-book italic text-gold border border-gold/20">
                            <?= strtoupper(substr($comment['first_name'], 0, 1)) ?>
                        </div>
                        <div>
                            <span class="font-book text-sm font-bold italic text-ink block leading-none"><?= htmlspecialchars($comment['first_name']) ?></span>
                            <span class="font-ui text-[8px] uppercase font-black text-ink/20 tracking-tighter">Scribe Ally</span>
                        </div>
                    </div>
                    <span class="font-ui text-[9px] text-ink/30 uppercase"><?= date('M d, Y', strtotime($comment['create_at'])) ?></span>
                </div>

                <div class="pl-11">
                    <p class="font-book text-lg text-ink/70 italic leading-relaxed">
                        "<?= htmlspecialchars($comment['content']) ?>"
                    </p>
                </div>

                <div class="pl-11 pt-2 opacity-0 group-hover:opacity-100 transition-opacity flex items-center space-x-6">
                    <button class="font-ui text-[9px] uppercase font-black text-ink/30 tracking-widest hover:text-gold transition-colors">
                        Report Disrespect
                    </button>

                    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == $comment['id_reader'] || $_SESSION['user']['role'] === 'admin')): ?>
                    <form action="/deletecomment" method="POST" onsubmit="return confirm('Are you certain you wish to erase this thought from history?')" class="inline">
                        <input type="hidden" name="id_commentaire" value="<?= $comment['id'] ?>">
                        <input type="hidden" name="id_article" value="<?= $_GET['id'] ?>">
                        <button type="submit" class="font-ui text-[9px] uppercase font-black text-red-900/40 tracking-widest hover:text-red-600 transition-colors">
                            Erase from History
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-20 bg-paper/20 rounded-[2rem] border border-dashed border-ink/5">
                <div class="text-3xl text-ink/10 mb-4">*</div>
                <p class="font-book italic text-ink/30 text-lg uppercase tracking-widest">The parchment is silent. Be the first to speak.</p>
            </div>
        <?php endif; ?>
    </section>

</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>