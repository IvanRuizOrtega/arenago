window.Alpine.data("bookingSystem", () => ({
    fieldId: null,
    priceHour: 0,
    workingDays: null,

    date: "",
    time: "",
    duration: 1,

    minDate: "",
    maxDate: "",
    availableHours: [],
    errorMessage: "",
    loading: false,
    loadingHours: false,
    isValid: false,

    init() {
        const today = new Date();
        const max = new Date();
        max.setDate(today.getDate() + 3);

        this.minDate = today.toISOString().split("T")[0];
        this.maxDate = max.toISOString().split("T")[0];
    },

    setFieldData(data) {
        this.fieldId = data.id;
        this.priceHour = data.price;
        this.workingDays = data.workingDays;

        // Resetear estados previos del formulario
        this.date = "";
        this.time = "";
        this.availableHours = [];
        this.errorMessage = "";
        this.isValid = false;
    },

    async handleDateChange() {
        this.errorMessage = "";
        this.time = "";
        this.availableHours = [];
        this.isValid = false;

        if (!this.date) return;

        // Extraer el día de la semana según el estándar ISO de tu BD (1 = Lunes, 7 = Domingo)
        // Agregamos el reemplazo de guiones para evitar desfases por zona horaria local
        const selectedDate = new Date(this.date.replace(/-/g, "\/"));
        let dayOfWeek = selectedDate.getDay();
        if (dayOfWeek === 0) dayOfWeek = 7; // Convertir Domingo de 0 a 7

        // Validar si la cancha abre ese día según el esquema working_days
        const dayConfig = this.workingDays ? this.workingDays[dayOfWeek] : null;

        if (!dayConfig || !dayConfig.open || !dayConfig.close) {
            this.errorMessage =
                "El complejo deportivo se encuentra cerrado el día seleccionado.";
            return;
        }

        // Si pasa la validación local, disparamos la consulta a la liga/API para traer horas disponibles
        await this.fetchAvailableHours(dayConfig.open, dayConfig.close);
    },

    async fetchAvailableHours(openTime, closeTime) {
        this.loadingHours = true;
        await window.axios
            .get(
                `/playing-fields/${this.fieldId}/available-hours?date=${this.date}&open=${openTime}&close=${closeTime}`,
            )
            .then(({ data: { hours } }) => {
                this.availableHours = hours;
            })
            .catch(() => {
                this.errorMessage =
                    "No se pudieron recuperar las horas libres.";
            })
            .finally(() => {
                this.loadingHours = false;
            });
    },

    validateSchedule() {
        this.errorMessage = "";
        this.isValid = false;

        if (!this.date || !this.time) return;

        const selectedHour = parseInt(this.time.split(":")[0]);

        // Buscar la configuración del día actual en memoria
        const selectedDate = new Date(this.date.replace(/-/g, "\/"));
        let dayOfWeek = selectedDate.getDay();
        if (dayOfWeek === 0) dayOfWeek = 7;

        const dayConfig = this.workingDays[dayOfWeek];
        const maxCloseHour = parseInt(dayConfig.close.split(":")[0]);

        // Validar desborde de cierre de ese día en específico
        if (selectedHour + this.duration > maxCloseHour) {
            this.errorMessage = `Para este día el complejo cierra a las ${maxCloseHour}:00. Ajusta la duración.`;
            return;
        }

        // Control de tiempo si es hoy
        // const todayStr = new Date().toISOString().split("T")[0];
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, "0");
        const day = String(today.getDate()).padStart(2, "0");
        const todayStr = `${year}-${month}-${day}`; //  Formato YYYY-MM-DD local
        if (this.date === todayStr) {
            const currentHour = new Date().getHours();
            if (selectedHour <= currentHour) {
                this.errorMessage =
                    "No puedes seleccionar un horario que ya expiró.";
                return;
            }
        }

        this.isValid = true;
    },

    async submitBooking() {
        if (!this.isValid) return;
        this.loading = true;

        await window.axios
            .post("/bookings", {
                playing_field_id: this.fieldId,
                start_time: `${this.date} ${this.time}`,
                duration_hours: this.duration,
            })
            .then(() => {
                window.location.reload();
            })
            .catch(({ message }) => {
                this.errorMessage = message;
            })
            .finally(() => {
                this.loading = false;
            });
    },
}));
