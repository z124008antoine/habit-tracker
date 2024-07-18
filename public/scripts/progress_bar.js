// Use this script to animate progress bars from /components/progress_bar.php
// prototype: (string, number[][])
// ex; animateProgressBar('progress-bar-1', [120, 140]); to animate progress bar to 100/100 -> 120/120 -> 80/140
function animateProgressBar(id, intermediates, final, callback) {
    const tl = gsap.timeline();
    const el = document.getElementById(id);
    const mask = el.querySelector('.progress-bar-mask');
    const text = el.querySelector('.progress-bar-text');
    let [start_val, start_max] = text.innerText.split('/').map(Number);

    const updateFunc = () => {
        text.innerText = `${Math.round(el.num)}/${Math.round(el.max_num)}`;
        mask.style.width = `${100 - (el.num / el.max_num * 94)}%`;
    }

    el.num = start_val;
    el.max_num = start_max;
    // fill up to 100%
    tl.fromTo(el, {
        num: start_val,
        max_num: start_max
    }, {
        num: start_max,
        duration: 2,
        onUpdate: updateFunc,
        onComplete: () => {
            callback && callback(0);
        }
    });
    // fill intermediate levels
    for (let i = 0; i < intermediates.length; i++) {
        tl.fromTo(el, {
            max_num: intermediates[i - 1] || start_max,
        },{
            max_num: intermediates[i],
            duration: 0.5,
        }, '>+0.1');
        tl.fromTo(el, {
            num: 0
        }, {
            num: i === intermediates.length - 1 ? final : intermediates[i],
            duration: 2,
            onUpdate: updateFunc,
            onComplete: () => {
                if (i + 1 < intermediates.length)
                    el.max_num = intermediates[i + 1];
                callback && callback(i + 1);
            }
        }, '<');
    }
    tl.play();
}