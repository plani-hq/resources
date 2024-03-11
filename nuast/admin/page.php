<?php

$seo_keywords = 'alexlostorto, Alex, Alex lo Storto, Alex Lo Storto, flashi, Flashi, flashcards, flashcard, revision, learning, science, physics, math, chemistry, revision tool, revision tools';
$seo_description = "Finding resources couldn't be simpler!";
$seo_author = 'Alex lo Storto';
$site_title = 'NUAST Admin';

$title = 'NUAST Admin';

include('../../components/header.php');

?>

<link href="styles/css/styles.css" rel="stylesheet">

<script>

<?php include("../../utils/api.js"); ?>
<?php include("../../utils/inputs.js"); ?>
const api = new API();

</script>

<main class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
    <?php
        include("../../assets/svg/circle.svg");  // Small light pink circle
        include("../../assets/svg/donut.svg");  // Medium pink donut
        include("../../assets/svg/ring.svg");  // Big pink ring
    ?>
    <section class="search-container d-flex flex-column align-items-center">
        <?php
            include("../../assets/svg/hey.svg");  // Hey logo
        ?>
        <div class="position-relative w-100">
            <?php
                include("../../assets/svg/search.svg");  // Search icon
            ?>
            <input id="search" type="text" class="w-100 h-100" placeholder="Find a resource..." autocomplete="off">
        </div>
        <section class="results flex-column align-items-center"></section>
        <template id="result-template">
            <div>
                <div class="top-row">
                    <span id="name"></span>
                    <div class="buttons">
                        <div id="hide">
                            <?php include("../../assets/svg/cross.svg");  // Cross icon ?>
                        </div>
                        <div id="approve">
                            <?php include("../../assets/svg/tick.svg");  // Tick icon ?>
                        </div>
                    </div>
                </div>
                <div class="bottom-row">
                    <a id="url" href="https://example.com" target="_blank"></a>
                </div>
            </div>
        </template>
    </section>
</main>

<?php include("scripts/admin.php"); ?>
<?php include('../../components/footer.php'); ?>