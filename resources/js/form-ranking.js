document.addEventListener("DOMContentLoaded", () => {
    const submitRanking = (value) => {
        document.getElementById("ranking-input").value = value;
        document.getElementById("ranking-form").submit();
    };
    window.submitRanking = submitRanking;
});
