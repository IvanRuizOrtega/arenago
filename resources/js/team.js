window.Alpine.data("matchMaker", () => ({
    currentUserId: window.currentUserId || null,
    bookingId: window.bookingId || null,
    players: [],
    teamA: [],
    teamB: [],
    searchQuery: "",
    loading: false,
    isFirstLoad: true, // Flag para controlar la carga inicial de equipos

    init() {
        this.fetchPlayers();
    },

    async fetchPlayers() {
        if (!this.bookingId) return;
        this.loading = true;
        try {
            const { data } = await axios.post(
                `/bookings/${this.bookingId}/available-players`,
                {
                    search: this.searchQuery,
                    user_id: this.currentUserId,
                },
            );

            if (this.isFirstLoad) {
                // Si hay equipos ya conformados en la DB, los inyectamos directamente
                this.teamA = data.teamA || [];
                this.teamB = data.teamB || [];
                this.players = data.players || [];
                this.isFirstLoad = false; // Desactivamos para futuras búsquedas en el input
            } else {
                // En búsquedas consecutivas del input, filtramos los que ya están en el cliente
                const assignedIds = [...this.teamA, ...this.teamB].map(
                    (p) => p.id,
                );
                this.players = (data.players || []).filter(
                    (player) => !assignedIds.includes(player.id),
                );
            }

            // Ordenamos las listas por nombre por consistencia visual
            this.teamA.sort((a, b) => a.name.localeCompare(b.name));
            this.teamB.sort((a, b) => a.name.localeCompare(b.name));
        } catch (error) {
            console.error(
                "Error en Matchmaking:",
                error.response?.data || error.message,
            );
        } finally {
            this.loading = false;
        }
    },

    async toggleCircle(player) {
        try {
            const { data } = await axios.post("/users/toggle-friend", {
                friend_id: player.id,
                user_id: this.currentUserId,
            });

            // Sincronizamos dinámicamente el estado en todas las colecciones reactivas
            player.is_friend = data.attached;

            // Forzar actualización visual en los arreglos de Alpine
            this.players = [...this.players];
            this.teamA = [...this.teamA];
            this.teamB = [...this.teamB];
            // window.location.reload();
        } catch (error) {
            console.error("Error modificando círculo:", error);
        }
    },

    moveToTeam(player, teamTarget) {
        this.players = this.players.filter((p) => p.id !== player.id);
        if (teamTarget === "A") {
            this.teamA.push(player);
            this.teamA.sort((a, b) => a.name.localeCompare(b.name));
        } else {
            this.teamB.push(player);
            this.teamB.sort((a, b) => a.name.localeCompare(b.name));
        }
    },

    removeFromTeam(player, currentTeam) {
        if (currentTeam === "A") {
            this.teamA = this.teamA.filter((p) => p.id !== player.id);
        } else {
            this.teamB = this.teamB.filter((p) => p.id !== player.id);
        }
        this.players.push(player);
        this.players.sort((a, b) => a.name.localeCompare(b.name));
    },

    getTeamRatingAvg(team) {
        if (!team || team.length === 0) return "0.0 ⭐";
        let total = team.reduce((sum, p) => sum + (p.rating || 0), 0);
        return (total / team.length).toFixed(1) + " ⭐";
    },
}));
