const toggleButtons = document.querySelectorAll(".toggle-button");
    toggleButtons.forEach((button) => {
    button.addEventListener("click", function() {
        const cardBody = this.parentNode.nextElementSibling;
        cardBody.classList.toggle("hidden");
    });
});