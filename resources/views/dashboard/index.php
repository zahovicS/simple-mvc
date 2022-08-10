<section class="section is-title-bar">
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <ul>
                    <li>Admin</li>
                    <li>Dashboard</li>
                </ul>
            </div>
        </div>
        <div class="level-right">
            <div class="level-item">
                <div class="buttons is-right">
                    <a href="https://github.com/vikdiesel/admin-one-bulma-dashboard" target="_blank" class="button is-primary">
                        <span class="icon"><i class="mdi mdi-github-circle"></i></span>
                        <span>GitHub</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="hero is-hero-bar">
    <div class="hero-body">
        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <h1 class="title">
                        Dashboard
                    </h1>
                </div>
            </div>
            <div class="level-right" style="display: none;">
                <div class="level-item"></div>
            </div>
        </div>
    </div>
</section>
<section class="section is-main-section">
    <?php
    dd($data["usuarios"]);
    ?>
</section>
<script src="<?= BASE_URL ?>/js/dashboard/dashboard.js"></script>