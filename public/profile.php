<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<section>
    <div class="grid-container">
        <div class="profile">
            <div class="avatar">
                <img alt="profile picture" src="images/avatars/avatar_<?php echo isset($_SESSION["pfp"]) ? $_SESSION["pfp"] : 0 ?>.png">
            </div>
            <div class="username"><?php echo $_SESSION['username'] ?></div>
            <!-- <a href="edit-profile.php" class="edit-profile">Edit profile</a> -->
            <button class="profile-edit-button">Edit Profile</button>
        </div>
        <div class="bio">
            <p>
                👋 Hi, I'm @Ev0gs</br>
                👀 I'm interested in video games, music (bass instrument), sport and coding.</br>
                👨‍🎓 I'm currently learning a lot of new notions thanks to the engineer school CESI Bordeaux I'm studying at. These notions are mostly coding such as SQL/C/C++/Arduino/Javascript/HTML/CSS/PHP/Web etc...</br>
                🎮 I made a personal project, who turn around video games, on unity. It's a 2D platformer video game and it is my first one in my life. I decided to make one because I would like to work in the video game industry.</br>
                💻 I'm currently on a personal project in relation to video game industry that will be released one day.</br>
                💕 I'm looking to collaborate for an internship on video game development or project around coding.</br>
                📫 How to reach me: <a href="mailto:pierre.latorse@viacesi.fr">pierre.latorse@viacesi.fr</a></br>
            </p>
            <button class="bio-edit-button"></button>
        </div>
        <div class="activity">
            <?php include __DIR__ . '/database/habits.php'; ?>
            <h1>My Year</h1>
            <div class="year-days">
                <span class="year-day-title">M</span>
                <span class="year-day-title">T</span>
                <span class="year-day-title">W</span>
                <span class="year-day-title">T</span>
                <span class="year-day-title">F</span>
                <span class="year-day-title">S</span>
                <span class="year-day-title">S</span>
            <?php
                $yearHabits = get_year_habits($_SESSION['user']);
                $maxCompleted = 0;
                foreach ($yearHabits as $nbCompleted) {
                    if ($nbCompleted > $maxCompleted) {
                        $maxCompleted = $nbCompleted;
                    }
                }
                
                $currentDay = new DateTime('first day of january');
                foreach ($yearHabits as $nbCompleted) {
                    ?>
                    <div
                        class="year-day<?= $nbCompleted === $maxCompleted ? ' all-completed' : '' ?>"
                        style="filter: grayscale(<?= ($maxCompleted - $nbCompleted) / $maxCompleted ?>);"
                        title="<?= $currentDay->format('dS F') . ': ' . $nbCompleted . ' completed' ?>"
                    ></div>
                <?php
                    $currentDay->modify('+1 day');
                }
                ?>
            </div>
        </div>
    </div>
</section>
    
<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/profile.css'>";
$documentTitle = 'Profile';
include 'layout/layout.php';
?>