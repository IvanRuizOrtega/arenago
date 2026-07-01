document.addEventListener("DOMContentLoaded", () => {
    const registerOwner = (baseUrl) => {
        window.location.href = `${baseUrl}?role=owner`;
    };

    const registerClient = (baseUrl) => {
        window.location.href = `${baseUrl}?role=client`;
    };

    window.registerOwner = registerOwner;
    window.registerClient = registerClient;
});
