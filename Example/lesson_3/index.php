<?php

$connection = require_once("database.php");

$id_user = parse_ini_file("settings.ini", true)["user"]["id"];

$query = "SELECT * FROM portfolio.users 
    WHERE id = $id_user";
$aboutData = $connection->query($query)->fetch(PDO::FETCH_ASSOC);

$query = "SELECT un.name as university, fac.name as faculty, ed.year_start, ed.year_end FROM portfolio.education as ed 
    JOIN portfolio.faculty as fac ON ed.id_faculty = fac.id 
    JOIN portfolio.university as un ON ed.id_university = un.id 
    WHERE id_user = $id_user";
$educationData = $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT lang.name as language, lvl.name as level FROM portfolio.language_knowledge as lk 
    JOIN portfolio.languages as lang ON lk.id_language = lang.id 
    JOIN portfolio.level_of_knowledge as lvl ON lk.id_level = lvl.id 
    WHERE id_user = $id_user";
$languagesData = $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT interests.name FROM portfolio.personal_interest as pi 
    JOIN portfolio.interests ON pi.id_inerest = interests.id 
    WHERE id_user = $id_user";
$interestsData = $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT skill.name, ps.percent FROM portfolio.personal_skills as ps 
    JOIN portfolio.skills as skill ON ps.id_skill = skill.id 
    WHERE id_user = $id_user
    ORDER BY ps.percent DESC";
$skillsData = $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT text FROM portfolio.career
    WHERE id_user = $id_user";
$careerData = $connection->query($query)->fetch(PDO::FETCH_ASSOC);

$query = "SELECT job.position, job.place, job.description, year_start, year_end FROM portfolio.experience
    JOIN portfolio.job ON experience.id_job = job.id
    WHERE id_user = $id_user";
$experiencesData = $connection->query($query)->fetchALL(PDO::FETCH_ASSOC);

$query = "SELECT text FROM portfolio.projects
    WHERE id_user = $id_user";
$projectData = $connection->query($query)->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <title>Responsive Resume/CV Template for Developers</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive HTML5 Resume/CV Template for Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="wrapper">
    <div class="main-wrapper">

        <section class="section summary-section">
            <h2 class="section-title"><i class="fa fa-user"></i>Карьера</h2>
            <div class="summary">
                <?= ($careerData == null) ? "<p><b>Нет данных о карьере.</b></p>" : $careerData["text"] ?>
            </div><!--//summary-->
        </section><!--//section-->

        <section class="section experiences-section">
            <h2 class="section-title"><i class="fa fa-briefcase"></i>Опыт</h2>

            <?
            if ($experiencesData == null)
                echo "<p><b>Нет опыта работы.</b></p>";
            else{
            ?>
            <? foreach ($experiencesData as $experience): ?>
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
                            <h3 class="job-title"><?= $experience["position"] ?></h3>
                            <div class="time"><?= $experience["year_start"] ?> - <?= ($experience["year_end"] == null) ? "nowadays" : $experience["year_end"] ?></div>
                        </div><!--//upper-row-->
                        <div class="company"><?= $experience["place"] ?></div>
                    </div><!--//meta-->
                    <? if ($experience["description"] != null){ ?>
                    <div class="details">
                        <?= $experience["description"] ?>
                    </div><!--//details-->
                    <? } ?>
                </div><!--//item-->
            <? endforeach; }?>

        </section><!--//section-->

    <section class="section projects-section">
    <div class="item">
            <h2 class="section-title"><i class="fa fa-archive"></i>Проекты</h2>
            <?= ($projectData == null) ? "<p><b>Нет проектов.</b></p>" : $projectData["text"] ?>
    </div><!--//item-->
    </section><!--//section-->

    <section class="skills-section section">
        <h2 class="section-title"><i class="fa fa-rocket"></i>Навыки и Умения</h2>
        <div class="skillset">
            <? foreach ($skillsData as $skill): ?>
                <div class="item">
                    <h3 class="level-title"><?= $skill["name"] ?></h3>
                    <div class="level-bar">
                        <div class="level-bar-inner" data-level="<?= $skill["percent"] ?>%">
                        </div>
                    </div><!--//level-bar-->
                </div><!--//item-->
            <? endforeach; ?>

        </div>
    </section><!--//skills-section-->

</div><!--//main-body-->
<div class="sidebar-wrapper">
    <div class="profile-container">
        <img class="profile" src="assets/images/profile.png" alt=""/>
        <h1 class="name"><?= $aboutData["first_name"] . " " . $aboutData["last_name"] ?></h1>
        <h3 class="tagline"><?= $aboutData["post"] ?></h3>
    </div><!--//profile-container-->

    <div class="contact-container container-block">
        <ul class="list-unstyled contact-list">
            <li class="email"><i class="fa fa-envelope"></i><a
                        href="http://<?= $aboutData["email"] ?>"><?= $aboutData["email"] ?></a></li>
            <li class="phone"><i class="fa fa-phone"></i><a
                        href="tel:<?= $aboutData["phone"] ?>"><?= $aboutData["phone"] ?></a></li>
            <li class="website"><i class="fa fa-globe"></i><a href="https://<?= $aboutData["social"] ?>"
                                                              target="_blank"><?= $aboutData["social"] ?></a></li>
            <li class="github"><i class="fa fa-github"></i><a href="https://<?= $aboutData["git"] ?>"
                                                              target="_blank"><?= $aboutData["git"] ?></a></li>
        </ul>
    </div><!--//contact-container-->
    <div class="education-container container-block">
        <h2 class="container-block-title">Образование</h2>
        <? foreach ($educationData as $item): ?>
            <div class="item">
                <h4 class="degree"><?= $item["faculty"] ?></h4>
                <h5 class="meta"><?= $item["university"] ?></h5>
                <div class="time"><?= $item["year_start"] ?> - <?= $item["year_end"] ?></div>
            </div><!--//item-->
        <? endforeach ?>
    </div><!--//education-container-->

    <div class="languages-container container-block">
        <h2 class="container-block-title">Языки</h2>
        <ul class="list-unstyled interests-list">
            <? foreach ($languagesData as $language): ?>
                <li><?= $language["language"] ?> <span class="lang-desc">(<?= $language["level"] ?>)</span></li>
            <? endforeach; ?>
        </ul>
    </div><!--//interests-->

    <div class="interests-container container-block">
        <h2 class="container-block-title">Интересы</h2>
        <ul class="list-unstyled interests-list">
            <? foreach ($interestsData as $interest): ?>
                <li><?= $interest["name"] ?></li>
            <? endforeach; ?>
        </ul>
    </div><!--//interests-->

</div><!--//sidebar-wrapper-->
</div>

<footer class="footer">
    <div class="text-center">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
        <small class="copyright">Designed with <i class="fa fa-heart"></i> by <a href="http://themes.3rdwavemedia.com"
                                                                                 target="_blank">Xiaoying Riley</a> for
            developers
        </small>
    </div><!--//container-->
</footer><!--//footer-->

<!-- Javascript -->
<script type="text/javascript" src="assets/plugins/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- custom js -->
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html> 

