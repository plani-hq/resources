<?php

$seo_keywords = 'alexlostorto, Alex, Alex lo Storto, Alex Lo Storto, flashi, Flashi, flashcards, flashcard, revision, learning, science, physics, math, chemistry, revision tool, revision tools';
$seo_description = "Finding resources couldn't be simpler!";
$seo_author = 'Alex lo Storto';
$site_title = 'NUAST Resources';

$title = 'NUAST Resources';

include('../components/header.php');

// Check if the 'seeAll' parameter is set and its value is true
if (isset($_GET['seeAll']) && $_GET['seeAll'] === 'true') {
    echo '<link href="styles/css/seeAll.css" rel="stylesheet">';
}

?>

<link href="styles/css/styles.css" rel="stylesheet">

<script>

<?php include("../utils/api.js"); ?>
<?php include("../utils/inputs.js"); ?>
const api = new API();

</script>

<main class="d-flex flex-column justify-content-center align-items-center position-relative w-100 h-100">
    <?php
        include("../assets/svg/circle.svg");  // Small light pink circle
        include("../assets/svg/donut.svg");  // Medium pink donut
        include("../assets/svg/ring.svg");  // Big pink ring
    ?>
    <section class="search-container d-flex flex-column align-items-center">
        <?php
            include("../assets/svg/find.svg");  // Find logo
        ?>
        <div class="position-relative w-100">
            <?php
                include("../assets/svg/search.svg");  // Search icon
            ?>
            <input id="search" type="text" class="w-100 h-100" placeholder="Find a resource..." autocomplete="off">
        </div>
        <a href="?seeAll=true">See All</a>
        <section class="results flex-column align-items-center"></section>
        <template id="result-template">
            <a href="https://example.com" target="_blank">
                <span>Name</span>
            </a>
        </template>
    </section>
    <div class="resource-creator d-flex flex-column align-items-center justify-content-center">
        <button class="resource-creator-button">
            <?php
                include("../assets/svg/magic-wand.svg");  // Magic Wand icon
            ?>
        </button>
        <section class="popup">
            <section class="create-container">
                <h3>Resource Creator</h3>
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>
                <div>
                    <label for="url">URL</label>
                    <input type="url" name="url" id="url">
                </div>
                <button>
                    <span>Create</span>
                    <?php
                        include("../assets/svg/spanner.svg");  // Spanner icon
                    ?>
                </button>
            </section>
            <section class="continue-container">
                <h3>Resource Creator</h3>
                <p class="continue-text"></p>
                <button>
                    <span>Continue</span>
                </button>
            </section>
        </section>
    </div>
</main>

<?php include("scripts/nuast.php"); ?>
<?php include('../components/footer.php'); ?>