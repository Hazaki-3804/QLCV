particlesJS("particles-js", {
    particles: {
        number: { value: 100, density: { enable: true, value_area: 800 } },
        color: { value: ["#00bfff", "#40c4ff", "#ffffff"] },
        shape: { type: "circle" },
        opacity: { value: 0.6, random: true },
        size: { value: 4, random: true },
        line_linked: { enable: true, distance: 120, color: "#00bfff", opacity: 0.5, width: 1.5 },
        move: { enable: true, speed: 3, direction: "none", random: true }
    },
    interactivity: {
        detect_on: "canvas",
        events: { onhover: { enable: true, mode: "grab" }, onclick: { enable: true, mode: "push" } },
        modes: { grab: { distance: 150 }, push: { particles_nb: 4 } }
    },
    retina_detect: true
});