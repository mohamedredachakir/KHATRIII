<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
// $user = $_SESSION['user'];
?>

<style>
    .edit-profile-card {
        background-color: #f2e8cf;
        border: 1px solid rgba(44, 24, 16, 0.1);
        border-radius: 2.5rem;
        padding: 4rem;
    }

    .form-input {
        background: rgba(44, 24, 16, 0.03);
        border: 1px solid rgba(44, 24, 16, 0.1);
        border-radius: 1rem;
        padding: 1rem 1.5rem;
        font-family: 'serif';
        font-style: italic;
        color: #2c1810;
        width: 100%;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #d4af37;
        background: white;
    }

    .input-label {
        font-family: 'ui-sans-serif';
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: rgba(44, 24, 16, 0.4);
        margin-bottom: 0.5rem;
        display: block;
    }
</style>

<main class="relative z-20 max-w-4xl mx-auto px-6 md:px-10 mt-16 mb-24">
    
    <div class="text-center mb-16">
        <h1 class="font-book text-5xl font-bold italic tracking-tighter text-ink leading-tight">Refine Your <span class="text-gold">Legend</span></h1>
        <p class="font-book text-ink/50 italic text-lg uppercase tracking-widest text-[10px] mt-2">Adjust your presence in the chronicles</p>
    </div>

    <div class="edit-profile-card shadow-2xl">
        <form action="/editprofile" method="POST" enctype="multipart/form-data" class="space-y-10">
            
            <div class="flex flex-col items-center mb-12">
                <div class="relative group">
                    <div class="w-32 h-32 rounded-full bg-[#2c1810] flex items-center justify-center text-gold text-5xl font-black border-4 border-gold/20 shadow-xl overflow-hidden">
                        <span id="initials"><?= strtoupper(substr($user['first_name'] ?? 'U', 0, 1)) ?></span>
                    </div>
                    <label for="avatar" class="absolute bottom-0 right-0 bg-gold w-10 h-10 rounded-full flex items-center justify-center cursor-pointer border-4 border-[#f2e8cf] hover:scale-110 transition-transform shadow-lg">
                        <span class="text-[#2c1810] text-lg font-bold">&#9998;</span>
                        <input type="file" id="avatar" name="avatar" class="hidden">
                    </label>
                </div>
                <p class="font-book text-[10px] italic text-ink/30 mt-4 uppercase tracking-widest">Update Manuscript Image</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="input-label">First Name</label>
                    <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" class="form-input" placeholder="Your given name...">
                </div>

                <div>
                    <label class="input-label">Last Name</label>
                    <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" class="form-input" placeholder="Your family legacy...">
                </div>

                <div>
                    <label class="input-label">Correspondence (Email)</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" class="form-input" placeholder="Email for the archives...">
                </div>

                <div>
                    <label class="input-label">New Secret Key (Password)</label>
                    <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current...">
                </div>

                <div class="md:col-span-2">
                    <label class="input-label">Current Rank</label>
                    <input type="text" value="<?= ucfirst($user['role'] ?? 'Citizen') ?>" disabled class="form-input opacity-50 cursor-not-allowed italic" style="background: rgba(44, 24, 16, 0.05);">
                </div>
            </div>

            <div class="pt-10 border-t border-[#2c1810]/5 flex flex-col md:flex-row gap-4 justify-between items-center">
                <a href="/profile" class="font-ui text-[10px] font-black uppercase tracking-widest text-ink/40 hover:text-red-800 transition-colors">
                    &larr; Return to Archives
                </a>
                
                <button type="submit" class="group relative inline-flex items-center px-12 py-5 overflow-hidden rounded-full bg-[#2c1810] text-paper shadow-2xl transition-all hover:scale-105 active:scale-95">
                    <span class="relative z-10 font-ui text-xs font-black uppercase tracking-[0.3em]">
                        Save Alterations
                    </span>
                    <div class="absolute inset-0 bg-gold translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                </button>
            </div>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>