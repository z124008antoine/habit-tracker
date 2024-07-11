<button class="hamburger open">
    <div class="close open"></div>
    <div class="open"></div>
    <div class="open"></div>
    <div class="open"></div>
    <div class="close open"></div>

    <div class=""></div>
    <div class="close"></div>
    <div class=""></div>
    <div class="close"></div>
    <div class=""></div>

    <div class="open"></div>
    <div class="open"></div>
    <div class="close open"></div>
    <div class="open"></div>
    <div class="open"></div>

    <div class=""></div>
    <div class="close"></div>
    <div class=""></div>
    <div class="close"></div>
    <div class=""></div>

    <div class="close open"></div>
    <div class="open"></div>
    <div class="open"></div>
    <div class="open"></div>
    <div class="close open"></div>
</button>

<script defer>
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('nav');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        nav.classList.toggle('active');
    });
</script>