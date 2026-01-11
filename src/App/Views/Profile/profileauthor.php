<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
// $user = $_SESSION['user'];
// $author_articles = fetchAuthorArticles($user['id']); 
?>

<style>
    .victory-bg-paper { background-color: #f2e8cf; }
    .ink-border { border: 1px solid rgba(44, 24, 16, 0.1); }
    
    .author-card {
        background-color: #f2e8cf;
        border-radius: 2.5rem;
        padding: 3rem;
    }

    .stat-pill {
        background: rgba(44, 24, 16, 0.05);
        border-radius: 1rem;
        padding: 1rem;
        border-left: 3px solid #d4af37;
    }

    /* تنسيق الأيقونات البرمجية */
    .svg-icon {
        width: 14px;
        height: 14px;
        fill: currentColor;
    }
</style>

<main class="relative z-20 max-w-7xl mx-auto px-6 md:px-10 mt-16 mb-24">
    
    <div class="border-b border-[#2c1810]/10 pb-10 mb-16 flex justify-between items-end">
        <div>
            <h1 class="font-book text-6xl font-bold italic tracking-tighter text-ink leading-tight">Master <span class="text-gold">Scribe</span></h1>
            <p class="font-book text-ink/50 italic text-lg uppercase tracking-widest text-[10px]">Your literary legacy and insights</p>
        </div>
        <a href="/createarticle" class="px-6 py-3 bg-gold text-[#2c1810] rounded-full font-ui text-[10px] font-black uppercase tracking-widest hover:bg-[#2c1810] hover:text-paper transition-all">
            + New Manuscript
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        
        <div class="lg:col-span-1 space-y-8">
            <div class="author-card shadow-sm flex flex-col items-center text-center ink-border">
                <div class="w-24 h-24 rounded-full bg-[#2c1810] flex items-center justify-center text-gold text-4xl font-black border-4 border-gold/20 mb-6 shadow-xl">
                    <?= strtoupper(substr($user['username'] ?? 'A', 0, 1)) ?>
                </div>
                <h2 class="font-book text-2xl font-bold italic text-ink"><?= htmlspecialchars($user['first_name']) ?></h2>
                <p class="font-ui text-[9px] uppercase font-black text-gold tracking-widest mb-6">Verified Author</p>
                
                <div class="w-full space-y-3">
                    <a href="/editprofile" class="block w-full py-3 bg-[#2c1810] text-paper rounded-full font-ui text-[9px] uppercase font-black tracking-widest hover:bg-gold transition-all shadow-md">
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <h4 class="font-ui text-[10px] uppercase font-black text-ink/40 tracking-widest ml-4">Quick Insights</h4>
                <div class="stat-pill">
                    <span class="block font-ui text-[9px] uppercase font-black text-ink/40">Total Victories</span>
                    <span class="font-book text-2xl font-bold italic text-ink"><?= count($author_articles ?? []) ?></span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-16">
            
            <section>
                <div class="flex items-center space-x-4 mb-8">
                    <span class="h-px w-10 bg-gold"></span>
                    <h3 class="font-book text-3xl font-bold italic text-ink">Manage Manuscripts</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php foreach($author_articles as $article): ?>
                    <article class="victory-bg-paper ink-border rounded-[2rem] p-8 flex flex-col h-[280px] group relative shadow-sm hover:shadow-xl transition-all duration-500">
                        <div class="flex justify-between mb-4">
                            <span class="font-ui text-[9px] uppercase font-black text-gold italic">#<?= $article['id'] ?></span>
                            
                            <div class="flex space-x-4">
                                <a href="/editarticle?id=<?= $article['id'] ?>" class="flex items-center space-x-2 text-[10px] font-black text-ink/40 hover:text-gold transition-colors uppercase tracking-widest group/btn">
                                    <svg class="svg-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4L18.5 2.5z"></path></svg>
                                    <span>Edit</span>
                                </a>

                                <form action="/deletearticle" method="POST" onsubmit="return confirm('Burn this manuscript forever? This action cannot be undone.')">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <button type="submit" class="flex items-center space-x-2 text-[10px] font-black text-ink/40 hover:text-red-800 transition-colors uppercase tracking-widest group/btn">
                                        <svg class="svg-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        <span>Burn</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="flex-grow cursor-default">
                            <h4 class="font-book text-2xl font-bold italic text-ink mb-3 line-clamp-2"><?= htmlspecialchars($article['title']) ?></h4>
                            <p class="font-book text-sm text-ink/60 italic line-clamp-4 leading-relaxed"><?= htmlspecialchars(strip_tags($article['content'])) ?></p>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section>
                <div class="flex items-center space-x-4 mb-8">
                    <span class="h-px w-10 bg-gold"></span>
                    <h3 class="font-book text-3xl font-bold italic text-ink">Legacy Discourse</h3>
                </div>

                <div class="victory-bg-paper ink-border rounded-[2.5rem] overflow-hidden shadow-sm">
                    <table class="w-full text-left font-book">
                        <thead class="bg-[#2c1810]/5 border-b border-[#2c1810]/10">
                            <tr>
                                <th class="px-8 py-5 font-ui text-[10px] uppercase font-black text-ink/50">Manuscript Title</th>
                                <th class="px-8 py-5 font-ui text-[10px] uppercase font-black text-ink/50 text-right">Records</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#2c1810]/5">
                            <?php foreach($author_articles as $article): ?>
                            <tr class="hover:bg-gold/5 transition-colors group">
                                <td class="px-8 py-6">
                                    <span class="font-bold italic text-ink block"><?= htmlspecialchars($article['title']) ?></span>
                                    <span class="font-ui text-[8px] uppercase text-ink/30 tracking-widest">Archived Victory</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="/articles" class="inline-flex items-center space-x-2 py-2 px-4 border border-gold/20 rounded-full font-ui text-[9px] font-black uppercase tracking-widest text-gold hover:bg-gold hover:text-[#2c1810] transition-all">
                                        <span>Review Discourse</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>