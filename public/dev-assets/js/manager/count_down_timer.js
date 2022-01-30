(function () {
    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

    due_date = document.getElementById("timer_section").getAttribute('data-date');
    const countDown = new Date(due_date).getTime(),
        x = setInterval(function () {

            const now = new Date().getTime(),
                distance = countDown - now;

            document.getElementById("days").innerText = Math.floor(distance / (day)),
                document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

            //do something later when date is reached
            if (distance < 0) {
                document.getElementById("heading").style.display = "block";
                document.getElementById("countdown").style.display = "none";
                document.getElementById("content").style.display = "block";
                document.getElementById("timer_section").style.background = "#DC3545";
                timer_section
                clearInterval(x);
            }
            //seconds
        }, 0)
}());
