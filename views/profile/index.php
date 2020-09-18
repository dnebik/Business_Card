<?php

use app\models\User;
use app\models\LanguageKnowledge;
use app\models\PersonalSkills;
use app\models\Career;
use app\models\Education;
use app\models\PersonalInterest;
use app\models\Experience;
use app\models\Projects;
use yii\helpers\Url;

/* @var $user User */

$skillsData = PersonalSkills::getAllUserSkills($user);
$languagesData = LanguageKnowledge::getAllUserKnowledge($user);
$careerData = Career::getUserCareer($user);
$educationData = Education::getUserEducation($user);
$interestsData = PersonalInterest::getUserInterests($user);
$experiencesData = Experience::getUserExperience($user);
$projectData = Projects::getUserProjects($user);

?>


<div class="wrapper">
    <div class="main-wrapper">

        <section class="section summary-section">
            <h2 class="section-title"><i class="fa fa-user"></i>О себе</h2>
            <div class="summary">
                <?= ($careerData['text'] == null) ? "<p><b>Нет информации о себе.</b></p>" : $careerData["text"] ?>
            </div><!--//summary-->
        </section><!--//section-->

        <section class="section experiences-section">
            <h2 class="section-title"><i class="fa fa-briefcase"></i>Опыт</h2>
            <?
            if ($experiencesData == null) {
                echo "<p><b>Нет опыта работы.</b></p>";
            } else {
                ?>
                <? foreach ($experiencesData as $experience): ?>
                    <div class="item">
                        <div class="meta">
                            <div class="upper-row">
                                <h3 class="job-title"><?= $experience["position"] ?></h3>
                                <div class="time"><?= $experience["year_start"] ?>
                                    - <?= ($experience["year_end"] == null) ? "nowadays" : $experience["year_end"] ?></div>
                            </div><!--//upper-row-->
                            <div class="company"><?= $experience["place"] ?></div>
                        </div><!--//meta-->
                        <? if ($experience["description"] != null) { ?>
                            <div class="details">
                                <?= $experience["description"] ?>
                            </div><!--//details-->
                        <? } ?>
                    </div><!--//item-->
                <? endforeach;
            } ?>

        </section><!--//section-->

        <section class="section projects-section">
            <h2 class="section-title"><i class="fa fa-archive"></i>Проекты</h2>
            <?
            if (!$projectData) {
                ?>
                <p><b>Нет проектов.</b></p>
            <? } else {
                foreach ($projectData as $project) { ?>
                    <div class="item">
                        <a href="<?= $project['url'] ?>"><?= $project['name'] ?></a>
                        <? if ($project['description']) {
                            echo " - {$project['description']}";
                        } ?>
                    </div>
                <? }
            } ?>
        </section><!--//section-->

        <section class="skills-section section">
            <h2 class="section-title"><i class="fa fa-rocket"></i>Навыки &amp; Умения</h2>
            <div class="skillset">
                <table>
                    <?
                    if (!$skillsData) {
                        echo "<p><b>Нет навыков.</b></p>";
                    } else {
                        foreach ($skillsData as $skill) { ?>
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
                        <? }
                    } ?>
                </table>
            </div>
        </section><!--//skills-section-->

    </div><!--//main-body-->
    <div class="sidebar-wrapper">
        <div class="profile-container">
            <? if ($user->login == Yii::$app->user->getIdentity()['login']) {
                ?>
                    <div class="setting-ico">
                        <a href="<?= Url::to('/settings') ?>"><i class="fa fa-cog" aria-hidden="true"></i></a>
                    </div>
                <?
            } ?>
            <img class="profile" src="" alt=""/>
            <h1 class="name"><?= $user["first_name"] . " " . $user["last_name"] ?></h1>
            <h3 class="tagline"><?= $user["post"] ?></h3>
        </div><!--//profile-container-->


        <? if ($user['email'] || $user['social'] || $user['phone'] || $user['git']) { ?>
            <div class="contact-container container-block">
                <ul class="list-unstyled contact-list">
                    <? if ($user['email']) { ?>
                        <li class="email"><i class="fa fa-envelope"></i><a
                                    href="http://<?= $user["email"] ?>"><?= $user["email"] ?></a></li>
                    <? } ?>
                    <? if ($user['phone']) { ?>
                        <li class="phone"><i class="fa fa-phone"></i><a
                                    href="tel:<?= $user["phone"] ?>"><?= $user["phone"] ?></a></li>
                    <? } ?>
                    <? if ($user['social']) { ?>
                        <li class="website"><i class="fa fa-globe"></i><a href="<?= $user["social"] ?>"
                                                                          target="_blank"><?= substr(strrchr($user['social'],
                                    '/'), 1) ?></a></li>
                    <? } ?>
                    <? if ($user['git']) { ?>
                        <li class="github"><i class="fa fa-github"></i><a href="<?= $user["git"] ?>"
                                                                          target="_blank"><?= substr(strrchr($user['git'],
                                    '/'),
                                    1) ?></a></li>
                    <? } ?>
                </ul>
            </div><!--//contact-container-->
        <? } ?>
        <div class="education-container container-block">
            <h2 class="container-block-title">Образование</h2>
            <?
            if (!$educationData) {
                echo "<p><b>Нет образования.</b></p>";
            } else {
                foreach ($educationData as $item) { ?>
                    <div class="item">
                        <h4 class="degree"><?= $item["faculty"]["name"] ?></h4>
                        <h5 class="meta"><?= $item["university"]["name"] ?></h5>
                        <div class="time"><?= $item["year_start"] ?> - <?= $item["year_end"] ?></div>
                    </div><!--//item-->
                <? }
            } ?>
        </div><!--//education-container-->

        <div class="languages-container container-block">
            <h2 class="container-block-title">Языки</h2>
            <ul class="list-unstyled interests-list">
                <?
                if (!$languagesData) {
                    echo "<p><b>Нет информации о языках.</b></p>";
                } else {
                    foreach ($languagesData as $language) { ?>
                        <li><?= $language["language"]['name'] ?> <span
                                    class="lang-desc">(<?= $language["level"]['name'] ?>)</span></li>
                    <? }
                } ?>
            </ul>
        </div><!--//interests-->

        <div class="interests-container container-block">
            <h2 class="container-block-title">Интересы</h2>
            <ul class="list-unstyled interests-list">
                <?
                if (!$interestsData) {
                    echo "<p><b>Нет интересов.</b></p>";
                } else {
                    foreach ($interestsData as $interest) { ?>
                        <li><?= $interest["inerest"]["name"] ?></li>
                    <? }
                } ?>
            </ul>
        </div><!--//interests-->
    </div><!--//sidebar-wrapper-->
</div>