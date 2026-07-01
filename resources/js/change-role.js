document.addEventListener("DOMContentLoaded", () => {
    const changeRole = (baseUrl, role) => {
        window.location.href = `${baseUrl}?role=${role}`;
    };
    window.changeRole = changeRole;
});
