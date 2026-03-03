window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 40) {
        navbar.classList.add("shrink");
    } else {
        navbar.classList.remove("shrink");
    }
});
