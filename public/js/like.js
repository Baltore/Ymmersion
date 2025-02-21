document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".like-button").forEach(button => {
        button.addEventListener("click", function () {
            const recetteId = this.dataset.recetteId;
            fetch(`/recette/${recetteId}/like`, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    this.innerHTML = "❤️"; 
                } else {
                    this.innerHTML = "🤍"; 
                }
            })
            .catch(error => console.error("Erreur:", error));
        });
    });
});
