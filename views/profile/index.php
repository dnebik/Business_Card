<?php

use app\models\User;
use app\models\LanguageKnowledge;
use app\models\PersonalSkills;
use app\models\Career;
use app\models\Education;
use app\models\PersonalInterest;
use app\models\Experience;

/* @var $user User */

$skillsData = PersonalSkills::getAllUserSkills($user);
$languagesData = LanguageKnowledge::getAllUserKnowledge($user);
$careerData = Career::getUserCareer($user);
$educationData = Education::getUserEducation($user);
$interestsData = PersonalInterest::getUserInterests($user);
$experiencesData = Experience::getUserExperience($user);

error_log("data: " . print_r($interestsData, true));

?>


<div class="wrapper">
    <div class="main-wrapper">

        <section class="section summary-section">
            <h2 class="section-title"><i class="fa fa-user"></i>О себе</h2>
            <div class="summary">
                <?= ($careerData['text'] == null) ? "<p><b>Нет информации.</b></p>" : $careerData["text"] ?>
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
            <h2 class="section-title"><i class="fa fa-archive"></i>Проекты</h2>
            <div class="intro">
                <p>You can list your side projects or open source libraries in this section. Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit. Vestibulum et ligula in nunc bibendum fringilla a eu lectus.</p>
            </div><!--//intro-->
            <div class="item">
                <span class="project-title"><a href="#hook">Velocity</a></span> - <span class="project-tagline">A responsive website template designed to help startups promote, market and sell their products.</span>

            </div><!--//item-->
            <div class="item">
                <span class="project-title"><a
                            href="http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-web-development-agencies-devstudio/"
                            target="_blank">DevStudio</a></span> -
                <span class="project-tagline">A responsive website template designed to help web developers/designers market their services. </span>
            </div><!--//item-->
            <div class="item">
                <span class="project-title"><a
                            href="http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-for-startups-tempo/"
                            target="_blank">Tempo</a></span> - <span class="project-tagline">A responsive website template designed to help startups promote their products or services and to attract users &amp; investors</span>
            </div><!--//item-->
            <div class="item">
                <span class="project-title"><a
                            href="hhttp://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-mobile-apps-atom/"
                            target="_blank">Atom</a></span> - <span class="project-tagline">A comprehensive website template solution for startups/developers to market their mobile apps. </span>
            </div><!--//item-->
            <div class="item">
                <span class="project-title"><a
                            href="http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-for-mobile-apps-delta/"
                            target="_blank">Delta</a></span> - <span class="project-tagline">A responsive Bootstrap one page theme designed to help app developers promote their mobile apps</span>
            </div><!--//item-->
        </section><!--//section-->

        <section class="skills-section section">
            <h2 class="section-title"><i class="fa fa-rocket"></i>Навыки &amp; Умения</h2>
            <div class="skillset">
                <table>
                    <? foreach ($skillsData as $skill): ?>
<!--                        <div class="item">-->
                    <tr>
                        <td>
                            <h3 class="level-title"><?= $skill['skill']["name"] ?></h3>
                        </td>
                        <td class="w-100">
                            <div class="level-bar">
                                <div class="level-bar-inner" data-level="<?= $skill["percent"] ?>%">
                                </div>
                            </div>
                        </td><!--//level-bar-->
                    </tr>
<!--                        </div>-->
                    <? endforeach; ?>
                </table>
            </div>
        </section><!--//skills-section-->

    </div><!--//main-body-->
    <div class="sidebar-wrapper">
        <div class="profile-container">
            <img class="profile" src="" alt=""/>
            <h1 class="name"><?= $user["first_name"] . " " . $user["last_name"] ?></h1>
            <h3 class="tagline"><?= $user["post"] ?></h3>
        </div><!--//profile-container-->

        <div class="contact-container container-block">
            <ul class="list-unstyled contact-list">
                <li class="email"><i class="fa fa-envelope"></i><a
                            href="http://<?= $user["email"] ?>"><?= $user["email"] ?></a></li>
                <li class="phone"><i class="fa fa-phone"></i><a
                            href="tel:<?= $user["phone"] ?>"><?= $user["phone"] ?></a></li>
                <li class="website"><i class="fa fa-globe"></i><a href="https://<?= $user["social"] ?>"
                                                                  target="_blank"><?= substr(strrchr($user['social'], '/'), 1) ?></a></li>
                <li class="github"><i class="fa fa-github"></i><a href="https://<?= $user["git"] ?>"
                                                                  target="_blank"><?= substr(strrchr($user['git'], '/'), 1) ?></a></li>
            </ul>
        </div><!--//contact-container-->
        <div class="education-container container-block">
            <h2 class="container-block-title">Образование</h2>
            <? foreach ($educationData as $item): ?>
                <div class="item">
                    <h4 class="degree"><?= $item["faculty"]["name"] ?></h4>
                    <h5 class="meta"><?= $item["university"]["name"] ?></h5>
                    <div class="time"><?= $item["year_start"] ?> - <?= $item["year_end"] ?></div>
                </div><!--//item-->
            <? endforeach ?>
        </div><!--//education-container-->

        <div class="languages-container container-block">
            <h2 class="container-block-title">Языки</h2>
            <ul class="list-unstyled interests-list">
                <? foreach ($languagesData as $language): ?>
                    <li><?= $language["language"]['name'] ?> <span class="lang-desc">(<?= $language["level"]['name'] ?>)</span></li>
                <? endforeach; ?>
            </ul>
        </div><!--//interests-->

        <div class="interests-container container-block">
            <h2 class="container-block-title">Интересы</h2>
            <ul class="list-unstyled interests-list">
                <? foreach ($interestsData as $interest): ?>
                    <li><?= $interest["inerest"]["name"] ?></li>
                <? endforeach; ?>
            </ul>
        </div><!--//interests-->
    </div><!--//sidebar-wrapper-->
</div>